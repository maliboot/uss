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

#[DataTransferObject(name: 'MessageSentCmd', type: 'command')]
class MessageSentCmd
{
    /**
     * 消息标识.
     */
    private string $messageUniqid;

    /**
     * 发送状态：0待发送 1已发送 2发送失败.
     */
    private int $postState;

    /**
     * 发送失败错误信息.
     */
    private string $postError = '';
}
