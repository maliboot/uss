<?php

namespace Uss\Message\Infra\MessageSender;
use Hyperf\Cache\Cache;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Logger\LoggerFactory;
use Exception;

abstract class FeiShuBasePushSender  extends AbstractMessageSender
{
    /**
     * @var string 飞书appKey
     */
    protected string $appKey;

    /**
     * @var string 飞书appSecret
     */
    protected string $appSecret;

    /**
     * @var string 飞书tenant_access_token
     */
    protected string $tenantAccessToken;

    /**
     * @var int 消息发送的主体ID
     */
    protected int $serverId;

    /**
     * @var string 飞书接口域名
     */
    protected string $apiDomain = 'https://open.feishu.cn';


    protected function beforeExecute() :void
    {
        $this->appKey = $this->msgParams['server']['appKey'] ?? '';
        $this->appSecret = $this->msgParams['server']['appSecret'] ?? '';
        $this->serverId = intval($this->msgParams['server']['id'] ?? 0);
        $this->initTenantAccessToken();
    }

    /**
     * 获取飞书TenantAccessToken
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function initTenantAccessToken(): void
    {
        $container = \Hyperf\Context\ApplicationContext::getContainer();
        $cache = $container->get(Cache::class);
        $cacheKey = 'feishu_tenantAccessToken_'.$this->serverId;
        $tenantAccessToken = $cache->get($cacheKey);
        if ($tenantAccessToken) {
            $this->tenantAccessToken = $tenantAccessToken;
            return;
        }
        $tenantAccessTokenUrl = $this->apiDomain.'/open-apis/auth/v3/tenant_access_token/internal';
        $result = $this->sendPostRequest($tenantAccessTokenUrl, ['app_id' => $this->appKey, 'app_secret' => $this->appSecret], [
            'Content-Type' => 'application/json; charset=utf-8',
        ]);
        if($result['code'] != 0){
            throw new Exception(sprintf('飞书获取TenantAccessToken失败%s', json_encode($result)));
        }
        $this->tenantAccessToken = $result['tenant_access_token'];
    }

    /**
     * 获取飞书富文本发送格式
     * @param string $title
     * @param string $text
     * @return array
     */
    protected function getPostContent(string $title, string $text)
    {
        return [
            "post" => [
                "zh_cn"  => [
                    "title" => $title,
                    "content" => [
                        [
                            [
                                "tag" => "text",
                                "text" => $text,
                                "style" => '',
                            ]
                        ]
                    ],
                ]
            ]
        ];
    }

    /**
     * 获取用户userIds.
     *
     * @param array $phones 手机号
     * @return array 成功返回userId
     */
    public function getUserIdListByPhone(array $phones): array
    {
        $result = $this->sendPostRequest($this->apiDomain.'/open-apis/contact/v3/users/batch_get_id', ['mobiles' => $phones], [
            'Content-Type' => 'application/json; charset=utf-8',
            'Authorization' => 'Bearer '.$this->tenantAccessToken
        ]);

        $userIds = [];
        if($result['code'] == 0){
            foreach ($result['data']['user_list'] as $v){
                $userIds[] = [
                    'user_id' => $v['user_id'],
                    'mobile' => $v['mobile']
                ];
            }
        }
        return $userIds;
    }

    /**
     * 发送请求
     * @param string $url
     * @param array $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function sendPostRequest(string $url, array $data, array $headers): array
    {
        $container = \Hyperf\Context\ApplicationContext::getContainer();
        $logger = $container->get(LoggerFactory::class)->get(static::class);

        $container = \Hyperf\Context\ApplicationContext::getContainer();
        $clientFactory = $container->get(ClientFactory::class);
        $client = $clientFactory->create();
        $res = $client->post($url, [
            'headers' => $headers,
            'json' => $data,
        ]);
        $content = $res->getBody()->getContents();
        $response = json_decode($content, true);
        if ($response['code'] != 0) {
            $logger->error('请求飞书返回结果失败', ['response' => $response, 'params' => ['url' => $url, 'data' => $data]]);
        }
        return $response;
    }

    /**
     * 批量发送飞书应用消息
     * @param array $userIds
     * @param array $sendContent
     * @param string $msgType
     * @param string $receiveIdType
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function sendBatchAgrentMsg(array $userIds, array $sendContent, string $msgType = 'post', string $receiveIdType = 'user_id')
    {
        $this->sendPostRequest($this->apiDomain.'/open-apis/message/v4/batch_send?receive_id_type='.$receiveIdType,
            [
                'msg_type' => $msgType,
                'open_ids' => $userIds,
                'content' => $sendContent,
            ],
            [
                'Content-Type' => 'application/json; charset=utf-8',
                'Authorization' => 'Bearer '.$this->tenantAccessToken
            ]
        );
    }
}