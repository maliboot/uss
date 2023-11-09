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
use Uss\Message\App\Executor\Command\MessageTplVarCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplVarDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplVarUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplVarGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplVarListByPageQryExe;
use Uss\Message\Client\Dto\Command\MessageTplVarCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplVarUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplVarListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplVarVO;

/**
 * 消息模板-变量.
 */
#[ApiController(prefix: '/admin/messageTplVar')]
#[ApiGroup('MessageTplVar')]
class MessageTplVarController extends AbstractController
{
    #[Inject]
    protected MessageTplVarListByPageQryExe $messageTplVarListByPageQryExe;

    #[Inject]
    protected MessageTplVarCreateCmdExe $messageTplVarCreateCmdExe;

    #[Inject]
    protected MessageTplVarUpdateCmdExe $messageTplVarUpdateCmdExe;

    #[Inject]
    protected MessageTplVarDeleteCmdExe $messageTplVarDeleteCmdExe;

    #[Inject]
    protected MessageTplVarGetByIdQryExe $messageTplVarGetByIdQryExe;

    #[ApiMapping(path: '/listByPage', methods: ['GET'], name: 'MessageTplVar列表')]
    #[ApiRequest(MessageTplVarListByPageQry::class)]
    #[ApiPageResponse(MessageTplVarVO::class)]
    public function listByPage(MessageTplVarListByPageQry $messageTplVarListByPageQry): PageVO
    {
        return $this->messageTplVarListByPageQryExe->execute($messageTplVarListByPageQry);
    }

    #[ApiMapping(path: '/create', methods: ['POST'], name: '创建MessageTplVar')]
    #[ApiRequest(MessageTplVarCreateCmd::class)]
    #[ApiSingleResponse(IdVO::class)]
    public function create(MessageTplVarCreateCmd $messageTplVarCreateCmd): IdVO
    {
        return $this->messageTplVarCreateCmdExe->execute($messageTplVarCreateCmd);
    }

    #[ApiMapping(path: '/update', methods: ['PUT'], name: '修改MessageTplVar')]
    #[ApiRequest(MessageTplVarUpdateCmd::class)]
    #[ApiSingleResponse(EmptyVO::class)]
    public function update(MessageTplVarUpdateCmd $messageTplVarUpdateCmd): EmptyVO
    {
        return $this->messageTplVarUpdateCmdExe->execute($messageTplVarUpdateCmd);
    }

    #[ApiMapping(path: '/delete', methods: ['DELETE'], name: '删除MessageTplVar')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(EmptyVO::class)]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplVarDeleteCmdExe->execute($id);
    }

    #[ApiMapping(path: '/getById', methods: ['GET'], name: '获取单个MessageTplVar信息')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(MessageTplVarVO::class)]
    public function getById(int $id): MessageTplVarVO
    {
        return $this->messageTplVarGetByIdQryExe->execute($id);
    }
}
