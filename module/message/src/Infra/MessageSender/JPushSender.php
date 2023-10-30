<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Infra\MessageSender;

use Uss\Message\Infra\MessageSender\Annotation\MessageSender;

#[MessageSender(messageType: 2)]
class JPushSender extends AbstractMessageSender
{
    protected function execute(): bool
    {
        // TODO: Implement execute() method.
    }
}
