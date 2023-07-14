<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Client\Dto\Command;

use MaliBoot\Dto\AbstractCommand;
use MaliBoot\Dto\Annotation\DataTransferObject;
use MaliBoot\Dto\Annotation\Field;

/**
 * MessageUpdateCmd.
 *
 * @method int getId() ...
 * @method self setId(int $id) ...
 * @method int getTplId() 获取模板id.
 * @method self setTplId(int $tplId) 设置模板id.
 * @method int getTplGroupId() 获取模板分组id.
 * @method self setTplGroupId(int $tplGroupId) 设置模板分组id.
 * @method int getType() 获取类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群.
 * @method self setType(int $type) 设置类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群.
 * @method string getTitle() 获取标题.
 * @method self setTitle(string $title) 设置标题.
 * @method string getContent() 获取内容.
 * @method self setContent(string $content) 设置内容.
 * @method int getContentType() 获取内容类型 0text 1html 2markdown.
 * @method self setContentType(int $contentType) 设置内容类型 0text 1html 2markdown.
 * @method string getAppLink() 获取App推送-跳转页面链接.
 * @method self setAppLink(string $appLink) 设置App推送-跳转页面链接.
 * @method string getMailFiles() 获取邮件附件.
 * @method self setMailFiles(string $mailFiles) 设置邮件附件.
 * @method string getFrom() 获取发送人标识，如邮箱，手机号，机器人唯一标识.
 * @method self setFrom(string $from) 设置发送人标识，如邮箱，手机号，机器人唯一标识.
 * @method string getFromName() 获取发送人名称.
 * @method self setFromName(string $fromName) 设置发送人名称.
 * @method string getTo() 获取收信人标识，如邮箱，手机号。一般情况为1个。群发时为多个.
 * @method self setTo(string $to) 设置收信人标识，如邮箱，手机号。一般情况为1个。群发时为多个.
 * @method string getPostPlanTime() 获取计划发送时间.
 * @method self setPostPlanTime(string $postPlanTime) 设置计划发送时间.
 * @method string getPostTime() 获取实际发送时间.
 * @method self setPostTime(string $postTime) 设置实际发送时间.
 * @method int getPostState() 获取发送状态：0待发送 1已发送 2发送失败.
 * @method self setPostState(int $postState) 设置发送状态：0待发送 1已发送 2发送失败.
 * @method string getReadTime() 获取阅读时间.
 * @method self setReadTime(string $readTime) 设置阅读时间.
 * @method string getRequestId() 获取请求（客户端）序列号（如回溯日志）。同批次号，一组消息模板发一次消息为一个批次.
 * @method self setRequestId(string $requestId) 设置请求（客户端）序列号（如回溯日志）。同批次号，一组消息模板发一次消息为一个批次.
 * @method string getRequestSource() 获取请求来源（客户端），如项目（模块）名称，业务关键词等….
 * @method self setRequestSource(string $requestSource) 设置请求来源（客户端），如项目（模块）名称，业务关键词等….
 * @method int getBizId() 获取扩展字段-业务id，如订单id、商品id，上（下）游客户id，销售库存id、账单id、审批id等…..
 * @method self setBizId(int $bizId) 设置扩展字段-业务id，如订单id、商品id，上（下）游客户id，销售库存id、账单id、审批id等…..
 * @method string getBizNo() 获取扩展字段-业务编号，如验证码、订单号、库存编号、还款编号、审批编号等…..
 * @method self setBizNo(string $bizNo) 设置扩展字段-业务编号，如验证码、订单号、库存编号、还款编号、审批编号等…..
 * @method string getBizType() 获取扩展字段-业务类型，如验证码类型、订单类型、仓库类型、还款类型、审批类型等….
 * @method self setBizType(string $bizType) 设置扩展字段-业务类型，如验证码类型、订单类型、仓库类型、还款类型、审批类型等….
 * @method string getBizExt() 获取扩展字段-业务其它内容.
 * @method self setBizExt(string $bizExt) 设置扩展字段-业务其它内容.
 * @method string getBizCallbackUrl() 获取扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段.
 * @method self setBizCallbackUrl(string $bizCallbackUrl) 设置扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段.
 * @method int getCreatedId() 获取创建人id .
 * @method self setCreatedId(int $createdId) 设置创建人id .
 * @method string getCreatedName() 获取创建人名称.
 * @method self setCreatedName(string $createdName) 设置创建人名称.
 * @method int getUpdatedId() 获取更新人id  .
 * @method self setUpdatedId(int $updatedId) 设置更新人id  .
 * @method string getUpdatedName() 获取更新人名称 .
 * @method self setUpdatedName(string $updatedName) 设置更新人名称 .
 * @method string getCreatedAt() 获取创建时间.
 * @method self setCreatedAt(string $createdAt) 设置创建时间.
 * @method string getUpdatedAt() 获取更新时间.
 * @method self setUpdatedAt(string $updatedAt) 设置更新时间.
 * @method string getDeletedAt() 获取删除时间.
 * @method self setDeletedAt(string $deletedAt) 设置删除时间.
 */
