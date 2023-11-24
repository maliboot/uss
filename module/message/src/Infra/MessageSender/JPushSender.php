<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\MessageSender;

use Exception;
use JPush\Client;
use JPush\Exceptions\JPushException;
use Uss\Message\Infra\MessageSender\Annotation\MessageSender;

#[MessageSender(messageType: 2)]
class JPushSender extends AbstractMessageSender
{
    /**
     * 极光推送
     * @return bool ...
     */
    protected function execute(): bool
    {
        $appKey = $this->msgParams['server']['appKey'] ?? '';
        $appSecret = $this->msgParams['server']['appSecret'] ?? '';
        $title = $this->msgParams['title'] ?? '';
        $content = $this->msgParams['content'] ?? '';
        $phones = array_map('md5', $this->getArrayFromJson('to'));

        $appLinkExt = $this->getArrayFromJson('appLinkExt');
        $notification = $appLinkExt['jpush']['notification'] ?? [];

        if (empty($phones)) {
            return false;
        }

        $client = new Client($appKey, $appSecret, sprintf('%s/jpush-%s.log', BASE_PATH . '/runtime', date('Y-m-d')));
        $push = $client->push();

        $push->setPlatform('all');
        $push->addAlias($phones);
        $push->options(['apns_production' => \Hyperf\Config\config('app_env') === 'production']);

        // android
        $push->androidNotification($content, ['title' => $title, ...$notification]);
        if (isset($notification['intent']['url'])) {
            unset($notification['intent']);
        }
        // ios
        $push->iosNotification(['title' => $title, 'subtitle' => $content], $notification);
        try {
            $push->send();
        } catch (JPushException $e) {
            throw new Exception(sprintf('极光推送失败，code:[%d]，msg:[%s]', $e->getCode(), $e->getMessage()));
        }
        return true;
    }
}
