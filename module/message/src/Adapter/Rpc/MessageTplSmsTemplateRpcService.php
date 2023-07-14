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
use Uss\Message\App\Executor\Command\MessageTplSmsTemplateCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplSmsTemplateDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplSmsTemplateUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplSmsTemplateGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplSmsTemplateListByPageQryExe;
use Uss\Message\Client\Api\MessageTplSmsTemplateService;
use Uss\Message\Client\Dto\Command\MessageTplSmsTemplateCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplSmsTemplateUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplSmsTemplateListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplSmsTemplateVO;

/**
 * 消息模板-短信模板.
 */
#[API(name: '消息模板-短信模板')]
class MessageTplSmsTemplateRpcService extends AbstractRpcService implements MessageTplSmsTemplateService
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

    #[Method(name: '消息模板-短信模板列表')]
    public function listByPage(MessageTplSmsTemplateListByPageQry $messageTplSmsTemplateListByPageQry): PageVO
    {
        return $this->messageTplSmsTemplateListByPageQryExe->execute($messageTplSmsTemplateListByPageQry);
    }

    #[Method(name: '创建消息模板-短信模板信息')]
    public function create(MessageTplSmsTemplateCreateCmd $messageTplSmsTemplateCreateCmd): IdVO
    {
        return $this->messageTplSmsTemplateCreateCmdExe->execute($messageTplSmsTemplateCreateCmd);
    }

    #[Method(name: '修改消息模板-短信模板信息')]
    public function update(MessageTplSmsTemplateUpdateCmd $messageTplSmsTemplateUpdateCmd): EmptyVO
    {
        return $this->messageTplSmsTemplateUpdateCmdExe->execute($messageTplSmsTemplateUpdateCmd);
    }

    #[Method(name: '删除消息模板-短信模板信息')]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplSmsTemplateDeleteCmdExe->execute($id);
    }

    #[Method(name: '获取单个消息模板-短信模板信息')]
    public function getById(int $id): MessageTplSmsTemplateVO
    {
        return $this->messageTplSmsTemplateGetByIdQryExe->execute($id);
    }
}
