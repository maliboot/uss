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
use Uss\Message\Client\Dto\Command\MessageTplServerCreateCmd;
use Uss\Message\Domain\Model\MessageTplServer\MessageTplServer;
use Uss\Message\Domain\Repository\MessageTplServerRepo;

/**
 * 消息模板-服务配置，如机器人、邮件发件人等….
 */
#[AppService]
class MessageTplServerCreateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplServerRepo $messageTplServerRepo;

    public function execute(MessageTplServerCreateCmd $messageTplServerCreateCmd): IdVo
    {
        $params = MessageTplServer::of($messageTplServerCreateCmd->toArray());
        $result = $this->messageTplServerRepo->create($params);
        return (new IdVO())->setId($result);
    }
}
