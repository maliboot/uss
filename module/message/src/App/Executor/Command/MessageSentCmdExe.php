<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\App\Executor\Command;

use GuzzleHttp\Exception\GuzzleException;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Logger\LoggerFactory;
use MaliBoot\Cola\Annotation\AppService;
use MaliBoot\Cola\App\AbstractExecutor;
use MaliBoot\Di\Annotation\Inject;
use Uss\Message\Client\Dto\Command\MessageSentCmd;
use Uss\Message\Client\ViewObject\ResultVO;
use Uss\Message\Domain\Repository\MessageRepo;

use function Hyperf\Support\make;

/**
 * 消息推送.
 */
#[AppService]
class MessageSentCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageRepo $messageRepo;

    public function execute(MessageSentCmd $messageSentCmd): ResultVO
    {
        $result = make(ResultVO::class);
        $logger = $this->container->get(LoggerFactory::class)->get(static::class);
        $data = $this->messageRepo->findByUniqid($messageSentCmd->getMessageUniqid());

        if ($data === null) {
            $falseMsg = sprintf('msgSentListenerErr:message[%s]不存在', $messageSentCmd->getMessageUniqid());
            $logger->error($falseMsg);
            return $result->setMsg($falseMsg);
        }

        // 更新发送状态
        $this->messageRepo->updatePostStatusByUniqid($data->getId(), $messageSentCmd->getPostState(), $messageSentCmd->getPostError());

        // callback
        if (! empty($data->getBizCallbackUrl())) {
            $client = $this->container->get(ClientFactory::class)->create(['timeout' => 5]);
            try {
                $client->post($data->getBizCallbackUrl(), ['json' => json_encode($data->toArray())]);
            } catch (GuzzleException $e) {
                $falseMsg = sprintf('MessageCallbackPostErr:msg::%s, trace::%s', $e->getMessage(), $e->getTraceAsString());
                $logger->error($falseMsg);
            }
        }
        return $result->setResult(true);
    }
}
