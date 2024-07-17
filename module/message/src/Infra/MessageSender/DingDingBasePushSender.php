<?php

namespace Uss\Message\Infra\MessageSender;
use AlibabaCloud\SDK\Dingtalk\Voauth2_1_0\Dingtalk as AlibabaDingTalk;
use AlibabaCloud\SDK\Dingtalk\Voauth2_1_0\Models\GetAccessTokenRequest;
use Darabonba\OpenApi\Models\Config;
use GuzzleHttp\Client;
use Hyperf\Cache\Cache;
use Hyperf\Guzzle\ClientFactory;
use MaliBoot\Di\Annotation\Inject;

abstract class DingDingBasePushSender extends AbstractMessageSender
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
     * @var string 基础接口地址
     */
    protected string $oapiUrl = 'https://oapi.dingtalk.com/topapi';

    /**
     * @var int 消息发送的主体ID
     */
    protected int $serverId;

    #[Inject]
    protected ClientFactory $clientFactory;

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
        $cache = $container->get(Cache::class);
        $cacheKey = 'dingding_accessToken_'.$this->serverId;
        $accessToken = $cache->get($cacheKey);
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
            $cache->set($cacheKey, $accessTokenResponse->body->accessToken, $accessTokenResponse->body->expireIn);
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
        $client = $this->clientFactory->create();
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