<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Client\Dto\Command;

use MaliBoot\Dto\AbstractCommand;
use MaliBoot\Dto\Annotation\DataTransferObject;
use MaliBoot\Dto\Annotation\Field;

/**
 * MessageTplGroupCreateCmd.
 *
 * @method int getId() ...
 * @method self setId(int $id) ...
 * @method string getUniqid() 获取唯一识别符（不可重复）.
 * @method self setUniqid(string $uniqid) 设置唯一识别符（不可重复）.
 * @method string getName() 获取名称.
 * @method self setName(string $name) 设置名称.
 * @method string getDescription() 获取描述.
 * @method self setDescription(string $description) 设置描述.
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
#[DataTransferObject(name: 'MessageTplGroup', type: 'command')]
class MessageTplGroupCreateCmd extends AbstractCommand
{
    #[Field(name: '', type: 'int')]
    private int $id;

    #[Field(name: '唯一识别符（不可重复）', type: 'string')]
    private string $uniqid;

    #[Field(name: '名称', type: 'string')]
    private string $name;

    #[Field(name: '描述', type: 'string')]
    private string $description;

    #[Field(name: '创建人id ', type: 'int')]
    private int $createdId;

    #[Field(name: '创建人名称', type: 'string')]
    private string $createdName;

    #[Field(name: '更新人id  ', type: 'int')]
    private int $updatedId;

    #[Field(name: '更新人名称 ', type: 'string')]
    private string $updatedName;

    #[Field(name: '创建时间', type: 'string')]
    private string $createdAt;

    #[Field(name: '更新时间', type: 'string')]
    private string $updatedAt;

    #[Field(name: '删除时间', type: 'string')]
    private string $deletedAt;
}
