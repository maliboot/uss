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
 * 消息模板-变量.
 */
#[Database(softDeletes: true)]
class MessageTplVarDO
{
    #[Column(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Column(name: 'group_id', type: 'int', desc: '分组id')]
    private int $groupId;

    #[Column(name: 'uniqid', type: 'string', desc: '唯一识别符（不可重复）')]
    private string $uniqid;

    #[Column(name: 'type', type: 'int', desc: '变量类型，0字符串1list2map')]
    private int $type;

    #[Column(name: 'name', type: 'string', desc: '变量名，模板变量替换时使用')]
    private string $name;

    #[Column(name: 'label', type: 'string', desc: '变量label')]
    private string $label;

    #[Column(name: 'description', type: 'string', desc: '描述')]
    private string $description;

    #[Column(name: 'status', type: 'int', desc: '状态0不启用1启用')]
    private int $status;

    #[Column(name: 'sample', type: 'string', desc: '使用例子，尤其当type=list、map时，应该给出示例说明规范')]
    private string $sample;

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
