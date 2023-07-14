<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Infra\MessageSender;

use _PHPStan_690619d82\Nette\Neon\Exception;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use Overtrue\EasySms\PhoneNumber;
use Overtrue\EasySms\Strategies\OrderStrategy;
use Uss\Message\Infra\MessageSender\Annotation\MessageSender;

#[MessageSender(messageType: 1)]
class AliSmsSender extends AbstractMessageSender
{
    protected int $maxAttempts = 0;

    public function execute(): bool
    {
        $aliKey = $this->msgParams['server']['aliKey'] ?? '';
        $aliSecret = $this->msgParams['server']['aliSecret'] ?? '';
        $smsSign = $this->msgParams['smsSign'] ?? '';
        $smsTemplateCode = $this->msgParams['smsTemplateCode'] ?? '';
        $config = [
            // HTTP 请求的超时时间（秒）
            'timeout' => 5.0,

            // 默认发送配置
            'default' => [
                // 网关调用策略，默认：顺序调用
                'strategy' => OrderStrategy::class,

                // 默认可用的发送网关
                'gateways' => ['aliyun'],
            ],
            // 可用的网关配置
            'gateways' => [
                'errorlog' => [
                    'file' => '/tmp/easy-sms.log',
                ],
                'aliyun' => [
                    'access_key_id' => $aliKey,
                    'access_key_secret' => $aliSecret,
                    'sign_name' => $smsSign,
                ],
            ],
        ];
        $easySms = new EasySms($config);
        $msg = [
            'template' => $smsTemplateCode, // 模板ID
            'data' => $this->getArrayFromJson('contentVars'),
        ];
        foreach ($this->getArrayFromJson('to') as $item) {
            try {
                $easySms->send(new PhoneNumber((int) $item, 86), $msg);
            } catch (NoGatewayAvailableException $e) {
                throw new Exception($e->getException('aliyun'));
            }
        }
        return true;
    }
}
