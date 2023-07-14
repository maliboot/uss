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
use Uss\Message\Client\Dto\Query\MessageTplServerListByPageQry;
use Uss\Message\Infra\Repository\MessageTplServerQryRepo;

/**
 * MessageTplServerListByPageQryExe.
 */
#[AppService]
class MessageTplServerListByPageQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplServerQryRepo $messageTplServerQryRepo;

    public function execute(MessageTplServerListByPageQry $messageTplServerListByPageQry): PageVO
    {
        return $this->messageTplServerQryRepo->listByPage($messageTplServerListByPageQry);
    }
}
