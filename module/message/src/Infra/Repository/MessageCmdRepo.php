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
use Uss\Message\Domain\Model\Message\Message;
use Uss\Message\Domain\Repository\MessageRepo;
use Uss\Message\Infra\DataObject\MessageDO;

/**
 * MessageRepositoryImpl.
 */
class MessageCmdRepo extends AbstractCommandDBRepository implements MessageRepo
{
    public function isExistByRequestId(string $requestId): bool
    {
        $result = $this->findBy('request_id', $requestId);
        return $result !== null;
    }

    public function findByUniqid(string $uniqid): ?Message
    {
        $data = $this->findBy('uniqid', $uniqid);
        if (! $data instanceof Message) {
            return null;
        }
        return $data;
    }

    public function updatePostStatusByUniqid(int $id, int $postStatus, string $postError = ''): bool
    {
        $updateEntity = \Hyperf\Support\make(Message::class)->setId($id)->setPostState($postStatus);
        $updateEntity->setPostTime(date('Y-m-d H:i:s'));
        $updateEntity->setPostError($postError);
        return $this->update($updateEntity);
    }

    protected function do(): string
    {
        return MessageDO::class;
    }
}
