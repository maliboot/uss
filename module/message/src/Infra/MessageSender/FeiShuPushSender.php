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

#[MessageSender(messageType: 16)]
class FeiShuPushSender extends AbstractMessageSender
{

    /**
     * @var string ...
     */
    private string $appKey;

    /**
     * @var string ...
     */
    private string $appSecret;

    /**
     * @var string ...
     */
    private string $accessToken;

    /**
     * @var int ...
     */
    private int $serverId;

    /**
     * @var string ...
     */
    private string $tenantAccessTokenUrl = 'https://open.feishu.cn/open-apis/auth/v3/tenant_access_token/internal';

    /**
     * @var string ...
     */
    private string $getUserIdUrl = 'https://open.feishu.cn/open-apis/contact/v3/users/batch_get_id';

    /**
     * @var string ...
     */
    private string $sendMessageUrl = 'https://open.feishu.cn/open-apis/message/v4/batch_send/';

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

            if (empty($userIds)) {
                return false;
            }

            $client = new Client();
            $res = $client->post($this->sendMessageUrl.'?receive_id_type=user_id', [
                'headers' => [
                    'Content-Type' => 'application/json; charset=utf-8',
                    'Authorization' => 'Bearer '.$this->accessToken,
                ],
                'json' => [
                    'msg_type' => 'post',
                    'user_ids' => $userIds,
                    'content' => $content,
                ],
            ]);

            $content = $res->getBody()->getContents();
            $response = json_decode($content, true);
            if ($response['errcode'] != 0) {
                $logger->error('发送钉钉通知失败', ['response' => $response]);
            }


            return true;
        }catch (\Exception $exception){
            throw new Exception(sprintf('发送钉钉通知异常:[%s], RAW:[%s]', $exception?->getMessage(), $exception->getTraceAsString()));
        }
        return true;
    }

    /**
     * 获取用户userIds.
     *
     * @param array $phones 手机号
     * @return array 成功返回userId
     */
    public function getUserIdListByPhone(array $phones): array
    {
        $client = new Client();

        $res = $client->post($this->getUserIdUrl, [
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-8',
                'Authorization' => 'Bearer '.$this->accessToken
            ],
            'json' => [
                'mobiles' => json_encode($phones),
            ],
        ]);

        $content = $res->getBody()->getContents();
        $response = json_decode($content, true);
        $userIds = [];
        if($response['code'] == 0){
            foreach ($response['data']['user_list'] as $v){
                $userIds[] = $v['user_id'];
            }
        }
        return $userIds;
    }

    /**
     * 获取钉钉发送格式
     * @param string $title
     * @param string $text
     * @return array
     */
    protected function getContent(string $title, string $text)
    {
        $feiShuMsg = [
            'post' => [
                'zh_cn'  => [
                    'title' => $title,
                    'content' => [
                        [
                            'tag' => 'text',
                            'text' => $text,
                            'style' => [],
                        ]
                    ],
                ]
            ]

        ];
        return $feiShuMsg;
    }

    /**
     * 获取AccessToken.
     */
    protected function getAccessToken(): void
    {
        $container = \Hyperf\Context\ApplicationContext::getContainer();
        $redis = $container->get(\Hyperf\Redis\Redis::class);
        $redis->select(intval(env('REDIS_DB', 3)));
        $redisKey = 'feishu_accessToken_'.$this->serverId;
        $accessToken = $redis->get($redisKey);
        if ($accessToken) {
             $this->accessToken = $accessToken;
             return;
        }

        $client = new Client();

        $res = $client->post($this->tenantAccessTokenUrl, [
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-8',
            ],
            'json' => [
                'app_id' => $this->appKey,
                'app_secret' => $this->appSecret,
            ],
        ]);
        $content = $res->getBody()->getContents();
        $response = json_decode($content, true);
        if ($response['code'] == 0) {
            $redis->set($redisKey, $response['tenant_access_token'], $response['expire']);
        }
        return;
    }

    /**
     * 根据手机号获取用户信息.
     *
     * @param string $phone ...
     *
     * @return array ...
     */
    public function getUserByPhone(string $phone): array
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
