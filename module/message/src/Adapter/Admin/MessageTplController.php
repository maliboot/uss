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
use Uss\Message\App\Executor\Command\MessageTplCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplListByPageQryExe;
use Uss\Message\Client\Dto\Command\MessageTplCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplVO;

/**
 * 消息模版.
 */
#[ApiController(prefix: '/admin/messageTpl')]
#[ApiGroup('MessageTpl')]
class MessageTplController extends AbstractController
{
    #[Inject]
    protected MessageTplListByPageQryExe $messageTplListByPageQryExe;

    #[Inject]
    protected MessageTplCreateCmdExe $messageTplCreateCmdExe;

    #[Inject]
    protected MessageTplUpdateCmdExe $messageTplUpdateCmdExe;

    #[Inject]
    protected MessageTplDeleteCmdExe $messageTplDeleteCmdExe;

    #[Inject]
    protected MessageTplGetByIdQryExe $messageTplGetByIdQryExe;

    #[ApiMapping(path: '/listByPage', methods: ['GET'], name: 'MessageTpl列表')]
    #[ApiRequest(MessageTplListByPageQry::class)]
    #[ApiPageResponse(MessageTplVO::class)]
    public function listByPage(MessageTplListByPageQry $messageTplListByPageQry): PageVO
    {
        return $this->messageTplListByPageQryExe->execute($messageTplListByPageQry);
    }

    #[ApiMapping(path: '/create', methods: ['POST'], name: '创建MessageTpl')]
    #[ApiRequest(MessageTplCreateCmd::class)]
    #[ApiSingleResponse(IdVO::class)]
    public function create(MessageTplCreateCmd $messageTplCreateCmd): IdVO
    {
        return $this->messageTplCreateCmdExe->execute($messageTplCreateCmd);
    }

    #[ApiMapping(path: '/update', methods: ['PUT'], name: '修改MessageTpl')]
    #[ApiRequest(MessageTplUpdateCmd::class)]
    #[ApiSingleResponse(EmptyVO::class)]
    public function update(MessageTplUpdateCmd $messageTplUpdateCmd): EmptyVO
    {
        return $this->messageTplUpdateCmdExe->execute($messageTplUpdateCmd);
    }

    #[ApiMapping(path: '/delete', methods: ['DELETE'], name: '删除MessageTpl')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(EmptyVO::class)]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplDeleteCmdExe->execute($id);
    }

    #[ApiMapping(path: '/getById', methods: ['GET'], name: '获取单个MessageTpl信息')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(MessageTplVO::class)]
    public function getById(int $id): MessageTplVO
    {
        return $this->messageTplGetByIdQryExe->execute($id);
    }
}
