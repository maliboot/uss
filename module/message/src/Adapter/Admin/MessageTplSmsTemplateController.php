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
use Uss\Message\App\Executor\Command\MessageTplSmsTemplateCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplSmsTemplateDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplSmsTemplateUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplSmsTemplateGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplSmsTemplateListByPageQryExe;
use Uss\Message\Client\Dto\Command\MessageTplSmsTemplateCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplSmsTemplateUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplSmsTemplateListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplSmsTemplateVO;

/**
 * 消息模板-短信模板.
 */
#[ApiController(prefix: '/admin/messageTplSmsTemplate')]
#[ApiGroup('MessageTplSmsTemplate')]
class MessageTplSmsTemplateController extends AbstractController
{
    #[Inject]
    protected MessageTplSmsTemplateListByPageQryExe $messageTplSmsTemplateListByPageQryExe;

    #[Inject]
    protected MessageTplSmsTemplateCreateCmdExe $messageTplSmsTemplateCreateCmdExe;

    #[Inject]
    protected MessageTplSmsTemplateUpdateCmdExe $messageTplSmsTemplateUpdateCmdExe;

    #[Inject]
    protected MessageTplSmsTemplateDeleteCmdExe $messageTplSmsTemplateDeleteCmdExe;

    #[Inject]
    protected MessageTplSmsTemplateGetByIdQryExe $messageTplSmsTemplateGetByIdQryExe;

    #[ApiMapping(path: '/listByPage', methods: ['GET'], name: 'MessageTplSmsTemplate列表')]
    #[ApiRequest(MessageTplSmsTemplateListByPageQry::class)]
    #[ApiPageResponse(MessageTplSmsTemplateVO::class)]
    public function listByPage(MessageTplSmsTemplateListByPageQry $messageTplSmsTemplateListByPageQry): PageVO
    {
        return $this->messageTplSmsTemplateListByPageQryExe->execute($messageTplSmsTemplateListByPageQry);
    }

    #[ApiMapping(path: '/create', methods: ['POST'], name: '创建MessageTplSmsTemplate')]
    #[ApiRequest(MessageTplSmsTemplateCreateCmd::class)]
    #[ApiSingleResponse(IdVO::class)]
    public function create(MessageTplSmsTemplateCreateCmd $messageTplSmsTemplateCreateCmd): IdVO
    {
        return $this->messageTplSmsTemplateCreateCmdExe->execute($messageTplSmsTemplateCreateCmd);
    }

    #[ApiMapping(path: '/update', methods: ['PUT'], name: '修改MessageTplSmsTemplate')]
    #[ApiRequest(MessageTplSmsTemplateUpdateCmd::class)]
    #[ApiSingleResponse(EmptyVO::class)]
    public function update(MessageTplSmsTemplateUpdateCmd $messageTplSmsTemplateUpdateCmd): EmptyVO
    {
        return $this->messageTplSmsTemplateUpdateCmdExe->execute($messageTplSmsTemplateUpdateCmd);
    }

    #[ApiMapping(path: '/delete', methods: ['DELETE'], name: '删除MessageTplSmsTemplate')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(EmptyVO::class)]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplSmsTemplateDeleteCmdExe->execute($id);
    }

    #[ApiMapping(path: '/getById', methods: ['GET'], name: '获取单个MessageTplSmsTemplate信息')]
    #[ApiQuery(name: 'id', type: 'int')]
    #[ApiSingleResponse(MessageTplSmsTemplateVO::class)]
    public function getById(int $id): MessageTplSmsTemplateVO
    {
        return $this->messageTplSmsTemplateGetByIdQryExe->execute($id);
    }
}
