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
use Uss\Message\Client\Dto\Command\MessageTplAppLinkCreateCmd;
use Uss\Message\Domain\Model\MessageTplAppLink\MessageTplAppLink;
use Uss\Message\Domain\Repository\MessageTplAppLinkRepo;

/**
 * 消息模板-app推送-页面跳转链接.
 */
#[AppService]
class MessageTplAppLinkCreateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplAppLinkRepo $messageTplAppLinkRepo;

    public function execute(MessageTplAppLinkCreateCmd $messageTplAppLinkCreateCmd): IdVo
    {
        $params = MessageTplAppLink::of($messageTplAppLinkCreateCmd->toArray());
        $result = $this->messageTplAppLinkRepo->create($params);
        return (new IdVO())->setId($result);
    }
}
