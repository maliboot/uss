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
 * MessageTplVarUpdateCmd.
 */
#[DataTransferObject(name: 'MessageTplVar', type: 'command')]
class MessageTplVarUpdateCmd
{
    #[Field(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Field(name: 'groupId', type: 'int', desc: '分组id')]
    private int $groupId;

    #[Field(name: 'uniqid', type: 'string', desc: '唯一识别符（不可重复）')]
    private string $uniqid;

    #[Field(name: 'type', type: 'int', desc: '变量类型，0字符串1list2map')]
    private int $type;

    #[Field(name: 'name', type: 'string', desc: '变量名，模板变量替换时使用')]
    private string $name;

    #[Field(name: 'label', type: 'string', desc: '变量label')]
    private string $label;

    #[Field(name: 'description', type: 'string', desc: '描述')]
    private string $description;

    #[Field(name: 'status', type: 'int', desc: '状态0不启用1启用')]
    private int $status;

    #[Field(name: 'sample', type: 'string', desc: '使用例子，尤其当type=list、map时，应该给出示例说明规范')]
    private string $sample;

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
