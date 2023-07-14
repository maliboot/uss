<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Domain\Service;

use Hyperf\Collection\Collection;
use MaliBoot\Di\Annotation\Inject;
use Uss\Message\Domain\Model\Message\Message;
use Uss\Message\Domain\Repository\MessageGuzzleRepo;

class MessageDomainService
{
    #[Inject]
    protected MessageGuzzleRepo $guzzleRepo;

    public function sendList(Collection $messageEntities): void
    {
        foreach ($messageEntities as $messageEntity) {
            /* @var Message $messageEntity ... */
            $this->guzzleRepo->send($messageEntity, $messageEntity->getPostPlanDelay());
        }
    }
}
