<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\App\Executor\Command;

use Exception;
use Hyperf\Collection\Collection;
use Hyperf\View\RenderInterface;
use MaliBoot\Cola\Annotation\AppService;
use MaliBoot\Cola\App\AbstractExecutor;
use MaliBoot\Di\Annotation\Inject;
use Uss\Message\Client\Dto\Command\NotificationCmd;
use Uss\Message\Client\ViewObject\ResultVO;
use Uss\Message\Domain\Model\Message\Message;
use Uss\Message\Domain\Model\MessageTplAppLink\MessageTplAppLink;
use Uss\Message\Domain\Repository\MessageRepo;
use Uss\Message\Domain\Service\MessageDomainService;
use Uss\Message\Domain\Service\MessageTplGroupDomainService;

use function Hyperf\Support\make;

#[AppService]
class NotificationCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageRepo $messageRepo;

    #[Inject]
    protected MessageDomainService $messageDomainService;

    #[Inject]
    protected MessageTplGroupDomainService $tplGroupDomainService;

    #[Inject]
    protected RenderInterface $viewRender;

    public function execute(NotificationCmd $notificationCmd): ResultVO
    {
        $result = make(ResultVO::class)->setRequestId($notificationCmd->getRequestId());

        if (! $notificationCmd->getRequestId()) {
            return $result->setMsg('requestId必须');
        }
        // 是否重复消息-丢弃
        if ($this->messageRepo->isExistByRequestId($notificationCmd->getRequestId())) {
            return $result->setMsg('消息重复通知');
        }

        // 查询所有模板
        $tplGroup = $this->tplGroupDomainService->findByUniqid($notificationCmd->getTplGroupUniqid());
        if ($tplGroup === null) {
            return $result->setMsg('模板不存在');
        }

        $msgList = Collection::make();
        foreach ($tplGroup->getMessageTplList() as $tpl) {
            // 不启用过滤
            if (! $tpl->getStatus()) {
                continue;
            }

            $msg = make(Message::class);
            $msg->setTplId($tpl->getId());
            $msg->setUniqid(uniqid('s', true));
            $msg->setTplGroupId($tplGroup->getId());
            $msg->setType($tpl->getType());
            $msg->setAgentId($notificationCmd->getAgentId());

            $msg->setTitle($notificationCmd->getTitle($tpl->getTitle()));
            $requestContent = $notificationCmd->getContent();
            if ($requestContent != null) {
                $msg->setContent($requestContent);
            } else {
                try {
                    $renderContent = $this->viewRender->getContents($tpl->getBladeTemplate(), $notificationCmd->parseVarsToArray());
                } catch (Exception $e) {
                    return $result->setMsg(sprintf(
                        'Blade模板[id=%s]渲染失败，取消本模板消息发送，请自查。模板内容:[%s],错误信息:[%s]',
                        $tpl->getId(),
                        $tpl->getContent(),
                        $e->getMessage()
                    ));
                }
                $msg->setContent($renderContent);
            }

            $appLinkIns = $tpl->getAppLink() ? $tpl->getAppLink() : make(MessageTplAppLink::class);
            ($appLinkUri = $notificationCmd->getAppLinkUri()) !== null && $appLinkIns->setUri($appLinkUri);
            ($appLinkAndroidUri = $notificationCmd->getAppLinkAndroidUriActivity()) !== null && $appLinkIns->setAndroidUriActivity($appLinkAndroidUri);
            $msg->setAppLink($appLinkIns);

            $msg->setMailFiles($notificationCmd->getMailFilesByJson());
            $form = $notificationCmd->getFrom() ?: $tpl->getMessageForm();
            $msg->setFrom($form);
            $formName = $notificationCmd->getFromName() ?: $tpl->getServer()->getName();
            $msg->setFromName($formName);

            $msg->setTo(json_encode([...$tpl->getToList(), ...$notificationCmd->getToList($tpl->getType())]));

            $msg->setPostPlanTime($notificationCmd->getDefaultPostPlanTime());
            $msg->setRequestId($notificationCmd->getRequestId());
            $msg->setRequestSource($notificationCmd->getRequestSource());
            $msg->setBizId($notificationCmd->getBizId());
            $msg->setBizNo($notificationCmd->getBizNo());
            $msg->setBizExt($notificationCmd->getBizExtByJson());
            $msg->setBizCallbackUrl($notificationCmd->getBizCallbackUrl());
            $msg->setContentVars(json_encode($notificationCmd->parseVarsToArray(), JSON_UNESCAPED_UNICODE));
            $smsTpl = $tpl->getMessageTplSmsTemplate();
            $msg->setSmsSign($smsTpl ? $smsTpl->getSign() : '');
            $msg->setSmsTemplateCode($smsTpl ? $smsTpl->getCode() : '');
            // server配置
            $msg->setServer($tpl->getServer());
            // appLink配置
            $msg->initAppLinkExt();
            $msgList->push($msg);
        }

        if ($msgList->isEmpty()) {
            $result->setResult()->setMsg('无已启用的模板消息');
        }
        $this->messageRepo->insert($msgList->all());
        $this->messageDomainService->sendList($msgList);
        return $result->setResult(true);
    }
}
