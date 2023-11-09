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
use Uss\Message\Domain\Model\MessageTplGroup\MessageTpl;

/**
 * MessageTplRepo.
 */
interface MessageTplRepo extends CommandRepositoryInterface
{
    /**
     * @param int $groupId ...
     * @return MessageTpl[] ...
     */
    public function allByGroupId(int $groupId): array;
}
