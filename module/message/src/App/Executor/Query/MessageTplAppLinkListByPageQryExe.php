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
use MaliBoot\Dto\PageVO;
use Uss\Message\Client\Dto\Query\MessageTplAppLinkListByPageQry;
use Uss\Message\Infra\Repository\MessageTplAppLinkQryRepo;

/**
 * MessageTplAppLinkListByPageQryExe.
 */
#[AppService]
class MessageTplAppLinkListByPageQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplAppLinkQryRepo $messageTplAppLinkQryRepo;

    public function execute(MessageTplAppLinkListByPageQry $messageTplAppLinkListByPageQry): PageVO
    {
        return $this->messageTplAppLinkQryRepo->listByPage($messageTplAppLinkListByPageQry);
    }
}
