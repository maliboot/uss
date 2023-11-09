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
use Uss\Message\App\Executor\Command\MessageTplServerCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplServerDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplServerUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplServerGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplServerListByPageQryExe;
use Uss\Message\Client\Api\MessageTplServerService;
use Uss\Message\Client\Dto\Command\MessageTplServerCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplServerUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplServerListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplServerVO;

/**
 * 消息模板-服务配置，如机器人、邮件发件人等….
 */
#[API(name: '消息模板-服务配置，如机器人、邮件发件人等…')]
class MessageTplServerRpcService extends AbstractRpcService implements MessageTplServerService
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

    #[Method(name: '消息模板-服务配置，如机器人、邮件发件人等…列表')]
    public function listByPage(MessageTplServerListByPageQry $messageTplServerListByPageQry): PageVO
    {
        return $this->messageTplServerListByPageQryExe->execute($messageTplServerListByPageQry);
    }

    #[Method(name: '创建消息模板-服务配置，如机器人、邮件发件人等…信息')]
    public function create(MessageTplServerCreateCmd $messageTplServerCreateCmd): IdVO
    {
        return $this->messageTplServerCreateCmdExe->execute($messageTplServerCreateCmd);
    }

    #[Method(name: '修改消息模板-服务配置，如机器人、邮件发件人等…信息')]
    public function update(MessageTplServerUpdateCmd $messageTplServerUpdateCmd): EmptyVO
    {
        return $this->messageTplServerUpdateCmdExe->execute($messageTplServerUpdateCmd);
    }

    #[Method(name: '删除消息模板-服务配置，如机器人、邮件发件人等…信息')]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplServerDeleteCmdExe->execute($id);
    }

    #[Method(name: '获取单个消息模板-服务配置，如机器人、邮件发件人等…信息')]
    public function getById(int $id): MessageTplServerVO
    {
        return $this->messageTplServerGetByIdQryExe->execute($id);
    }
}
