<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Domain\Repository;

use Uss\Message\Domain\Model\Message\Message;

interface MessageGuzzleRepo
{
    public function send(Message $message, int $delay = 0): bool;
}
