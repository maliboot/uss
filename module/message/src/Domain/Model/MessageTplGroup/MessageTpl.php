<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Domain\Model\MessageTplGroup;

use MaliBoot\Cola\Annotation\AggregateRoot;
use MaliBoot\Lombok\Annotation\Field;
use Uss\Message\Domain\Model\MessageTplAppLink\MessageTplAppLink;
use Uss\Message\Domain\Model\MessageTplServer\MessageTplServer;
use Uss\Message\Domain\Model\MessageTplSmsTemplate\MessageTplSmsTemplate;

/**
 * 消息模版.
 */
#[AggregateRoot(name: 'MessageTpl', desc: '消息模版')]
class MessageTpl
{
    #[Field(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Field(name: 'groupId', type: 'int', desc: '分组id')]
    private int $groupId;

    #[Field(name: 'type', type: 'int', desc: '模板类型0邮件1阿里云短信2App推送4websocket8钉钉群')]
    private int $type;

    #[Field(name: 'title', type: 'string', desc: '模板标题')]
    private string $title;

    #[Field(name: 'content', type: 'string', desc: '模板内容')]
    private string $content;

    #[Field(name: 'appLinkId', type: 'int', desc: 'App推送-跳转页面链接id，type=2时必填')]
    private int $appLinkId;

    #[Field(name: 'appLink', type: MessageTplAppLink::class, desc: '@varMessageTplAppLinkApp推送-跳转页面链接id，type=2时必填')]
    private MessageTplAppLink $appLink;

    #[Field(name: 'smsTemplateId', type: 'int', desc: '短信模板配置id，短信时时必填')]
    private int $smsTemplateId;

    #[Field(name: 'messageTplSmsTemplate', type: MessageTplSmsTemplate::class, desc: '@varMessageTplSmsTemplate服务配置，如机器人服务配置、邮件服务配置等…')]
    private MessageTplSmsTemplate $messageTplSmsTemplate;

    #[Field(name: 'serverId', type: 'int', desc: '服务配置id，如机器人服务配置、邮件服务配置等…')]
    private int $serverId;

    #[Field(name: 'server', type: MessageTplServer::class, desc: '@varMessageTplServer服务配置，如机器人服务配置、邮件服务配置等…')]
    private MessageTplServer $server;

    #[Field(name: 'phones', type: 'string', desc: '推送手机，type=1、2、8时必填')]
    private string $phones;

    #[Field(name: 'emails', type: 'string', desc: '推送邮箱，type=0时必填')]
    private string $emails;

    #[Field(name: 'topic', type: 'string', desc: '订阅消费话题，type=4、mqtt等时必填')]
    private string $topic;

    #[Field(name: 'status', type: 'int', desc: '模板状态0不启用1启用')]
    private int $status;

    #[Field(name: 'createdId', type: 'int', desc: '创建人id')]
    private int $createdId;

    #[Field(name: 'createdName', type: 'string', desc: '创建人名称')]
    private string $createdName;

    #[Field(name: 'updatedId', type: 'int', desc: '更新人id')]
    private int $updatedId;

    #[Field(name: 'updatedName', type: 'string', desc: '更新人名称')]
    private string $updatedName;

    #[Field(name: 'createdAt', type: 'string', desc: '创建时间')]
    private string $createdAt;

    #[Field(name: 'updatedAt', type: 'string', desc: '更新时间')]
    private string $updatedAt;

    #[Field(name: 'deletedAt', type: 'string', desc: '删除时间')]
    private string $deletedAt;

    public function getServer(): MessageTplServer
    {
        return $this->server;
    }

    public function setServer(MessageTplServer $server): static
    {
        $this->server = $server;
        return $this;
    }

    public function getMessageTplSmsTemplate(): ?MessageTplSmsTemplate
    {
        if (! $this->isPropertyInitialized('messageTplSmsTemplate')) {
            return null;
        }
        return $this->messageTplSmsTemplate;
    }

    public function setMessageTplSmsTemplate(MessageTplSmsTemplate $messageTplSmsTemplate): void
    {
        $this->messageTplSmsTemplate = $messageTplSmsTemplate;
    }

    public function getBladeTemplate(): string
    {
        $msgTplContent = $this->getContent() ? $this->getContent() : '';
        $fileM5 = md5($msgTplContent);
        $file = sprintf('%s%s.blade.php', \Hyperf\Config\config('view.config.view_path'), $fileM5);
        if (! file_exists($file)) {
            file_put_contents($file, $msgTplContent);
        }
        return $fileM5;
    }

    public function getAppLink(): ?MessageTplAppLink
    {
        if (! $this->isPropertyInitialized('appLink')) {
            return null;
        }
        if (! $this->appLink->getStatus()) {
            return null;
        }
        return $this->appLink;
    }

    public function getMessageForm(): string
    {
        switch ($this->type) {
            case 0:
                return $this->server->getMailAddress();
            default:
                return $this->server->getUniqid();
        }
    }

    public function getPhonesArray(): array
    {
        $phones = $this->getPhones();
        if (empty($phones)) {
            return [];
        }
        return json_decode($phones, true);
    }

    public function getMailsArray(): array
    {
        $mails = $this->getEmails();
        if (empty($mails)) {
            return [];
        }
        return json_decode($mails, true);
    }

    public function getToList(): array
    {
        return match ($this->type) {
            0 => $this->getMailsArray(),
            1, 2, 8 => $this->getPhonesArray(),
            4 => [$this->getTopic()],
            default => [],
        };
    }

    public function getToListJson(): string
    {
        return json_encode($this->getToList());
    }
}
