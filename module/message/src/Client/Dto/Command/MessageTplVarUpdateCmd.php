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

/**
 * MessageTplVarUpdateCmd.
 */
#[DataTransferObject(name: 'MessageTplVar', type: 'command')]
class MessageTplVarUpdateCmd
{
    private int $id;

    /**
     * 分组id.
     */
    private int $groupId;

    /**
     * 唯一识别符（不可重复）.
     */
    private string $uniqid;

    /**
     * 变量类型，0字符串 1list 2map.
     */
    private int $type;

    /**
     * 变量名，模板变量替换时使用.
     */
    private string $name;

    /**
     * 变量label.
     */
    private string $label;

    /**
     * 描述.
     */
    private string $description;

    /**
     * 状态 0不启用 1启用.
     */
    private int $status;

    /**
     * 使用例子，尤其当type=list、map时，应该给出示例说明规范.
     */
    private string $sample;

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
