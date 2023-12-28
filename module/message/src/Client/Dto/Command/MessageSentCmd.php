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

#[DataTransferObject(name: 'MessageSentCmd', type: 'command')]
class MessageSentCmd
{
    #[Field(name: 'messageUniqid', type: 'string', desc: '消息标识')]
    private string $messageUniqid;

    #[Field(name: 'postState', type: 'int', desc: '发送状态：0待发送1已发送2发送失败')]
    private int $postState;

    #[Field(name: 'postError', type: 'string', desc: '发送失败错误信息')]
    private string $postError = '';
}
