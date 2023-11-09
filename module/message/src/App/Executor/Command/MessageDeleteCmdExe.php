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
use Uss\Message\Domain\Repository\MessageRepo;

/**
 * MessageDeleteCmdExe.
 */
#[AppService]
class MessageDeleteCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageRepo $messageRepo;

    public function execute(int $id): EmptyVO
    {
        $this->messageRepo->delete($id);
        return make(EmptyVO::class);
    }
}
