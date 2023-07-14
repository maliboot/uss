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
use Uss\Message\App\Executor\Command\MessageTplServerCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplServerDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplServerUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplServerGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplServerListByPageQryExe;
use Uss\Message\Client\Dto\Command\MessageTplServerCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplServerUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplServerListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplServerVO;

/**
 * 消息模板-服务配置，如机器人、邮件发件人等….
 */
#[ApiController(prefix: '/admin/messageTplServer')]
#[ApiGroup('MessageTplServer')]
class MessageTplServerController extends AbstractController
{
    #[Inject]
    protected MessageTplServerListByPageQryExe $messageTplServerListByPageQryExe;

    #[Inject]
    protected MessageTplServerCreateCmdExe $messageTplServerCreateCmdExe;

    #[Inject]
    protected MessageTplServerUpdateCmdExe $messageTplServerUpdateCmdExe;

    #[Inject]
    protected MessageTplServerDeleteCmdExe $messageTplServerDeleteCmdExe;

    #[Inject]
    protected MessageTplServerGetByIdQryExe $messageTplServerGetByIdQryExe;

    #[ApiMapping(path: '/listByPage', methods: ['GET'], name: 'MessageTplServer列表')]
    #[ApiRequest(MessageTplServerListByPageQry::class)]
    #[ApiPageResponse(MessageTplServerVO::class)]
    public function listByPage(MessageTplServerListByPageQry $messageTplServerListByPageQry): PageVO
    {
        return $this->messageTplServerListByPageQryExe->execute($messageTplServerListByPageQry);
    }

    #[ApiMapping(path: '/create', methods: ['POST'], name: '创建MessageTplServer')]
    #[ApiRequest(MessageTplServerCreateCmd::class)]
    #[ApiSingleResponse(IdVO::class)]
    public function create(MessageTplServerCreateCmd $messageTplServerCreateCmd): IdVO
    {
        return $this->messageTplServerCreateCmdExe->execute($messageTplServerCreateCmd);
    }

    #[ApiMapping(path: '/update', methods: ['PUT'], name: '修改MessageTplServer')]
    #[ApiRequest(MessageTplServerUpdateCmd::class)]
    #[ApiSingleResponse(EmptyVO::class)]
    public function update(MessageTplServerUpdateCmd $messageTplServerUpdateCmd): EmptyVO
    {
        return $this->messageTplServerUpdateCmdExe->execute($messageTplServerUpdateCmd);
    }

    #[ApiMapping(path: '/delete', methods: ['DELETE'], name: '删除MessageTplServer')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(EmptyVO::class)]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplServerDeleteCmdExe->execute($id);
    }

    #[ApiMapping(path: '/getById', methods: ['GET'], name: '获取单个MessageTplServer信息')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(MessageTplServerVO::class)]
    public function getById(int $id): MessageTplServerVO
    {
        return $this->messageTplServerGetByIdQryExe->execute($id);
    }
}
