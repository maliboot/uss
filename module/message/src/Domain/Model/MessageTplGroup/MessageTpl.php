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
use MaliBoot\Cola\Annotation\Field;
use MaliBoot\Cola\Domain\AbstractEntity;
use MaliBoot\Cola\Domain\AggregateRootInterface;
use Uss\Message\Domain\Model\MessageTplAppLink\MessageTplAppLink;
use Uss\Message\Domain\Model\MessageTplServer\MessageTplServer;
use Uss\Message\Domain\Model\MessageTplSmsTemplate\MessageTplSmsTemplate;

/**
 * 消息模版.
 *
 * @method self setContent(string $content) 设置模板内容.
 * @method int getSmsTemplateId() 获取短信模板配置id，短信时时必填.
 * @method self setSmsTemplateId(int $smsTemplateId) 设置短信模板配置id，短信时时必填.
 * @method string getTopic() 获取订阅消费话题，type = 4、mqtt等时必填.
 * @method self setTopic(string $topic) 设置订阅消费话题，type = 4、mqtt等时必填.
 * @method int getId() ...
 * @method self setId(int $id) ...
 * @method int getGroupId() 获取分组id.
 * @method self setGroupId(int $groupId) 设置分组id.
 * @method int getType() 获取模板类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群.
 * @method self setType(int $type) 设置模板类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群.
 * @method string getTitle() 获取模板标题.
 * @method self setTitle(string $title) 设置模板标题.
 * @method string getContent() 获取模板内容.
 * @method self setContentType(int $contentType) 设置内容类型 0text 1html 2markdown.
 * @method int getAppLinkId() 获取App推送-跳转页面链接id，type = 2时必填.
 * @method self setAppLinkId(int $appLinkId) 设置App推送-跳转页面链接id，type = 2时必填.
 * @method int getServerId() 获取服务配置id，如机器人服务配置、邮件服务配置等….
 * @method self setServerId(int $serverId) 设置服务配置id，如机器人服务配置、邮件服务配置等….
 * @method string getPhones() 获取推送手机，type = 1、2、8时必填.
 * @method self setPhones(string $phones) 设置推送手机，type = 1、2、8时必填.
 * @method string getEmails() 获取推送邮箱，type = 0时必填.
 * @method self setEmails(string $emails) 设置推送邮箱，type = 0时必填.
 * @method int getStatus() 获取模板状态 0不启用 1启用.
 * @method self setStatus(int $status) 设置模板状态 0不启用 1启用.
 * @method int getCreatedId() 获取创建人id .
 * @method self setCreatedId(int $createdId) 设置创建人id .
 * @method string getCreatedName() 获取创建人名称.
 * @method self setCreatedName(string $createdName) 设置创建人名称.
 * @method int getUpdatedId() 获取更新人id  .
 * @method self setUpdatedId(int $updatedId) 设置更新人id  .
 * @method string getUpdatedName() 获取更新人名称 .
 * @method self setUpdatedName(string $updatedName) 设置更新人名称 .
 * @method string getCreatedAt() 获取创建时间.
 * @method self setCreatedAt(string $createdAt) 设置创建时间.
 * @method string getUpdatedAt() 获取更新时间.
 * @method self setUpdatedAt(string $updatedAt) 设置更新时间.
 * @method string getDeletedAt() 获取删除时间.
 * @method self setDeletedAt(string $deletedAt) 设置删除时间.
 */
#[AggregateRoot(name: 'MessageTpl', desc: '消息模版')]
class MessageTpl extends AbstractEntity implements AggregateRootInterface
{
    #[Field(name: '')]
    private int $id;

    #[Field(name: '分组id')]
    private int $groupId;

    #[Field(name: '模板类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群')]
    private int $type;

    #[Field(name: '模板标题')]
    private string $title;

    #[Field(name: '模板内容')]
    private string $content;

    #[Field(name: 'App推送-跳转页面链接id，type=2时必填')]
    private int $appLinkId;

    /**
     * @var MessageTplAppLink App推送-跳转页面链接id，type=2时必填
     */
    private MessageTplAppLink $appLink;

    #[Field(name: '短信模板配置id，短信时时必填')]
    private int $smsTemplateId;

    /**
     * @var MessageTplSmsTemplate 服务配置，如机器人服务配置、邮件服务配置等…
     */
    private MessageTplSmsTemplate $messageTplSmsTemplate;

    #[Field(name: '服务配置id，如机器人服务配置、邮件服务配置等…')]
    private int $serverId;

    /**
     * @var MessageTplServer 服务配置，如机器人服务配置、邮件服务配置等…
     */
    private MessageTplServer $server;

    #[Field(name: '推送手机，type=1、2、8时必填')]
    private string $phones;

    #[Field(name: '推送邮箱，type=0时必填')]
    private string $emails;

    #[Field(name: '订阅消费话题，type=4、mqtt等时必填')]
    private string $topic;

    #[Field(name: '模板状态 0不启用 1启用')]
    private int $status;

    #[Field(name: '创建人id ')]
    private int $createdId;

    #[Field(name: '创建人名称')]
    private string $createdName;

    #[Field(name: '更新人id  ')]
    private int $updatedId;

    #[Field(name: '更新人名称 ')]
    private string $updatedName;

    #[Field(name: '创建时间')]
    private string $createdAt;

    #[Field(name: '更新时间')]
    private string $updatedAt;

    #[Field(name: '删除时间')]
    private string $deletedAt;

    public function getAppLink(): MessageTplAppLink
    {
        return $this->appLink;
    }

    public function setAppLink(MessageTplAppLink $appLink): void
    {
        $this->appLink = $appLink;
    }

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

    public function getAppLinkUrl(string $default = ''): string
    {
        if (! $this->isPropertyInitialized('appLink')) {
            return $default;
        }
        if (! $this->getAppLink()->getStatus()) {
            return '';
        }
        $url = $this->getAppLink()->getLink();
        if ($url === null) {
            return '';
        }
        return $url;
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
        switch ($this->type) {
            case 0:
                return $this->getMailsArray();
            case 1:
            case 2:
            case 8:
                return $this->getPhonesArray();
            case 4:
                return [$this->getTopic()];
            default:
                return [];
        }
    }

    public function getToListJson(): string
    {
        return json_encode($this->getToList());
    }
}
