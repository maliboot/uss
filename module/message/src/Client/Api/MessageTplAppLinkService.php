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
use Uss\Message\Client\Dto\Command\MessageTplAppLinkCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplAppLinkUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplAppLinkListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplAppLinkVO;

/**
 * MessageTplAppLinkService.
 */
interface MessageTplAppLinkService
{
    public function listByPage(MessageTplAppLinkListByPageQry $messageTplAppLinkListByPageQry): PageVO;

    public function create(MessageTplAppLinkCreateCmd $messageTplAppLinkCreateCmd): IdVO;

    public function update(MessageTplAppLinkUpdateCmd $messageTplAppLinkUpdateCmd): EmptyVO;

    public function delete(int $id): EmptyVO;

    public function getById(int $id): MessageTplAppLinkVO;
}
