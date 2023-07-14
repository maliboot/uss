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
use Uss\Message\Client\Dto\Command\MessageTplGroupUpdateCmd;
use Uss\Message\Domain\Model\MessageTplGroup\MessageTplGroup;
use Uss\Message\Domain\Repository\MessageTplGroupRepo;

/**
 * MessageTplGroupUpdateCmdExe.
 */
#[AppService]
class MessageTplGroupUpdateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplGroupRepo $messageTplGroupRepo;

    public function execute(MessageTplGroupUpdateCmd $messageTplGroupUpdateCmd): EmptyVO
    {
        $params = MessageTplGroup::of($messageTplGroupUpdateCmd->toArray());
        $this->messageTplGroupRepo->update($params);
        return make(EmptyVO::class);
    }
}
