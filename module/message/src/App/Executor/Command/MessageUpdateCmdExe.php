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
use MaliBoot\Dto\EmptyVO;
use Uss\Message\Client\Dto\Command\MessageUpdateCmd;
use Uss\Message\Domain\Model\Message\Message;
use Uss\Message\Domain\Repository\MessageRepo;

/**
 * MessageUpdateCmdExe.
 */
#[AppService]
class MessageUpdateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageRepo $messageRepo;

    public function execute(MessageUpdateCmd $messageUpdateCmd): EmptyVO
    {
        $params = Message::of($messageUpdateCmd->toArray());
        $this->messageRepo->update($params);
        return make(EmptyVO::class);
    }
}
