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
 * MessageTplSmsTemplateCreateCmd.
 */
#[DataTransferObject(name: 'MessageTplSmsTemplate', type: 'command')]
class MessageTplSmsTemplateCreateCmd
{
    private int $id;

    /**
     * 服务id.
     */
    private int $serverId;

    /**
     * 名称.
     */
    private string $name;

    /**
     * 描述.
     */
    private string $description;

    /**
     * 签名.
     */
    private string $sign;

    /**
     * 模板code.
     */
    private string $code;

    /**
     * 状态 0不启用 1启用.
     */
    private int $status;

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
