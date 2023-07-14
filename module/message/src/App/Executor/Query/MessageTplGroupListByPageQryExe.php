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
use Uss\Message\Client\Dto\Query\MessageTplGroupListByPageQry;
use Uss\Message\Infra\Repository\MessageTplGroupQryRepo;

/**
 * MessageTplGroupListByPageQryExe.
 */
#[AppService]
class MessageTplGroupListByPageQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplGroupQryRepo $messageTplGroupQryRepo;

    public function execute(MessageTplGroupListByPageQry $messageTplGroupListByPageQry): PageVO
    {
        return $this->messageTplGroupQryRepo->listByPage($messageTplGroupListByPageQry);
    }
}
