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
use Uss\Message\App\Executor\Command\MessageTplAppLinkCreateCmdExe;
use Uss\Message\App\Executor\Command\MessageTplAppLinkDeleteCmdExe;
use Uss\Message\App\Executor\Command\MessageTplAppLinkUpdateCmdExe;
use Uss\Message\App\Executor\Query\MessageTplAppLinkGetByIdQryExe;
use Uss\Message\App\Executor\Query\MessageTplAppLinkListByPageQryExe;
use Uss\Message\Client\Api\MessageTplAppLinkService;
use Uss\Message\Client\Dto\Command\MessageTplAppLinkCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplAppLinkUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplAppLinkListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplAppLinkVO;

/**
 * 消息模板-app推送-页面跳转链接.
 */
#[API(name: '消息模板-app推送-页面跳转链接')]
class MessageTplAppLinkRpcService extends AbstractRpcService implements MessageTplAppLinkService
{
    #[Inject]
    protected MessageTplAppLinkListByPageQryExe $messageTplAppLinkListByPageQryExe;

    #[Inject]
    protected MessageTplAppLinkCreateCmdExe $messageTplAppLinkCreateCmdExe;

    #[Inject]
    protected MessageTplAppLinkUpdateCmdExe $messageTplAppLinkUpdateCmdExe;

    #[Inject]
    protected MessageTplAppLinkDeleteCmdExe $messageTplAppLinkDeleteCmdExe;

    #[Inject]
    protected MessageTplAppLinkGetByIdQryExe $messageTplAppLinkGetByIdQryExe;

    #[Method(name: '消息模板-app推送-页面跳转链接列表')]
    public function listByPage(MessageTplAppLinkListByPageQry $messageTplAppLinkListByPageQry): PageVO
    {
        return $this->messageTplAppLinkListByPageQryExe->execute($messageTplAppLinkListByPageQry);
    }

    #[Method(name: '创建消息模板-app推送-页面跳转链接信息')]
    public function create(MessageTplAppLinkCreateCmd $messageTplAppLinkCreateCmd): IdVO
    {
        return $this->messageTplAppLinkCreateCmdExe->execute($messageTplAppLinkCreateCmd);
    }

    #[Method(name: '修改消息模板-app推送-页面跳转链接信息')]
    public function update(MessageTplAppLinkUpdateCmd $messageTplAppLinkUpdateCmd): EmptyVO
    {
        return $this->messageTplAppLinkUpdateCmdExe->execute($messageTplAppLinkUpdateCmd);
    }

    #[Method(name: '删除消息模板-app推送-页面跳转链接信息')]
    public function delete(int $id): EmptyVO
    {
        return $this->messageTplAppLinkDeleteCmdExe->execute($id);
    }

    #[Method(name: '获取单个消息模板-app推送-页面跳转链接信息')]
    public function getById(int $id): MessageTplAppLinkVO
    {
        return $this->messageTplAppLinkGetByIdQryExe->execute($id);
    }
}
