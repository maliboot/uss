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
use Uss\Message\Domain\Repository\MessageTplRepo;

/**
 * MessageTplDeleteCmdExe.
 */
#[AppService]
class MessageTplDeleteCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplRepo $messageTplRepo;

    public function execute(int $id): EmptyVO
    {
        $this->messageTplRepo->delete($id);
        return make(EmptyVO::class);
    }
}
