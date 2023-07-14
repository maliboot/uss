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
use Uss\Message\Client\ViewObject\MessageTplServerVO;
use Uss\Message\Infra\Repository\MessageTplServerQryRepo;

/**
 * MessageTplServerGetByIdQryExe.
 */
#[AppService]
class MessageTplServerGetByIdQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplServerQryRepo $messageTplServerQryRepo;

    public function execute(int $id): MessageTplServerVO
    {
        $result = $this->messageTplServerQryRepo->getById($id);
        return MessageTplServerVO::ofDO($result);
    }
}
