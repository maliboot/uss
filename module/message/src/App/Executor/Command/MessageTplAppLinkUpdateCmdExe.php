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
use Uss\Message\Client\Dto\Command\MessageTplAppLinkUpdateCmd;
use Uss\Message\Domain\Model\MessageTplAppLink\MessageTplAppLink;
use Uss\Message\Domain\Repository\MessageTplAppLinkRepo;

/**
 * MessageTplAppLinkUpdateCmdExe.
 */
#[AppService]
class MessageTplAppLinkUpdateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplAppLinkRepo $messageTplAppLinkRepo;

    public function execute(MessageTplAppLinkUpdateCmd $messageTplAppLinkUpdateCmd): EmptyVO
    {
        $params = MessageTplAppLink::of($messageTplAppLinkUpdateCmd->toArray());
        $this->messageTplAppLinkRepo->update($params);
        return make(EmptyVO::class);
    }
}
