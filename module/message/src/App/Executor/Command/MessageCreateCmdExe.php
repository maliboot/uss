<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\App\Executor\Command;

use MaliBoot\Cola\Annotation\AppService;
use MaliBoot\Cola\App\AbstractExecutor;
use MaliBoot\Di\Annotation\Inject;
use MaliBoot\Dto\IdVO;
use Uss\Message\Client\Dto\Command\MessageCreateCmd;
use Uss\Message\Domain\Model\Message\Message;
use Uss\Message\Domain\Repository\MessageRepo;

/**
 * 消息推送.
 */
#[AppService]
class MessageCreateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageRepo $messageRepo;

    public function execute(MessageCreateCmd $messageCreateCmd): IdVo
    {
        $params = Message::of($messageCreateCmd->toArray());
        $result = $this->messageRepo->create($params);
        return (new IdVO())->setId($result);
    }
}
