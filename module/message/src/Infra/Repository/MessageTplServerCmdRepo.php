<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\Repository;

use Hyperf\Collection\Collection;
use MaliBoot\Cola\Infra\AbstractCommandDBRepository;
use Uss\Message\Domain\Repository\MessageTplServerRepo;
use Uss\Message\Infra\DataObject\MessageTplServerDO;

/**
 * MessageTplServerRepositoryImpl.
 */
class MessageTplServerCmdRepo extends AbstractCommandDBRepository implements MessageTplServerRepo
{
    public function allByIdList(array $idList): Collection
    {
        $result = $this->allBy(['id', 'IN', $idList]);
        if ($result === null) {
            return \Hyperf\Collection\collect();
        }
        return $result;
    }

    protected function do(): string
    {
        return MessageTplServerDO::class;
    }
}
