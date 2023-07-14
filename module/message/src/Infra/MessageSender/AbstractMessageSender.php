<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Infra\MessageSender;

use Exception;
use Hyperf\AsyncQueue\Job;
use Hyperf\Context\ApplicationContext;
use Hyperf\Logger\LoggerFactory;
use Psr\EventDispatcher\EventDispatcherInterface;
use Uss\Message\Client\Dto\Command\MessageSentCmd;

abstract class AbstractMessageSender extends Job
{
    /**
     * @param string $msgUniqid 消息标识，可参考\Uss\Message\Domain\Model\Message\Message::uniqid
     * @param array $msgParams 消息参数，可参考\Uss\Message\Domain\Model\Message\Message::class
     */
    public function __construct(
        private string $msgUniqid,
        protected array $msgParams,
    ) {
    }

    public function handle()
    {
        $container = ApplicationContext::getContainer();
        $logger = $container->get(LoggerFactory::class)->get(static::class);
        $result = false;
        $resultMsg = '发送成功';
        try {
            $result = $this->execute();
        } catch (Exception $e) {
            $resultMsg = $e->getMessage();
            $logger->error(sprintf('messageJobErr:msg::%s;trace::%s', $e->getMessage(), $e->getTraceAsString()));
        }

        $msg = new MessageSentCmd();
        $msg->setMessageUniqid($this->msgUniqid);
        $msg->setPostState($result ? 1 : 2);
        $msg->setPostError($resultMsg);
        $container->get(EventDispatcherInterface::class)->dispatch($msg);
    }

    protected function getArrayFromJson(string $key): array
    {
        if (empty($this->msgParams[$key])) {
            return [];
        }
        $result = json_decode($this->msgParams[$key], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }
        return $result;
    }

    abstract protected function execute(): bool;
}
