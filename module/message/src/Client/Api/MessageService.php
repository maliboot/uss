<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Client\Api;

use MaliBoot\Dto\EmptyVO;
use MaliBoot\Dto\IdVO;
use MaliBoot\Dto\PageVO;
use Uss\Message\Client\Dto\Command\MessageCreateCmd;
use Uss\Message\Client\Dto\Command\MessageUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageListByPageQry;
use Uss\Message\Client\ViewObject\MessageVO;

/**
 * MessageService.
 */
interface MessageService
{
    public function listByPage(MessageListByPageQry $messageListByPageQry): PageVO;

    public function create(MessageCreateCmd $messageCreateCmd): IdVO;

    public function update(MessageUpdateCmd $messageUpdateCmd): EmptyVO;

    public function delete(int $id): EmptyVO;

    public function getById(int $id): MessageVO;
}
