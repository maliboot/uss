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
use Uss\Message\Client\Dto\Command\MessageTplServerCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplServerUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplServerListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplServerVO;

/**
 * MessageTplServerService.
 */
interface MessageTplServerService
{
    public function listByPage(MessageTplServerListByPageQry $messageTplServerListByPageQry): PageVO;

    public function create(MessageTplServerCreateCmd $messageTplServerCreateCmd): IdVO;

    public function update(MessageTplServerUpdateCmd $messageTplServerUpdateCmd): EmptyVO;

    public function delete(int $id): EmptyVO;

    public function getById(int $id): MessageTplServerVO;
}
