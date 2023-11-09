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
use Uss\Message\Client\Dto\Command\MessageTplUpdateCmd;
use Uss\Message\Domain\Model\MessageTplGroup\MessageTpl;
use Uss\Message\Domain\Repository\MessageTplRepo;

/**
 * MessageTplUpdateCmdExe.
 */
#[AppService]
class MessageTplUpdateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplRepo $messageTplRepo;

    public function execute(MessageTplUpdateCmd $messageTplUpdateCmd): EmptyVO
    {
        $params = MessageTpl::of($messageTplUpdateCmd->toArray());
        $this->messageTplRepo->update($params);
        return make(EmptyVO::class);
    }
}
