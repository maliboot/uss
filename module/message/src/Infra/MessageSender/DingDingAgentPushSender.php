<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\MessageSender;

use AlibabaCloud\SDK\Dingtalk\Voauth2_1_0\Dingtalk as AlibabaDingTalk;
use AlibabaCloud\SDK\Dingtalk\Voauth2_1_0\Models\GetAccessTokenRequest;
use Darabonba\OpenApi\Models\Config;
use Exception;
use GuzzleHttp\Client;
use Hyperf\Logger\LoggerFactory;
use Uss\Message\Infra\MessageSender\Annotation\MessageSender;

#[MessageSender(messageType: 8)]
class DingDingAgentPushSender extends DingDingBasePushSender
{
    /**
     * 钉钉推送
     * @return bool ...
     */
    protected function execute(): bool
    {
        //获取参数
        $this->appKey = $this->msgParams['server']['appKey'] ?? '';
        $this->appSecret = $this->msgParams['server']['appSecret'] ?? '';
        $this->corPid = $this->msgParams['server']['ddCorPid'] ?? '';
        $this->agentId = $this->msgParams['server']['ddAgentId'] ?? '';
        $this->serverId = intval($this->msgParams['server']['id'] ?? 0);
        $title = $this->msgParams['title'] ?? '';
        $content = $this->msgParams['content'] ?? '';

        $container = \Hyperf\Context\ApplicationContext::getContainer();
        $logger = $container->get(LoggerFactory::class)->get(static::class);

        //获取内容
        $sendContent = $this->getContent($title, $content);

        try {
            //获取token
            $this->getAccessToken();

            //获取要发送的人
            $phones = $this->getArrayFromJson('to');
            if (empty($phones)) {
                return false;
            }
            $userIds        = $this->getUserIdListByPhone($phones);

            $sendMessageApi = $this->oapiUrl . '/message/corpconversation/asyncsend_v2?access_token=' . $this->accessToken;

            $client = $this->clientFactory->create();
            $res = $client->post($sendMessageApi, [
                'headers' => [
                    'Content-Type' => 'application/json; charset=utf-8',
                ],
                'json' => [
                    'agent_id' => $this->agentId,
                    'userid_list' => $userIds,
                    'to_all_user' => false,
                    'msg' => $sendContent
                ],
            ]);

            $content = $res->getBody()->getContents();
            $response = json_decode($content, true);
            if ($response['errcode'] != 0) {
                $logger->error('发送钉钉通知失败', ['response' => $response, 'params' => $this->msgParams]);
            }

            return true;
        }catch (\Exception $exception){
            throw new Exception(sprintf('发送钉钉通知异常:[%s], RAW:[%s]', $exception?->getMessage(), $exception->getTraceAsString()));
        }
    }
}
