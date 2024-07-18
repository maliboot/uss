<?php

namespace Uss\Message\Infra\MessageSender;

use Exception;
use Uss\Message\Infra\MessageSender\Annotation\MessageSender;

#[MessageSender(messageType: 16)]
class FeiShuAgentPushSender extends FeiShuBasePushSender
{
    protected function execute(): bool
    {
        //获取参数
        $title = $this->msgParams['title'] ?? '';
        $content = $this->msgParams['content'] ?? '';

        //获取发送内容
        $sendContent = $this->getPostContent($title, $content);

        //获取要发送的人
        $phones = $this->getArrayFromJson('to');
        if (empty($phones)) {
            return false;
        }
        $userList        = $this->getUserIdListByPhone($phones);
        if (empty($userList)) {
            throw new Exception(sprintf('手机号对应的userId不存在%s', json_encode($phones)));
        }
        $userIds = array_column($userList, 'user_id');

        $this->sendBatchAgrentMsg($userIds, $sendContent);
        return true;
    }
}