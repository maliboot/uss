<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Domain\Service;

use MaliBoot\Di\Annotation\Inject;
use Uss\Message\Domain\Model\MessageTplAppLink\MessageTplAppLink;
use Uss\Message\Domain\Model\MessageTplGroup\MessageTpl;
use Uss\Message\Domain\Model\MessageTplGroup\MessageTplGroup;
use Uss\Message\Domain\Model\MessageTplServer\MessageTplServer;
use Uss\Message\Domain\Model\MessageTplSmsTemplate\MessageTplSmsTemplate;
use Uss\Message\Domain\Repository\MessageTplAppLinkRepo;
use Uss\Message\Domain\Repository\MessageTplGroupRepo;
use Uss\Message\Domain\Repository\MessageTplRepo;
use Uss\Message\Domain\Repository\MessageTplServerRepo;
use Uss\Message\Domain\Repository\MessageTplSmsTemplateRepo;

class MessageTplGroupDomainService
{
    #[Inject]
    protected MessageTplGroupRepo $messageTplGroupRepo;

    #[Inject]
    protected MessageTplRepo $messageTplRepo;

    #[Inject]
    protected MessageTplAppLinkRepo $appLinkRepo;

    #[Inject]
    protected MessageTplServerRepo $serverRepo;

    #[Inject]
    protected MessageTplSmsTemplateRepo $messageTplSmsTemplateRepo;

    public function findByUniqid(string $uniqid): ?MessageTplGroup
    {
        $group = $this->messageTplGroupRepo->findByUniqid($uniqid);
        if (! $group instanceof MessageTplGroup) {
            return null;
        }

        // 查询所有模板
        $tplList = $this->messageTplRepo->allByGroupId($group->getId());
        if (empty($tplList)) {
            return null;
        }

        // 查询模板其它数据
        $serverIdList = [];
        $appLinkIdList = [];
        $smsTemplateIdList = [];
        foreach ($tplList as $tpl) {
            // app类型时，查询app-link
            if ($tpl->getType() === 2 && $tpl->getAppLinkId() !== 0) {
                $appLinkIdList[$tpl->getId()] = $tpl->getAppLinkId();
            }
            if ($tpl->getServerId() !== 0) {
                $serverIdList[$tpl->getId()] = $tpl->getServerId();
            }
            if ($tpl->getSmsTemplateId() !== 0) {
                $smsTemplateIdList[$tpl->getId()] = $tpl->getSmsTemplateId();
            }
        }
        // 查询server-info
        $serverList = [];
        if (! empty($serverIdList)) {
            $serverList = $this->serverRepo->allByIdList($serverIdList)->reduce(function (array $carry, MessageTplServer $tplServer) {
                $carry[$tplServer->getId()] = $tplServer;
                return $carry;
            }, []);
        }
        // 查询app-link
        $appLinkList = [];
        if (! empty($appLinkIdList)) {
            $appLinkList = $this->appLinkRepo->allByIdList($appLinkIdList)->reduce(function (array $carry, MessageTplAppLink $appLink) {
                $carry[$appLink->getId()] = $appLink;
                return $carry;
            }, []);
        }
        // 查询sms-template
        $smsTemplateList = [];
        if (! empty($smsTemplateIdList)) {
            $smsTemplateList = $this->messageTplSmsTemplateRepo->allByIdList($smsTemplateIdList)->reduce(function (array $carry, MessageTplSmsTemplate $smsTemplate) {
                $carry[$smsTemplate->getId()] = $smsTemplate;
                return $carry;
            }, []);
        }

        // 整合数据
        return $group->setMessageTplList(array_map(function (MessageTpl $tpl) use ($serverList, $appLinkList, $smsTemplateList) {
            isset($serverList[$tpl->getServerId()]) && $tpl->setServer($serverList[$tpl->getServerId()]);
            isset($appLinkList[$tpl->getAppLinkId()]) && $tpl->setAppLink($appLinkList[$tpl->getAppLinkId()]);
            isset($smsTemplateList[$tpl->getSmsTemplateId()]) && $tpl->setMessageTplSmsTemplate($smsTemplateList[$tpl->getSmsTemplateId()]);
            return $tpl;
        }, $tplList));
    }
}
