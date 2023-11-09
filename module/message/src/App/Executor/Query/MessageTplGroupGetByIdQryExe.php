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
use Uss\Message\Client\ViewObject\MessageTplGroupVO;
use Uss\Message\Infra\Repository\MessageTplGroupQryRepo;

/**
 * MessageTplGroupGetByIdQryExe.
 */
#[AppService]
class MessageTplGroupGetByIdQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplGroupQryRepo $messageTplGroupQryRepo;

    public function execute(int $id): MessageTplGroupVO
    {
        $result = $this->messageTplGroupQryRepo->getById($id);
        return MessageTplGroupVO::ofDO($result);
    }
}
