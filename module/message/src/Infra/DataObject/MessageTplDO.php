<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\DataObject;

use MaliBoot\Cola\Annotation\Database;
use MaliBoot\Database\Annotation\Column;
use Uss\Message\Domain\Model\MessageTplGroup\MessageTpl;

/**
 * 消息模版.
 */
#[Database(softDeletes: true)]
class MessageTplDO
{
    #[Column(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Column(name: 'group_id', type: 'int', desc: '分组id')]
    private int $groupId;

    #[Column(name: 'type', type: 'int', desc: '模板类型0邮件1阿里云短信2App推送4websocket8钉钉群')]
    private int $type;

    #[Column(name: 'title', type: 'string', desc: '模板标题')]
    private string $title;

    #[Column(name: 'content', type: 'string', desc: '模板内容')]
    private string $content;

    #[Column(name: 'content_type', type: 'int', desc: '内容类型0text1html2markdown')]
    private int $contentType;

    #[Column(name: 'app_link_id', type: 'int', desc: 'App推送-跳转页面链接id，type=2时必填')]
    private int $appLinkId;

    #[Column(name: 'server_id', type: 'int', desc: '服务配置id，如机器人服务配置、邮件服务配置等…')]
    private int $serverId;

    #[Column(name: 'sms_template_id', type: 'int', desc: '短信模板配置id，短信时时必填')]
    private int $smsTemplateId;

    #[Column(name: 'phones', type: 'string', desc: '推送手机，type=1、2、8时必填')]
    private string $phones;

    #[Column(name: 'emails', type: 'string', desc: '推送邮箱，type=0时必填')]
    private string $emails;

    #[Column(name: 'status', type: 'int', desc: '模板状态0不启用1启用')]
    private int $status;

    #[Column(name: 'topic', type: 'string', desc: '订阅消费话题，type=4、mqtt等时必填')]
    private string $topic;

    #[Column(name: 'created_id', type: 'int', desc: '创建人id')]
    private int $createdId;

    #[Column(name: 'created_name', type: 'string', desc: '创建人名称')]
    private string $createdName;

    #[Column(name: 'updated_id', type: 'int', desc: '更新人id')]
    private int $updatedId;

    #[Column(name: 'updated_name', type: 'string', desc: '更新人名称')]
    private string $updatedName;

    #[Column(name: 'created_at', type: 'string', desc: '创建时间')]
    private string $createdAt;

    #[Column(name: 'updated_at', type: 'string', desc: '更新时间')]
    private string $updatedAt;

    #[Column(name: 'deleted_at', type: 'string', desc: '删除时间')]
    private string $deletedAt;

    protected function getEntityFQN(): ?string
    {
        return MessageTpl::class;
    }
}
