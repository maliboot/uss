<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\Repository;

use MaliBoot\Cola\Infra\AbstractCommandDBRepository;
use Uss\Message\Domain\Repository\MessageTplVarRepo;
use Uss\Message\Infra\DataObject\MessageTplVarDO;

/**
 * MessageTplVarRepositoryImpl.
 */
class MessageTplVarCmdRepo extends AbstractCommandDBRepository implements MessageTplVarRepo
{
    protected function do(): string
    {
        return MessageTplVarDO::class;
    }
}
