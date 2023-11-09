<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\App\Executor\Query;

use MaliBoot\Cola\Annotation\AppService;
use MaliBoot\Cola\App\AbstractExecutor;
use MaliBoot\Di\Annotation\Inject;
use Uss\Message\Client\ViewObject\MessageTplAppLinkVO;
use Uss\Message\Infra\Repository\MessageTplAppLinkQryRepo;

/**
 * MessageTplAppLinkGetByIdQryExe.
 */
#[AppService]
class MessageTplAppLinkGetByIdQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplAppLinkQryRepo $messageTplAppLinkQryRepo;

    public function execute(int $id): MessageTplAppLinkVO
    {
        $result = $this->messageTplAppLinkQryRepo->getById($id);
        return MessageTplAppLinkVO::ofDO($result);
    }
}
