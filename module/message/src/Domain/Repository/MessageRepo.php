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
use Uss\Message\Domain\Model\Message\Message;

/**
 * MessageRepo.
 */
interface MessageRepo extends CommandRepositoryInterface
{
    public function isExistByRequestId(string $requestId): bool;

    public function findByUniqid(string $uniqid): ?Message;

    public function updatePostStatusByUniqid(int $id, int $postStatus, string $postError = ''): bool;
}
