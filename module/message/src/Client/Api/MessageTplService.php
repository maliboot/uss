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
use Uss\Message\Client\Dto\Command\MessageTplCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplVO;

/**
 * MessageTplService.
 */
interface MessageTplService
{
    public function listByPage(MessageTplListByPageQry $messageTplListByPageQry): PageVO;

    public function create(MessageTplCreateCmd $messageTplCreateCmd): IdVO;

    public function update(MessageTplUpdateCmd $messageTplUpdateCmd): EmptyVO;

    public function delete(int $id): EmptyVO;

    public function getById(int $id): MessageTplVO;
}
