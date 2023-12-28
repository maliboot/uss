<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Client\Dto\Command;

use MaliBoot\Dto\Annotation\DataTransferObject;
use MaliBoot\Lombok\Annotation\Field;

/**
 * MessageCreateCmd.
 */
#[DataTransferObject(name: 'Message', type: 'command')]
class MessageCreateCmd
{
    #[Field(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Field(name: 'tplId', type: 'int', desc: '模板id')]
    private int $tplId;

    #[Field(name: 'tplGroupId', type: 'int', desc: '模板分组id')]
    private int $tplGroupId;

    #[Field(name: 'type', type: 'int', desc: '类型0邮件1阿里云短信2App推送4websocket8钉钉群')]
    private int $type;

    #[Field(name: 'title', type: 'string', desc: '标题')]
    private string $title;

    #[Field(name: 'content', type: 'string', desc: '内容')]
    private string $content;

    #[Field(name: 'contentType', type: 'int', desc: '内容类型0text1html2markdown')]
    private int $contentType;

    #[Field(name: 'mailFiles', type: 'string', desc: '邮件附件')]
    private string $mailFiles;

    #[Field(name: 'from', type: 'string', desc: '发送人标识，如邮箱，手机号，机器人唯一标识')]
    private string $from;

    #[Field(name: 'fromName', type: 'string', desc: '发送人名称')]
    private string $fromName;

    #[Field(name: 'to', type: 'string', desc: '收信人标识，如邮箱，手机号。一般情况为1个。群发时为多个')]
    private string $to;

    #[Field(name: 'postPlanTime', type: 'string', desc: '计划发送时间')]
    private string $postPlanTime;

    #[Field(name: 'postTime', type: 'string', desc: '实际发送时间')]
    private string $postTime;

    #[Field(name: 'postState', type: 'int', desc: '发送状态：0待发送1已发送2发送失败')]
    private int $postState;

    #[Field(name: 'readTime', type: 'string', desc: '阅读时间')]
    private string $readTime;

    #[Field(name: 'requestId', type: 'string', desc: '请求（客户端）序列号（如回溯日志）。同批次号，一组消息模板发一次消息为一个批次')]
    private string $requestId;

    #[Field(name: 'requestSource', type: 'string', desc: '请求来源（客户端），如项目（模块）名称，业务关键词等…')]
    private string $requestSource;

    #[Field(name: 'bizId', type: 'int', desc: '扩展字段-业务id，如订单id、商品id，上（下）游客户id，销售库存id、账单id、审批id等…')]
    private int $bizId;

    #[Field(name: 'bizNo', type: 'string', desc: '扩展字段-业务编号，如验证码、订单号、库存编号、还款编号、审批编号等…')]
    private string $bizNo;

    #[Field(name: 'bizType', type: 'string', desc: '扩展字段-业务类型，如验证码类型、订单类型、仓库类型、还款类型、审批类型等…')]
    private string $bizType;

    #[Field(name: 'bizExt', type: 'string', desc: '扩展字段-业务其它内容')]
    private string $bizExt;

    #[Field(name: 'bizCallbackUrl', type: 'string', desc: '扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段')]
    private string $bizCallbackUrl;

    #[Field(name: 'createdId', type: 'int', desc: '创建人id')]
    private int $createdId;

    #[Field(name: 'createdName', type: 'string', desc: '创建人名称')]
    private string $createdName;

    #[Field(name: 'updatedId', type: 'int', desc: '更新人id')]
    private int $updatedId;

    #[Field(name: 'updatedName', type: 'string', desc: '更新人名称')]
    private string $updatedName;

    #[Field(name: 'createdAt', type: 'string', desc: '创建时间')]
    private string $createdAt;

    #[Field(name: 'updatedAt', type: 'string', desc: '更新时间')]
    private string $updatedAt;

    #[Field(name: 'deletedAt', type: 'string', desc: '删除时间')]
    private string $deletedAt;
}
