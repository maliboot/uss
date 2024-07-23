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
use MaliBoot\Database\Annotation\Column;

/**
 * 消息推送
 */
#[Database(softDeletes: true)]
class MessageDO
{
    #[Column(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Column(name: 'uniqid', type: 'string', desc: '唯一识别符（不可重复）')]
    private string $uniqid;

    #[Column(name: 'agent_id', type: 'int', desc: '应用id')]
    private int $agentId;

    #[Column(name: 'tpl_id', type: 'int', desc: '模板id')]
    private int $tplId;

    #[Column(name: 'tpl_group_id', type: 'int', desc: '模板分组id')]
    private int $tplGroupId;

    #[Column(name: 'type', type: 'int', desc: '类型0邮件1阿里云短信2App推送4websocket8钉钉群')]
    private int $type;

    #[Column(name: 'title', type: 'string', desc: '标题')]
    private string $title;

    #[Column(name: 'content', type: 'string', desc: '内容')]
    private string $content;

    #[Column(name: 'mail_files', type: 'string', desc: '邮件附件')]
    private string $mailFiles;

    #[Column(name: 'sms_sign', type: 'string', desc: '短信签名')]
    private string $smsSign;

    #[Column(name: 'sms_template_code', type: 'string', desc: '短信模板code编号')]
    private string $smsTemplateCode;

    #[Column(name: 'app_link_ext', type: 'string', desc: 'App推送可选参数')]
    private string $appLinkExt;

    #[Column(name: 'content_vars', type: 'string', desc: '内容变量')]
    private string $contentVars;

    #[Column(name: 'from', type: 'string', desc: '发送人标识，如邮箱，手机号，机器人唯一标识')]
    private string $from;

    #[Column(name: 'from_name', type: 'string', desc: '发送人名称')]
    private string $fromName;

    #[Column(name: 'to', type: 'string', desc: '收信人标识，如邮箱，手机号。一般情况为1个。群发时为多个')]
    private string $to;

    #[Column(name: 'post_plan_time', type: 'string', desc: '计划发送时间')]
    private string $postPlanTime;

    #[Column(name: 'post_time', type: 'string', desc: '实际发送时间')]
    private string $postTime;

    #[Column(name: 'post_state', type: 'int', desc: '发送状态：0待发送1已发送2发送失败')]
    private int $postState;

    #[Column(name: 'post_error', type: 'string', desc: '发送失败错误信息')]
    private string $postError;

    #[Column(name: 'read_time', type: 'string', desc: '阅读时间')]
    private string $readTime;

    #[Column(name: 'request_id', type: 'string', desc: '请求（客户端）序列号（如回溯日志）。同批次号，一组消息模板发一次消息为一个批次')]
    private string $requestId;

    #[Column(name: 'request_source', type: 'string', desc: '请求来源（客户端），如项目（模块）名称，业务关键词等…')]
    private string $requestSource;

    #[Column(name: 'biz_id', type: 'int', desc: '扩展字段-业务id，如订单id、商品id，上（下）游客户id，销售库存id、账单id、审批id等…')]
    private int $bizId;

    #[Column(name: 'biz_no', type: 'string', desc: '扩展字段-业务编号，如验证码、订单号、库存编号、还款编号、审批编号等…')]
    private string $bizNo;

    #[Column(name: 'biz_type', type: 'string', desc: '扩展字段-业务类型，如验证码类型、订单类型、仓库类型、还款类型、审批类型等…')]
    private string $bizType;

    #[Column(name: 'biz_ext', type: 'string', desc: '扩展字段-业务其它内容')]
    private string $bizExt;

    #[Column(name: 'biz_callback_url', type: 'string', desc: '扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段')]
    private string $bizCallbackUrl;

    #[Column(name: 'biz_callback_response', type: 'string', desc: '回调响应内容')]
    private string $bizCallbackResponse;

    #[Column(name: 'created_id', type: 'int', desc: '创建人id')]
    private int $createdId;

    #[Column(name: 'created_name', type: 'string', desc: '创建人名称')]
    private string $createdName;

    #[Column(name: 'updated_id', type: 'int', desc: '更新人id')]
    private int $updatedId;

    #[Column(name: 'updated_name', type: 'string', desc: '更新人名称')]
    private string $updatedName;

    #[Column(name: 'created_at', type: 'string', desc: '创建时间')]
    private string $createdAt;

    #[Column(name: 'updated_at', type: 'string', desc: '更新时间')]
    private string $updatedAt;

    #[Column(name: 'deleted_at', type: 'string', desc: '删除时间')]
    private string $deletedAt;
}
