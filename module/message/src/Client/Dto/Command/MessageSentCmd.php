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
 * @method string getMessageUniqid() 获取消息标识.
 * @method self setMessageUniqid(string $messageUniqid) 设置消息标识.
 * @method int getPostState() 获取发送状态：0待发送 1已发送 2发送失败.
 * @method self setPostState(int $postState) 设置发送状态：0待发送 1已发送 2发送失败.
 * @method self setPostError(string $postError) 设置发送失败错误信息.
 * @method string getPostError() 获取发送失败错误信息.
 */
#[DataTransferObject(name: 'MessageSentCmd', type: 'command')]
class MessageSentCmd extends AbstractCommand
{
    #[Field(name: '消息标识', type: 'string')]
    private string $messageUniqid;

    #[Field(name: '发送状态：0待发送 1已发送 2发送失败', type: 'string')]
    private int $postState;

    #[Field(name: '发送失败错误信息', type: 'string')]
    private string $postError = '';
}
