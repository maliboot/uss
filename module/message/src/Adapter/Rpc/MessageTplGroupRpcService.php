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
use Uss\Message\App\Executor\Command\MessageTplGroupCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplGroupDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplGroupUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplGroupGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplGroupListByPageQryExe;
use Uss\Message\Client\Api\MessageTplGroupService;
use Uss\Message\Client\Dto\Command\MessageTplGroupCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplGroupUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplGroupListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplGroupVO;

/**
 * 消息模板-分组.
 */
#[API(name: '消息模板-分组')]
class MessageTplGroupRpcService extends AbstractRpcService implements MessageTplGroupService
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

    #[Method(name: '消息模板-分组列表')]
    public function listByPage(MessageTplGroupListByPageQry $messageTplGroupListByPageQry): PageVO
    {
        return $this->messageTplGroupListByPageQryExe->execute($messageTplGroupListByPageQry);
    }

    #[Method(name: '创建消息模板-分组信息')]
    public function create(MessageTplGroupCreateCmd $messageTplGroupCreateCmd): IdVO
    {
        return $this->messageTplGroupCreateCmdExe->execute($messageTplGroupCreateCmd);
    }

    #[Method(name: '修改消息模板-分组信息')]
    public function update(MessageTplGroupUpdateCmd $messageTplGroupUpdateCmd): EmptyVO
    {
        return $this->messageTplGroupUpdateCmdExe->execute($messageTplGroupUpdateCmd);
    }

    #[Method(name: '删除消息模板-分组信息')]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplGroupDeleteCmdExe->execute($id);
    }

    #[Method(name: '获取单个消息模板-分组信息')]
    public function getById(int $id): MessageTplGroupVO
    {
        return $this->messageTplGroupGetByIdQryExe->execute($id);
    }
}
