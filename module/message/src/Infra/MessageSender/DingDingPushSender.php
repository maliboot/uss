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
class DingDingPushSender extends AbstractMessageSender
{
    /**
     * @var string 钉钉corPid
     */
    protected string $corPid;

    /**
     * @var string 钉钉agentId
     */
    protected string $agentId;

    /**
     * @var string 钉钉appKey
     */
    protected string $appKey;

    /**
     * @var string 钉钉appSecret
     */
    protected string $appSecret;

    /**
     * @var string 钉钉token
     */
    protected string $accessToken;

    /**
     * @var int 消息发送的主体ID
     */
    protected int $serverId;

    /**
     * @var string 基础接口地址
     */
    protected string $oapiUrl = 'https://oapi.dingtalk.com/topapi';

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

            $client = new Client();

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

    /**
     * 获取用户userIds.
     *
     * @param array $phones 手机号
     * @return string 成功返回userId，失败返回''
     */
    protected function getUserIdListByPhone(array $phones): string
    {
        return array_reduce($phones, function ($carry, $item) {
            $userInfo = $this->getUserByPhone($item);
            $userId = $userInfo['userid'] ?? '';
            if(!empty($userId)){
                $carry = $carry ? $carry . ',' . $userId : $userId;
            }
            return $carry;
        }, '');
    }

    /**
     * 获取钉钉发送格式
     * @param string $title
     * @param string $text
     * @return array
     */
    protected function getContent(string $title, string $text)
    {
        $dingMsg = [
            'msgtype'  => 'markdown',
            'markdown' => [
                'title' => $title,
                'text'  => $text,
            ],
        ];
        return $dingMsg;
    }

    /**
     * 获取AccessToken.
     */
    protected function getAccessToken(): void
    {
        $container = \Hyperf\Context\ApplicationContext::getContainer();
        $redis = $container->get(\Hyperf\Redis\Redis::class);
        $redis->select(intval(env('REDIS_DB', 3)));
        $redisKey = 'dingding_accessToken_'.$this->serverId;
        $accessToken = $redis->get($redisKey);
        if ($accessToken) {
             $this->accessToken = $accessToken;
             return;
        }

        $config           = new Config([]);
        $config->protocol = 'https';
        $config->regionId = 'central';

        $accessTokenResponse = (new AlibabaDingTalk($config))->getAccessToken((new GetAccessTokenRequest([
            'appKey'    => $this->appKey,
            'appSecret' => $this->appSecret,
        ])));

        if (isset($accessTokenResponse->body->accessToken, $accessTokenResponse->body->expireIn)) {
            $this->accessToken = $accessTokenResponse->body->accessToken;
            $redis->set($redisKey, $accessTokenResponse->body->accessToken, $accessTokenResponse->body->expireIn - 7000);
        }
    }

    /**
     * 根据手机号获取用户信息.
     *
     * @param string $phone ...
     *
     * @return array ...
     */
    protected function getUserByPhone(string $phone): array
    {
        $sendMessageApi = $this->oapiUrl . '/v2/user/getbymobile?access_token=' . $this->accessToken;

        $client = new Client();
        $res = $client->post($sendMessageApi, [
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-8',
            ],
            'json' => ['mobile' => $phone],
        ]);

        $content = $res->getBody()->getContents();
        $response = json_decode($content, true);

        if ($response['errcode'] != 0) {
            return [];
        }
        return $response['result'] ?? [];
    }
}
