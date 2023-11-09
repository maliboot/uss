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
use Uss\Message\Client\Dto\Query\MessageTplListByPageQry;
use Uss\Message\Infra\Repository\MessageTplQryRepo;

/**
 * MessageTplListByPageQryExe.
 */
#[AppService]
class MessageTplListByPageQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplQryRepo $messageTplQryRepo;

    public function execute(MessageTplListByPageQry $messageTplListByPageQry): PageVO
    {
        return $this->messageTplQryRepo->listByPage($messageTplListByPageQry);
    }
}
