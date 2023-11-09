<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\DataObject;

use MaliBoot\Cola\Annotation\Database;
use Uss\Message\Domain\Model\MessageTplGroup\MessageTpl;

/**
 * 消息模版.
 */
#[Database(softDeletes: true)]
class MessageTplDO
{
    private int $id;

    /**
     * 分组id.
     */
    private int $groupId;

    /**
     * 模板类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群.
     */
    private int $type;

    /**
     * 模板标题.
     */
    private string $title;

    /**
     * 模板内容.
     */
    private string $content;

    /**
     * 内容类型 0text 1html 2markdown.
     */
    private int $contentType;

    /**
     * App推送-跳转页面链接id，type=2时必填.
     */
    private int $appLinkId;

    /**
     * 服务配置id，如机器人服务配置、邮件服务配置等….
     */
    private int $serverId;

    /**
     * 短信模板配置id，短信时时必填.
     */
    private int $smsTemplateId;

    /**
     * 推送手机，type=1、2、8时必填.
     */
    private string $phones;

    /**
     * 推送邮箱，type=0时必填.
     */
    private string $emails;

    /**
     * 模板状态 0不启用 1启用.
     */
    private int $status;

    /**
     * 订阅消费话题，type=4、mqtt等时必填.
     */
    private string $topic;

    /**
     * 创建人id.
     */
    private int $createdId;

    /**
     * 创建人名称.
     */
    private string $createdName;

    /**
     * 更新人id.
     */
    private int $updatedId;

    /**
     * 更新人名称.
     */
    private string $updatedName;

    /**
     * 创建时间.
     */
    private string $createdAt;

    /**
     * 更新时间.
     */
    private string $updatedAt;

    /**
     * 删除时间.
     */
    private string $deletedAt;

    protected function getEntityFQN(): ?string
    {
        return MessageTpl::class;
    }
}
