<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\App\Executor\Command;

use MaliBoot\Cola\Annotation\AppService;
use MaliBoot\Cola\App\AbstractExecutor;
use MaliBoot\Di\Annotation\Inject;
use MaliBoot\Dto\IdVO;
use Uss\Message\Client\Dto\Command\MessageTplCreateCmd;
use Uss\Message\Domain\Model\MessageTplGroup\MessageTpl;
use Uss\Message\Domain\Repository\MessageTplRepo;

/**
 * 消息模版.
 */
#[AppService]
class MessageTplCreateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplRepo $messageTplRepo;

    public function execute(MessageTplCreateCmd $messageTplCreateCmd): IdVo
    {
        $params = MessageTpl::of($messageTplCreateCmd->toArray());
        $result = $this->messageTplRepo->create($params);
        return (new IdVO())->setId($result);
    }
}
