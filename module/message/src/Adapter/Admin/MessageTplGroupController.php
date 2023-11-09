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
use Uss\Message\App\Executor\Command\MessageTplGroupCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplGroupDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplGroupUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplGroupGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplGroupListByPageQryExe;
use Uss\Message\Client\Dto\Command\MessageTplGroupCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplGroupUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplGroupListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplGroupVO;

/**
 * 消息模板-分组.
 */
#[ApiController(prefix: '/admin/messageTplGroup')]
#[ApiGroup('MessageTplGroup')]
class MessageTplGroupController extends AbstractController
{
    #[Inject]
    protected MessageTplGroupListByPageQryExe $messageTplGroupListByPageQryExe;

    #[Inject]
    protected MessageTplGroupCreateCmdExe $messageTplGroupCreateCmdExe;

    #[Inject]
    protected MessageTplGroupUpdateCmdExe $messageTplGroupUpdateCmdExe;

    #[Inject]
    protected MessageTplGroupDeleteCmdExe $messageTplGroupDeleteCmdExe;

    #[Inject]
    protected MessageTplGroupGetByIdQryExe $messageTplGroupGetByIdQryExe;

    #[ApiMapping(path: '/listByPage', methods: ['GET'], name: 'MessageTplGroup列表')]
    #[ApiRequest(MessageTplGroupListByPageQry::class)]
    #[ApiPageResponse(MessageTplGroupVO::class)]
    public function listByPage(MessageTplGroupListByPageQry $messageTplGroupListByPageQry): PageVO
    {
        return $this->messageTplGroupListByPageQryExe->execute($messageTplGroupListByPageQry);
    }

    #[ApiMapping(path: '/create', methods: ['POST'], name: '创建MessageTplGroup')]
    #[ApiRequest(MessageTplGroupCreateCmd::class)]
    #[ApiSingleResponse(IdVO::class)]
    public function create(MessageTplGroupCreateCmd $messageTplGroupCreateCmd): IdVO
    {
        return $this->messageTplGroupCreateCmdExe->execute($messageTplGroupCreateCmd);
    }

    #[ApiMapping(path: '/update', methods: ['PUT'], name: '修改MessageTplGroup')]
    #[ApiRequest(MessageTplGroupUpdateCmd::class)]
    #[ApiSingleResponse(EmptyVO::class)]
    public function update(MessageTplGroupUpdateCmd $messageTplGroupUpdateCmd): EmptyVO
    {
        return $this->messageTplGroupUpdateCmdExe->execute($messageTplGroupUpdateCmd);
    }

    #[ApiMapping(path: '/delete', methods: ['DELETE'], name: '删除MessageTplGroup')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(EmptyVO::class)]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplGroupDeleteCmdExe->execute($id);
    }

    #[ApiMapping(path: '/getById', methods: ['GET'], name: '获取单个MessageTplGroup信息')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(MessageTplGroupVO::class)]
    public function getById(int $id): MessageTplGroupVO
    {
        return $this->messageTplGroupGetByIdQryExe->execute($id);
    }
}
