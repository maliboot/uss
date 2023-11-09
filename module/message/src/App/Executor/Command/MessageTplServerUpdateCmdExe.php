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
use Uss\Message\Client\Dto\Command\MessageTplServerUpdateCmd;
use Uss\Message\Domain\Model\MessageTplServer\MessageTplServer;
use Uss\Message\Domain\Repository\MessageTplServerRepo;

/**
 * MessageTplServerUpdateCmdExe.
 */
#[AppService]
class MessageTplServerUpdateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplServerRepo $messageTplServerRepo;

    public function execute(MessageTplServerUpdateCmd $messageTplServerUpdateCmd): EmptyVO
    {
        $params = MessageTplServer::of($messageTplServerUpdateCmd->toArray());
        $this->messageTplServerRepo->update($params);
        return make(EmptyVO::class);
    }
}
