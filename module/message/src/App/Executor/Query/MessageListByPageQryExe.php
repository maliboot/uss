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
use Uss\Message\Client\Dto\Query\MessageListByPageQry;
use Uss\Message\Infra\Repository\MessageQryRepo;

/**
 * MessageListByPageQryExe.
 */
#[AppService]
class MessageListByPageQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageQryRepo $messageQryRepo;

    public function execute(MessageListByPageQry $messageListByPageQry): PageVO
    {
        return $this->messageQryRepo->listByPage($messageListByPageQry);
    }
}
