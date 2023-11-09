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
use Uss\Message\Client\ViewObject\MessageTplVarVO;
use Uss\Message\Infra\Repository\MessageTplVarQryRepo;

/**
 * MessageTplVarGetByIdQryExe.
 */
#[AppService]
class MessageTplVarGetByIdQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplVarQryRepo $messageTplVarQryRepo;

    public function execute(int $id): MessageTplVarVO
    {
        $result = $this->messageTplVarQryRepo->getById($id);
        return MessageTplVarVO::ofDO($result);
    }
}
