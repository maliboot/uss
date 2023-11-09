<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\Repository;

use MaliBoot\Cola\Infra\AbstractQueryDBRepository;
use MaliBoot\Cola\Infra\QueryDBRepositoryInterface;
use Uss\Message\Infra\DataObject\MessageDO;

/**
 * MessageQueryRepo.
 */
class MessageQryRepo extends AbstractQueryDBRepository implements QueryDBRepositoryInterface
{
    protected function do(): string
    {
        return MessageDO::class;
    }
}
