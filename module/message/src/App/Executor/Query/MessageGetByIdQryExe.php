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
use Uss\Message\Client\ViewObject\MessageVO;
use Uss\Message\Infra\Repository\MessageQryRepo;

/**
 * MessageGetByIdQryExe.
 */
#[AppService]
class MessageGetByIdQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageQryRepo $messageQryRepo;

    public function execute(int $id): MessageVO
    {
        $result = $this->messageQryRepo->getById($id);
        return MessageVO::ofDO($result);
    }
}