#[DataTransferObject(name: 'Message', type: 'command')]
class MessageUpdateCmd extends AbstractCommand
{
    #[Field(name: '', type: 'int')]
    private int $id;

    #[Field(name: '模板id', type: 'int')]
    private int $tplId;

    #[Field(name: '模板分组id', type: 'int')]
    private int $tplGroupId;

    #[Field(name: '类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群', type: 'int')]
    private int $type;

    #[Field(name: '标题', type: 'string')]
    private string $title;

    #[Field(name: '内容', type: 'string')]
    private string $content;

    #[Field(name: '内容类型 0text 1html 2markdown', type: 'int')]
    private int $contentType;

    #[Field(name: 'App推送-跳转页面链接', type: 'string')]
    private string $appLink;

    #[Field(name: '邮件附件', type: 'string')]
    private string $mailFiles;

    #[Field(name: '发送人标识，如邮箱，手机号，机器人唯一标识', type: 'string')]
    private string $from;

    #[Field(name: '发送人名称', type: 'string')]
    private string $fromName;

    #[Field(name: '收信人标识，如邮箱，手机号。一般情况为1个。群发时为多个', type: 'string')]
    private string $to;

    #[Field(name: '计划发送时间', type: 'string')]
    private string $postPlanTime;

    #[Field(name: '实际发送时间', type: 'string')]
    private string $postTime;

    #[Field(name: '发送状态：0待发送 1已发送 2发送失败', type: 'int')]
    private int $postState;

    #[Field(name: '阅读时间', type: 'string')]
    private string $readTime;

    #[Field(name: '请求（客户端）序列号（如回溯日志）。同批次号，一组消息模板发一次消息为一个批次', type: 'string')]
    private string $requestId;

    #[Field(name: '请求来源（客户端），如项目（模块）名称，业务关键词等…', type: 'string')]
    private string $requestSource;

    #[Field(name: '扩展字段-业务id，如订单id、商品id，上（下）游客户id，销售库存id、账单id、审批id等….', type: 'int')]
    private int $bizId;

    #[Field(name: '扩展字段-业务编号，如验证码、订单号、库存编号、还款编号、审批编号等….', type: 'string')]
    private string $bizNo;

    #[Field(name: '扩展字段-业务类型，如验证码类型、订单类型、仓库类型、还款类型、审批类型等…', type: 'string')]
    private string $bizType;

    #[Field(name: '扩展字段-业务其它内容', type: 'string')]
    private string $bizExt;

    #[Field(name: '扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段', type: 'string')]
    private string $bizCallbackUrl;

    #[Field(name: '创建人id ', type: 'int')]
    private int $createdId;

    #[Field(name: '创建人名称', type: 'string')]
    private string $createdName;

    #[Field(name: '更新人id  ', type: 'int')]
    private int $updatedId;

    #[Field(name: '更新人名称 ', type: 'string')]
    private string $updatedName;

    #[Field(name: '创建时间', type: 'string')]
    private string $createdAt;

    #[Field(name: '更新时间', type: 'string')]
    private string $updatedAt;

    #[Field(name: '删除时间', type: 'string')]
    private string $deletedAt;
}
