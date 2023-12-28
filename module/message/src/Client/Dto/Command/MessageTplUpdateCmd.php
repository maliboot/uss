<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Client\Dto\Command;

use MaliBoot\Dto\Annotation\DataTransferObject;
use MaliBoot\Lombok\Annotation\Field;

/**
 * MessageTplUpdateCmd.
 */
#[DataTransferObject(name: 'MessageTpl', type: 'command')]
class MessageTplUpdateCmd
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

    #[Field(name: 'contentType', type: 'int', desc: '内容类型0text1html2markdown')]
    private int $contentType;

    #[Field(name: 'appLinkId', type: 'int', desc: 'App推送-跳转页面链接id，type=2时必填')]
    private int $appLinkId;

    #[Field(name: 'serverId', type: 'int', desc: '服务配置id，如机器人服务配置、邮件服务配置等…')]
    private int $serverId;

    #[Field(name: 'phones', type: 'string', desc: '推送手机，type=1、2、8时必填')]
    private string $phones;

    #[Field(name: 'emails', type: 'string', desc: '推送邮箱，type=0时必填')]
    private string $emails;

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
}
