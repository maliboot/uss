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
use Uss\Message\Client\Dto\Command\MessageTplGroupCreateCmd;
use Uss\Message\Domain\Model\MessageTplGroup\MessageTplGroup;
use Uss\Message\Domain\Repository\MessageTplGroupRepo;

/**
 * 消息模板-分组.
 */
#[AppService]
class MessageTplGroupCreateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplGroupRepo $messageTplGroupRepo;

    public function execute(MessageTplGroupCreateCmd $messageTplGroupCreateCmd): IdVo
    {
        $params = MessageTplGroup::of($messageTplGroupCreateCmd->toArray());
        $result = $this->messageTplGroupRepo->create($params);
        return (new IdVO())->setId($result);
    }
}
