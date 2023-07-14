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
use Uss\Message\Domain\Model\MessageTplAppLink\MessageTplAppLink;
use Uss\Message\Domain\Repository\MessageTplAppLinkRepo;
use Uss\Message\Infra\DataObject\MessageTplAppLinkDO;

/**
 * MessageTplAppLinkRepositoryImpl.
 */
class MessageTplAppLinkCmdRepo extends AbstractCommandDBRepository implements MessageTplAppLinkRepo
{
    public function findById(int $id): ?MessageTplAppLink
    {
        $entity = $this->find($id);
        if ($entity instanceof MessageTplAppLink) {
            return $entity;
        }
        return null;
    }

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
        return MessageTplAppLinkDO::class;
    }
}
