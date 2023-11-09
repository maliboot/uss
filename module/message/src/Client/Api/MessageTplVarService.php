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
use Uss\Message\Client\Dto\Command\MessageTplVarCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplVarUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplVarListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplVarVO;

/**
 * MessageTplVarService.
 */
interface MessageTplVarService
{
    public function listByPage(MessageTplVarListByPageQry $messageTplVarListByPageQry): PageVO;

    public function create(MessageTplVarCreateCmd $messageTplVarCreateCmd): IdVO;

    public function update(MessageTplVarUpdateCmd $messageTplVarUpdateCmd): EmptyVO;

    public function delete(int $id): EmptyVO;

    public function getById(int $id): MessageTplVarVO;
}
