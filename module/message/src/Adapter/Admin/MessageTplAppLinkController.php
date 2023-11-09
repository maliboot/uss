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
use Uss\Message\App\Executor\Command\MessageTplAppLinkCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplAppLinkDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplAppLinkUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplAppLinkGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplAppLinkListByPageQryExe;
use Uss\Message\Client\Dto\Command\MessageTplAppLinkCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplAppLinkUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplAppLinkListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplAppLinkVO;

/**
 * 消息模板-app推送-页面跳转链接.
 */
#[ApiController(prefix: '/admin/messageTplAppLink')]
#[ApiGroup('MessageTplAppLink')]
class MessageTplAppLinkController extends AbstractController
{
    #[Inject]
    protected MessageTplAppLinkListByPageQryExe $messageTplAppLinkListByPageQryExe;

    #[Inject]
    protected MessageTplAppLinkCreateCmdExe $messageTplAppLinkCreateCmdExe;

    #[Inject]
    protected MessageTplAppLinkUpdateCmdExe $messageTplAppLinkUpdateCmdExe;

    #[Inject]
    protected MessageTplAppLinkDeleteCmdExe $messageTplAppLinkDeleteCmdExe;

    #[Inject]
    protected MessageTplAppLinkGetByIdQryExe $messageTplAppLinkGetByIdQryExe;

    #[ApiMapping(path: '/listByPage', methods: ['GET'], name: 'MessageTplAppLink列表')]
    #[ApiRequest(MessageTplAppLinkListByPageQry::class)]
    #[ApiPageResponse(MessageTplAppLinkVO::class)]
    public function listByPage(MessageTplAppLinkListByPageQry $messageTplAppLinkListByPageQry): PageVO
    {
        return $this->messageTplAppLinkListByPageQryExe->execute($messageTplAppLinkListByPageQry);
    }

    #[ApiMapping(path: '/create', methods: ['POST'], name: '创建MessageTplAppLink')]
    #[ApiRequest(MessageTplAppLinkCreateCmd::class)]
    #[ApiSingleResponse(IdVO::class)]
    public function create(MessageTplAppLinkCreateCmd $messageTplAppLinkCreateCmd): IdVO
    {
        return $this->messageTplAppLinkCreateCmdExe->execute($messageTplAppLinkCreateCmd);
    }

    #[ApiMapping(path: '/update', methods: ['PUT'], name: '修改MessageTplAppLink')]
    #[ApiRequest(MessageTplAppLinkUpdateCmd::class)]
    #[ApiSingleResponse(EmptyVO::class)]
    public function update(MessageTplAppLinkUpdateCmd $messageTplAppLinkUpdateCmd): EmptyVO
    {
        return $this->messageTplAppLinkUpdateCmdExe->execute($messageTplAppLinkUpdateCmd);
    }

    #[ApiMapping(path: '/delete', methods: ['DELETE'], name: '删除MessageTplAppLink')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(EmptyVO::class)]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplAppLinkDeleteCmdExe->execute($id);
    }

    #[ApiMapping(path: '/getById', methods: ['GET'], name: '获取单个MessageTplAppLink信息')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(MessageTplAppLinkVO::class)]
    public function getById(int $id): MessageTplAppLinkVO
    {
        return $this->messageTplAppLinkGetByIdQryExe->execute($id);
    }
}
