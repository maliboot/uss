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
use Uss\Message\Client\Dto\Command\MessageTplGroupCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplGroupUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplGroupListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplGroupVO;

/**
 * MessageTplGroupService.
 */
interface MessageTplGroupService
{
    public function listByPage(MessageTplGroupListByPageQry $messageTplGroupListByPageQry): PageVO;

    public function create(MessageTplGroupCreateCmd $messageTplGroupCreateCmd): IdVO;

    public function update(MessageTplGroupUpdateCmd $messageTplGroupUpdateCmd): EmptyVO;

    public function delete(int $id): EmptyVO;

    public function getById(int $id): MessageTplGroupVO;
}
