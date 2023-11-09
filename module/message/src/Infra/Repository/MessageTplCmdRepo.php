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
use Uss\Message\Domain\Repository\MessageTplRepo;
use Uss\Message\Infra\DataObject\MessageTplDO;

/**
 * MessageTplRepositoryImpl.
 */
class MessageTplCmdRepo extends AbstractCommandDBRepository implements MessageTplRepo
{
    public function allByGroupId(int $groupId): array
    {
        return $this->allBy(['group_id', '=', $groupId])->toArray();
    }

    protected function do(): string
    {
        return MessageTplDO::class;
    }
}
