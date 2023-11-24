<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\Repository;

use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\AsyncQueue\Driver\DriverInterface;
use Hyperf\Di\Annotation\AnnotationCollector;
use Uss\Message\Domain\Model\Message\Message;
use Uss\Message\Domain\Repository\MessageGuzzleRepo;
use Uss\Message\Infra\MessageSender\AbstractMessageSender;
use Uss\Message\Infra\MessageSender\Annotation\MessageSender;

class MessageGuzzleCmdRepo implements MessageGuzzleRepo
{
    protected DriverInterface $driver;

    public function __construct(DriverFactory $driverFactory)
    {
        $this->driver = $driverFactory->get('default');
    }

    public function send(Message $message, int $delay = 0): bool
    {
        $senders = $this->getSenders();
        if (! isset($senders[$message->getType()])) {
            return false;
        }
        $sendClassName = $senders[$message->getType()]['className'];
        $sendParams = $message->toArray();
        /** @var AbstractMessageSender $sender */
        $sender = new $sendClassName($message->getUniqid(), $sendParams);
        $this->driver->push($sender, $delay);
        return true;
    }

    /**
     * @return array 适配器集合，如 $result[$messageType]['className'] 为适配器类名称
     */
    protected function getSenders(): array
    {
        $senders = AnnotationCollector::getClassesByAnnotation(MessageSender::class);
        $result = [];
        foreach ($senders as $senderClassName => $sender) {
            $resultItem = [
                'className' => $senderClassName,
                'priority' => $sender->priority,
            ];
            if (! isset($result[$sender->messageType])) {
                $result[$sender->messageType] = $resultItem;
                continue;
            }
            if ($sender->priority > $result[$sender->messageType]['priority']) {
                $result[$sender->messageType] = $resultItem;
            }
        }
        return $result;
    }
}
