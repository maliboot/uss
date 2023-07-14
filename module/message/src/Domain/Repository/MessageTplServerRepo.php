<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Domain\Repository;

use Hyperf\Collection\Collection;
use MaliBoot\Cola\Domain\CommandRepositoryInterface;
use Uss\Message\Domain\Model\MessageTplServer\MessageTplServer;

/**
 * MessageTplServerRepo.
 */
interface MessageTplServerRepo extends CommandRepositoryInterface
{
    /**
     * @param array $idList ...
     * @return Collection<MessageTplServer> ...
     */
    public function allByIdList(array $idList): Collection;
}
