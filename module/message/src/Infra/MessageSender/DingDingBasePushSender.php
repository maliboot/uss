<?php

namespace Uss\Message\Infra\MessageSender;
use AlibabaCloud\SDK\Dingtalk\Voauth2_1_0\Dingtalk as AlibabaDingTalk;
use AlibabaCloud\SDK\Dingtalk\Voauth2_1_0\Models\GetAccessTokenRequest;
use Darabonba\OpenApi\Models\Config;
use Hyperf\Cache\Cache;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Logger\LoggerFactory;
use Exception;

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
     * @var string 基础接口地址域名
     */
    protected string $apiDomain = 'https://oapi.dingtalk.com';

    /**
     * @var int 消息发送的主体ID
     */
    protected int $serverId;

    protected function beforeExecute() :void
    {
        $this->appKey = $this->msgParams['server']['appKey'] ?? '';
        $this->appSecret = $this->msgParams['server']['appSecret'] ?? '';
        $this->corPid = $this->msgParams['server']['ddCorPid'] ?? '';
        $this->agentId = $this->msgParams['server']['ddAgentId'] ?? '';
        $this->serverId = intval($this->msgParams['server']['id'] ?? 0);
        $this->initAccessToken();
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
    protected function getContent(string $title, string $text): array
    {
        return [
            'msgtype'  => 'markdown',
            'markdown' => [
                'title' => $title,
                'text'  => $text,
            ],
        ];
    }

    /**
     * 初始化AccessToken
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function initAccessToken(): void
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
            return;
        }
        throw new Exception('钉钉获取accessToken失败');
    }

    /**
     * 根据手机号获取用户信息.
     * @param string $phone
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function getUserByPhone(string $phone): array
    {
        $sendMessageApi = $this->apiDomain . '/topapi/v2/user/getbymobile?access_token='.$this->accessToken;
        $result = $this->sendPostRequest($sendMessageApi, [
            'mobile' => $phone,
        ]);
        if ($result['errcode'] != 0) {
            return [];
        }
        return $result['result'] ?? [];
    }

    /**
     * 发送钉钉应用内消息
     * @param string $userIds
     * @param array $msg
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function sendAgentMsg(string $userIds, array $msg): void
    {
        $sendMessageApi = $this->apiDomain . '/topapi/message/corpconversation/asyncsend_v2?access_token='.$this->accessToken;
        $this->sendPostRequest($sendMessageApi, [
            'agent_id' => $this->agentId,
            'userid_list' => $userIds,
            'to_all_user' => false,
            'msg' => $msg
        ]);
    }

    /**
     * 发送钉钉请求
     * @param string $url
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function sendPostRequest(string $url, array $data): array
    {
        $container = \Hyperf\Context\ApplicationContext::getContainer();
        $logger = $container->get(LoggerFactory::class)->get(static::class);

        $container = \Hyperf\Context\ApplicationContext::getContainer();
        $clientFactory = $container->get(ClientFactory::class);
        $client = $clientFactory->create();
        $res = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-8',
            ],
            'json' => $data,
        ]);
        $content = $res->getBody()->getContents();
        $response = json_decode($content, true);
        if ($response['errcode'] != 0) {
            $logger->error('请求钉钉返回结果失败', ['response' => $response, 'params' => ['url' => $url, 'data' => $data]]);
        }
        return $response;
    }
}