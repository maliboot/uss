<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Adapter\Listener;

use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Uss\Message\App\Executor\Command\MessageSentCmdExe;
use Uss\Message\Client\Dto\Command\MessageSentCmd;

#[Listener]
class MessageSentListener implements ListenerInterface
{
    public function listen(): array
    {
        // 返回一个该监听器要监听的事件数组，可以同时监听多个事件
        return [
            MessageSentCmd::class,
        ];
    }

    public function process(object $event): void
    {
        if ($event instanceof MessageSentCmd) {
            \Hyperf\Support\make(MessageSentCmdExe::class)->execute($event);
        }
    }
}
