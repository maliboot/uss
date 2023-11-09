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
use Uss\Message\Client\Dto\Query\MessageTplVarListByPageQry;
use Uss\Message\Infra\Repository\MessageTplVarQryRepo;

/**
 * MessageTplVarListByPageQryExe.
 */
#[AppService]
class MessageTplVarListByPageQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplVarQryRepo $messageTplVarQryRepo;

    public function execute(MessageTplVarListByPageQry $messageTplVarListByPageQry): PageVO
    {
        return $this->messageTplVarQryRepo->listByPage($messageTplVarListByPageQry);
    }
}
