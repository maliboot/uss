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
        $title = $this->msgParams['title'] ?? '';
        $content = $this->msgParams['content'] ?? '';

        //获取内容
        $sendContent = $this->getContent($title, $content);

        //获取要发送的人
        $phones = $this->getArrayFromJson('to');
        if (empty($phones)) {
            return false;
        }
        $userIds        = $this->getUserIdListByPhone($phones);

        $this->sendAgentMsg([
            'userIds' => $userIds,
            'msg' => $sendContent,
        ]);
        return true;
    }
}
