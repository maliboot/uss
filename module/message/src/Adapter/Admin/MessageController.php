<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Adapter\Admin;

use MaliBoot\ApiAnnotation\ApiController;
use MaliBoot\ApiAnnotation\ApiGroup;
use MaliBoot\ApiAnnotation\ApiMapping;
use MaliBoot\ApiAnnotation\ApiPageResponse;
use MaliBoot\ApiAnnotation\ApiQuery;
use MaliBoot\ApiAnnotation\ApiRequest;
use MaliBoot\ApiAnnotation\ApiSingleResponse;
use MaliBoot\Cola\Adapter\AbstractController;
use MaliBoot\Di\Annotation\Inject;
use MaliBoot\Dto\EmptyVO;
use MaliBoot\Dto\IdVO;
use MaliBoot\Dto\PageVO;
use Uss\Message\App\Executor\Command\MessageCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageListByPageQryExe;
use Uss\Message\Client\Dto\Command\MessageCreateCmd;
use Uss\Message\Client\Dto\Command\MessageUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageListByPageQry;
use Uss\Message\Client\ViewObject\MessageVO;
use Uss\Message\App\Executor\Command\NotificationCmdExe;
use Uss\Message\Client\Dto\Command\NotificationCmd;
use Uss\Message\Client\ViewObject\ResultVO;

/**
 * 消息推送.
 */
#[ApiController(prefix: '/admin/message')]
#[ApiGroup('Message')]
class MessageController extends AbstractController
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

    #[Inject]
    protected NotificationCmdExe $notificationCmdExe;

    #[ApiMapping(path: '/listByPage', methods: ['GET'], name: 'Message列表')]
    #[ApiRequest(MessageListByPageQry::class)]
    #[ApiPageResponse(MessageVO::class)]
    public function listByPage(MessageListByPageQry $messageListByPageQry): PageVO
    {
        return $this->messageListByPageQryExe->execute($messageListByPageQry);
    }

    #[ApiMapping(path: '/create', methods: ['POST'], name: '创建Message')]
    #[ApiRequest(MessageCreateCmd::class)]
    #[ApiSingleResponse(IdVO::class)]
    public function create(MessageCreateCmd $messageCreateCmd): IdVO
    {
        return $this->messageCreateCmdExe->execute($messageCreateCmd);
    }

    #[ApiMapping(path: '/update', methods: ['PUT'], name: '修改Message')]
    #[ApiRequest(MessageUpdateCmd::class)]
    #[ApiSingleResponse(EmptyVO::class)]
    public function update(MessageUpdateCmd $messageUpdateCmd): EmptyVO
    {
        return $this->messageUpdateCmdExe->execute($messageUpdateCmd);
    }

    #[ApiMapping(path: '/delete', methods: ['DELETE'], name: '删除Message')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(EmptyVO::class)]
    public function delete(int $id): EmptyVO
    {
        return $this->messageDeleteCmdExe->execute($id);
    }

    #[ApiMapping(path: '/getById', methods: ['GET'], name: '获取单个Message信息')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(MessageVO::class)]
    public function getById(int $id): MessageVO
    {
        return $this->messageGetByIdQryExe->execute($id);
    }

    #[ApiMapping(path: '/send', methods: ['POST'], name: '获取单个Message信息')]
    #[ApiRequest(NotificationCmd::class)]
    #[ApiSingleResponse(ResultVO::class)]
    public function send(NotificationCmd $notificationCmd): ResultVO
    {
        return $this->notificationCmdExe->execute($notificationCmd);
    }
}
