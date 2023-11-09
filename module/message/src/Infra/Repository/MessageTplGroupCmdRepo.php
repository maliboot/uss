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
use Uss\Message\Domain\Model\MessageTplGroup\MessageTplGroup;
use Uss\Message\Domain\Repository\MessageTplGroupRepo;
use Uss\Message\Infra\DataObject\MessageTplGroupDO;

/**
 * MessageTplGroupRepositoryImpl.
 */
class MessageTplGroupCmdRepo extends AbstractCommandDBRepository implements MessageTplGroupRepo
{
    public function findByUniqid(string $uniqid): ?MessageTplGroup
    {
        $entity = $this->findBy('uniqid', $uniqid);
        if ($entity instanceof MessageTplGroup) {
            return $entity;
        }
        return null;
    }

    protected function do(): string
    {
        return MessageTplGroupDO::class;
    }
}
