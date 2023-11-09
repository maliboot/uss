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
use Uss\Message\Client\Dto\Command\MessageTplVarCreateCmd;
use Uss\Message\Domain\Model\MessageTplVar\MessageTplVar;
use Uss\Message\Domain\Repository\MessageTplVarRepo;

/**
 * 消息模板-变量.
 */
#[AppService]
class MessageTplVarCreateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplVarRepo $messageTplVarRepo;

    public function execute(MessageTplVarCreateCmd $messageTplVarCreateCmd): IdVo
    {
        $params = MessageTplVar::of($messageTplVarCreateCmd->toArray());
        $result = $this->messageTplVarRepo->create($params);
        return (new IdVO())->setId($result);
    }
}
