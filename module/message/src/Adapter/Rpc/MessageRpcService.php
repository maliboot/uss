<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Adapter\Rpc;

use MaliBoot\Cola\Adapter\AbstractRpcService;
use MaliBoot\Cola\Annotation\API;
use MaliBoot\Cola\Annotation\Method;
use MaliBoot\Di\Annotation\Inject;
use MaliBoot\Dto\EmptyVO;
use MaliBoot\Dto\IdVO;
use MaliBoot\Dto\PageVO;
use Uss\Message\App\Executor\Command\MessageCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageListByPageQryExe;
use Uss\Message\Client\Api\MessageService;
use Uss\Message\Client\Dto\Command\MessageCreateCmd;
use Uss\Message\Client\Dto\Command\MessageUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageListByPageQry;
use Uss\Message\Client\ViewObject\MessageVO;

/**
 * 消息推送.
 */
#[API(name: '消息推送')]
class MessageRpcService extends AbstractRpcService implements MessageService
{
    #[Inject]
    protected MessageListByPageQryExe $messageListByPageQryExe;

    #[Inject]
    protected MessageCreateCmdExe $messageCreateCmdExe;

    #[Inject]
    protected MessageUpdateCmdExe $messageUpdateCmdExe;

    #[Inject]
    protected MessageDeleteCmdExe $messageDeleteCmdExe;

    #[Inject]
    protected MessageGetByIdQryExe $messageGetByIdQryExe;

    #[Method(name: '消息推送列表')]
    public function listByPage(MessageListByPageQry $messageListByPageQry): PageVO
    {
        return $this->messageListByPageQryExe->execute($messageListByPageQry);
    }

    #[Method(name: '创建消息推送信息')]
    public function create(MessageCreateCmd $messageCreateCmd): IdVO
    {
        return $this->messageCreateCmdExe->execute($messageCreateCmd);
    }

    #[Method(name: '修改消息推送信息')]
    public function update(MessageUpdateCmd $messageUpdateCmd): EmptyVO
    {
        return $this->messageUpdateCmdExe->execute($messageUpdateCmd);
    }

    #[Method(name: '删除消息推送信息')]
    public function delete(int $id): EmptyVO
    {
        return $this->messageDeleteCmdExe->execute($id);
    }

    #[Method(name: '获取单个消息推送信息')]
    public function getById(int $id): MessageVO
    {
        return $this->messageGetByIdQryExe->execute($id);
    }
}
