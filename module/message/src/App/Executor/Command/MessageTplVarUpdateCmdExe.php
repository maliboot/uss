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
use Uss\Message\Client\Dto\Command\MessageTplVarUpdateCmd;
use Uss\Message\Domain\Model\MessageTplVar\MessageTplVar;
use Uss\Message\Domain\Repository\MessageTplVarRepo;

/**
 * MessageTplVarUpdateCmdExe.
 */
#[AppService]
class MessageTplVarUpdateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplVarRepo $messageTplVarRepo;

    public function execute(MessageTplVarUpdateCmd $messageTplVarUpdateCmd): EmptyVO
    {
        $params = MessageTplVar::of($messageTplVarUpdateCmd->toArray());
        $this->messageTplVarRepo->update($params);
        return make(EmptyVO::class);
    }
}
