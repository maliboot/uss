<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Infra\DataObject;

use Hyperf\Database\Model\SoftDeletes;
use MaliBoot\Cola\Annotation\Column;
use MaliBoot\Cola\Annotation\DataObject;
use MaliBoot\Cola\Infra\AbstractDatabaseDO;

/**
 * 消息模板-分组.
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
#[DataObject(name: 'MessageTplGroup', table: 'message_tpl_group', connection: 'default')]
class MessageTplGroupDO extends AbstractDatabaseDO
{
    use SoftDeletes;

    #[Column(name: 'id', desc: '', type: 'int')]
    private int $id;

    #[Column(name: 'uniqid', desc: '唯一识别符（不可重复）', type: 'string')]
    private string $uniqid;

    #[Column(name: 'name', desc: '名称', type: 'string')]
    private string $name;

    #[Column(name: 'description', desc: '描述', type: 'string')]
    private string $description;

    #[Column(name: 'created_id', desc: '创建人id ', type: 'int')]
    private int $createdId;

    #[Column(name: 'created_name', desc: '创建人名称', type: 'string')]
    private string $createdName;

    #[Column(name: 'updated_id', desc: '更新人id  ', type: 'int')]
    private int $updatedId;

    #[Column(name: 'updated_name', desc: '更新人名称 ', type: 'string')]
    private string $updatedName;

    #[Column(name: 'created_at', desc: '创建时间', type: 'string')]
    private string $createdAt;

    #[Column(name: 'updated_at', desc: '更新时间', type: 'string')]
    private string $updatedAt;

    #[Column(name: 'deleted_at', desc: '删除时间', type: 'string')]
    private string $deletedAt;
}
