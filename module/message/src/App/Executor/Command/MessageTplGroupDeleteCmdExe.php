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
use Uss\Message\Domain\Repository\MessageTplGroupRepo;

/**
 * MessageTplGroupDeleteCmdExe.
 */
#[AppService]
class MessageTplGroupDeleteCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplGroupRepo $messageTplGroupRepo;

    public function execute(int $id): EmptyVO
    {
        $this->messageTplGroupRepo->delete($id);
        return make(EmptyVO::class);
    }
}
