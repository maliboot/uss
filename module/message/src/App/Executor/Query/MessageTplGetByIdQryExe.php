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
use Uss\Message\Client\ViewObject\MessageTplVO;
use Uss\Message\Infra\Repository\MessageTplQryRepo;

/**
 * MessageTplGetByIdQryExe.
 */
#[AppService]
class MessageTplGetByIdQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplQryRepo $messageTplQryRepo;

    public function execute(int $id): MessageTplVO
    {
        $result = $this->messageTplQryRepo->getById($id);
        return MessageTplVO::ofDO($result);
    }
}
