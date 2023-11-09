<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\MessageSender;

use JPush\Client;
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
        $msgId = $this->msgParams['id'] ?? 0;
        $appKey = $this->msgParams['server']['appKey'] ?? '';
        $appSecret = $this->msgParams['server']['appSecret'] ?? '';
        $title = $this->msgParams['title'] ?? '';
        $content = $this->msgParams['content'] ?? '';
        $phones = array_map('md5', $this->getArrayFromJson('to'));
        $sound = $this->msgParams['appLink']['sound'] ?? '';
        $bizExt = $this->getArrayFromJson('bizExt');
        $openUrl = $this->msgParams['appLink']['uri'] ?? '';
        $androidUriActivity = $this->msgParams['appLink']['androidUriActivity'] ?? '';
        if (! empty($openUrl) && ! empty($bizExt)) {
            $openUrl .= '?' . http_build_query($bizExt);
        }
        if (empty($phones)) {
            return false;
        }

        $client = new Client($appKey, $appSecret, sprintf('%s/jpush-%s.log', BASE_PATH . '/runtime', date('Y-m-d')));
        $push = $client->push();

        $push->setPlatform('all');
        $push->addAlias($phones);
        $push->options(['apns_production' => \Hyperf\Config\config('app_env') === 'production']);

        $notification = [
            'sound' => $sound,
            'extras' => [
                'message_id' => $msgId,
                'open_url' => $openUrl,
                'biz_id' => $this->msgParams['bizId'] ?? 0,
                'biz_no' => $this->msgParams['bizNo'] ?? '',
                'biz_type' => $this->msgParams['bizType'] ?? '',
            ],
        ];
        $push->iosNotification(['title' => $title, 'subtitle' => $content], $notification);

        if (! empty($androidUriActivity) && str_contains($androidUriActivity, '://')) {
            if (str_contains($androidUriActivity, '?')) {
                $androidUriActivity .= '&open_url=' . urlencode($openUrl);
            } else {
                $androidUriActivity .= '?open_url=' . urlencode($openUrl);
            }
            $notification['intent']['url'] = $androidUriActivity;
        }
        $push->androidNotification($content, ['title' => $title, ...$notification]);

        $push->send();
        return true;
    }
}
