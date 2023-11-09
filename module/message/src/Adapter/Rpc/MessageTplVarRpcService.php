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
use Uss\Message\App\Executor\Command\MessageTplVarCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplVarDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplVarUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplVarGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplVarListByPageQryExe;
use Uss\Message\Client\Api\MessageTplVarService;
use Uss\Message\Client\Dto\Command\MessageTplVarCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplVarUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplVarListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplVarVO;

/**
 * 消息模板-变量.
 */
#[API(name: '消息模板-变量')]
class MessageTplVarRpcService extends AbstractRpcService implements MessageTplVarService
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

    #[Method(name: '消息模板-变量列表')]
    public function listByPage(MessageTplVarListByPageQry $messageTplVarListByPageQry): PageVO
    {
        return $this->messageTplVarListByPageQryExe->execute($messageTplVarListByPageQry);
    }

    #[Method(name: '创建消息模板-变量信息')]
    public function create(MessageTplVarCreateCmd $messageTplVarCreateCmd): IdVO
    {
        return $this->messageTplVarCreateCmdExe->execute($messageTplVarCreateCmd);
    }

    #[Method(name: '修改消息模板-变量信息')]
    public function update(MessageTplVarUpdateCmd $messageTplVarUpdateCmd): EmptyVO
    {
        return $this->messageTplVarUpdateCmdExe->execute($messageTplVarUpdateCmd);
    }

    #[Method(name: '删除消息模板-变量信息')]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplVarDeleteCmdExe->execute($id);
    }

    #[Method(name: '获取单个消息模板-变量信息')]
    public function getById(int $id): MessageTplVarVO
    {
        return $this->messageTplVarGetByIdQryExe->execute($id);
    }
}
