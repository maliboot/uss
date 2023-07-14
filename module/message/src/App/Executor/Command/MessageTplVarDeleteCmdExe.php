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
use Uss\Message\Domain\Repository\MessageTplVarRepo;

/**
 * MessageTplVarDeleteCmdExe.
 */
#[AppService]
class MessageTplVarDeleteCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplVarRepo $messageTplVarRepo;

    public function execute(int $id): EmptyVO
    {
        $this->messageTplVarRepo->delete($id);
        return make(EmptyVO::class);
    }
}
