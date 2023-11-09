<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Domain\Repository;

use MaliBoot\Cola\Domain\CommandRepositoryInterface;
use Uss\Message\Domain\Model\MessageTplGroup\MessageTplGroup;

/**
 * MessageTplGroupRepo.
 */
interface MessageTplGroupRepo extends CommandRepositoryInterface
{
    public function findByUniqid(string $uniqid): ?MessageTplGroup;
}
