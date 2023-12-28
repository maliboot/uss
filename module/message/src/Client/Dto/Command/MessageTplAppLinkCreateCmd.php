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
 * MessageTplAppLinkCreateCmd.
 */
#[DataTransferObject(name: 'MessageTplAppLink', type: 'command')]
class MessageTplAppLinkCreateCmd
{
    #[Field(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Field(name: 'name', type: 'string', desc: '名称')]
    private string $name;

    #[Field(name: 'description', type: 'string', desc: '描述')]
    private string $description;

    #[Field(name: 'link', type: 'string', desc: '链接')]
    private string $link;

    #[Field(name: 'androidUriActivity', type: 'string', desc: 'Andorid专用跳转参数，如极光推送时为uri_activity=xxxx')]
    private string $androidUriActivity;

    #[Field(name: 'sound', type: 'string', desc: '铃声')]
    private string $sound;

    #[Field(name: 'status', type: 'int', desc: '状态0不启用1启用')]
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
