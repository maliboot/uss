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
 * MessageTplGroupCreateCmd.
 */
#[DataTransferObject(name: 'MessageTplGroup', type: 'command')]
class MessageTplGroupCreateCmd
{
    #[Field(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Field(name: 'uniqid', type: 'string', desc: '唯一识别符（不可重复）')]
    private string $uniqid;

    #[Field(name: 'name', type: 'string', desc: '名称')]
    private string $name;

    #[Field(name: 'description', type: 'string', desc: '描述')]
    private string $description;

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
