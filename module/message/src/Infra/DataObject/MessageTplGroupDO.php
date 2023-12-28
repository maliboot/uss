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

/**
 * 消息模板-分组.
 */
#[Database(softDeletes: true)]
class MessageTplGroupDO
{
    #[Column(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Column(name: 'uniqid', type: 'string', desc: '唯一识别符（不可重复）')]
    private string $uniqid;

    #[Column(name: 'name', type: 'string', desc: '名称')]
    private string $name;

    #[Column(name: 'description', type: 'string', desc: '描述')]
    private string $description;

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
}
