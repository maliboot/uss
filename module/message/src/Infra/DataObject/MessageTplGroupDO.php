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

/**
 * 消息模板-分组.
 */
#[Database(softDeletes: true)]
class MessageTplGroupDO
{
    private int $id;

    /**
     * 唯一识别符（不可重复）.
     */
    private string $uniqid;

    /**
     * 名称.
     */
    private string $name;

    /**
     * 描述.
     */
    private string $description;

    /**
     * 创建人id.
     */
    private int $createdId;

    /**
     * 创建人名称.
     */
    private string $createdName;

    /**
     * 更新人id.
     */
    private int $updatedId;

    /**
     * 更新人名称.
     */
    private string $updatedName;

    /**
     * 创建时间.
     */
    private string $createdAt;

    /**
     * 更新时间.
     */
    private string $updatedAt;

    /**
     * 删除时间.
     */
    private string $deletedAt;
}
