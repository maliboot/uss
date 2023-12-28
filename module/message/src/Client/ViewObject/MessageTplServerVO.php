<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Client\ViewObject;

use MaliBoot\Dto\Annotation\ViewObject;
use MaliBoot\Lombok\Annotation\Field;

/**
 * MessageTplServerVO.
 */
#[ViewObject(name: 'MessageTplServer')]
class MessageTplServerVO
{
    #[Field(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Field(name: 'uniqid', type: 'string', desc: '唯一识别符（不可重复）')]
    private string $uniqid;

    #[Field(name: 'type', type: 'int', desc: '模板类型0邮件1阿里云短信2App推送4websocket8钉钉群')]
    private int $type;

    #[Field(name: 'name', type: 'string', desc: '名称')]
    private string $name;

    #[Field(name: 'description', type: 'string', desc: '描述')]
    private string $description;

    #[Field(name: 'ddWebhook', type: 'string', desc: '钉钉推送地址')]
    private string $ddWebhook;

    #[Field(name: 'ddSecret', type: 'string', desc: '钉钉密钥')]
    private string $ddSecret;

    #[Field(name: 'mailDsn', type: 'string', desc: '邮件DSN，格式如smtp:user:pass@smtp.example.com:port')]
    private string $mailDsn;

    #[Field(name: 'mailAddress', type: 'string', desc: '邮件地址')]
    private string $mailAddress;

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
