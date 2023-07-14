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
use Uss\Message\App\Executor\Command\MessageTplCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplListByPageQryExe;
use Uss\Message\Client\Api\MessageTplService;
use Uss\Message\Client\Dto\Command\MessageTplCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplVO;

/**
 * 消息模版.
 */
#[API(name: '消息模版')]
class MessageTplRpcService extends AbstractRpcService implements MessageTplService
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

    #[Method(name: '消息模版列表')]
    public function listByPage(MessageTplListByPageQry $messageTplListByPageQry): PageVO
    {
        return $this->messageTplListByPageQryExe->execute($messageTplListByPageQry);
    }

    #[Method(name: '创建消息模版信息')]
    public function create(MessageTplCreateCmd $messageTplCreateCmd): IdVO
    {
        return $this->messageTplCreateCmdExe->execute($messageTplCreateCmd);
    }

    #[Method(name: '修改消息模版信息')]
    public function update(MessageTplUpdateCmd $messageTplUpdateCmd): EmptyVO
    {
        return $this->messageTplUpdateCmdExe->execute($messageTplUpdateCmd);
    }

    #[Method(name: '删除消息模版信息')]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplDeleteCmdExe->execute($id);
    }

    #[Method(name: '获取单个消息模版信息')]
    public function getById(int $id): MessageTplVO
    {
        return $this->messageTplGetByIdQryExe->execute($id);
    }
}
