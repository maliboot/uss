<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Domain\Model\Message;

use MaliBoot\Cola\Annotation\AggregateRoot;
use MaliBoot\Cola\Annotation\Field;
use MaliBoot\Cola\Domain\AbstractEntity;
use MaliBoot\Cola\Domain\AggregateRootInterface;
use MaliBoot\Cola\Domain\EntityInterface;
use Uss\Message\Domain\Model\MessageTplServer\MessageTplServer;

/**
 * 消息推送
 *
 * @method string getContentVars() 获取内容变量.
 * @method self setContentVars(string $contentVars) 设置内容变量.
 * @method string getSmsTemplateCode() 获取短信模板code编号.
 * @method self setSmsTemplateCode(string $smsTemplateCode) 设置短信模板code编号.
 * @method string getSmsSign() 获取短信签名.
 * @method self setSmsSign(string $smsSign) 设置短信签名.
 * @method string getPostError() 获取发送失败错误信息.
 * @method self setPostError(string $postError) 设置发送失败错误信息.
 * @method string getUniqid() 获取唯一识别符（不可重复）.
 * @method self setUniqid(string $uniqid) 设置唯一识别符（不可重复）.
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
#[AggregateRoot(name: 'Message', desc: '消息推送')]
class Message extends AbstractEntity implements AggregateRootInterface
{
    #[Field(name: '')]
    private int $id;

    #[Field(name: '唯一识别符（不可重复）')]
    private string $uniqid;

    #[Field(name: '模板id')]
    private int $tplId;

    #[Field(name: '模板分组id')]
    private int $tplGroupId;

    /**
     * @var MessageTplServer 服务配置，如机器人服务配置、邮件服务配置等…
     */
    private MessageTplServer $server;

    #[Field(name: '类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群')]
    private int $type;

    #[Field(name: '标题')]
    private string $title;

    #[Field(name: '内容')]
    private string $content;

    #[Field(name: '内容类型 0text 1html 2markdown')]
    private int $contentType;

    #[Field(name: 'App推送-跳转页面链接')]
    private string $appLink;

    #[Field(name: '邮件附件')]
    private string $mailFiles;

    #[Field(name: '短信签名')]
    private string $smsSign;

    #[Field(name: '短信模板code编号')]
    private string $smsTemplateCode;

    #[Field(name: '内容变量')]
    private string $contentVars;

    #[Field(name: '发送人标识，如邮箱，手机号，机器人唯一标识')]
    private string $from;

    #[Field(name: '发送人名称')]
    private string $fromName;

    #[Field(name: '收信人标识，如邮箱，手机号。一般情况为1个。群发时为多个')]
    private string $to;

    #[Field(name: '计划发送时间')]
    private string $postPlanTime;

    #[Field(name: '实际发送时间')]
    private string $postTime;

    #[Field(name: '发送状态：0待发送 1已发送 2发送失败')]
    private int $postState;

    #[Field(name: '发送失败错误信息')]
    private string $postError;

    #[Field(name: '阅读时间')]
    private string $readTime;

    #[Field(name: '请求（客户端）序列号（如回溯日志）。同批次号，一组消息模板发一次消息为一个批次')]
    private string $requestId;

    #[Field(name: '请求来源（客户端），如项目（模块）名称，业务关键词等…')]
    private string $requestSource;

    #[Field(name: '扩展字段-业务id，如订单id、商品id，上（下）游客户id，销售库存id、账单id、审批id等….')]
    private int $bizId;

    #[Field(name: '扩展字段-业务编号，如验证码、订单号、库存编号、还款编号、审批编号等….')]
    private string $bizNo;

    #[Field(name: '扩展字段-业务类型，如验证码类型、订单类型、仓库类型、还款类型、审批类型等…')]
    private string $bizType;

    #[Field(name: '扩展字段-业务其它内容')]
    private string $bizExt;

    #[Field(name: '扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段')]
    private string $bizCallbackUrl;

    #[Field(name: '创建人id ')]
    private int $createdId;

    #[Field(name: '创建人名称')]
    private string $createdName;

    #[Field(name: '更新人id  ')]
    private int $updatedId;

    #[Field(name: '更新人名称 ')]
    private string $updatedName;

    #[Field(name: '创建时间')]
    private string $createdAt;

    #[Field(name: '更新时间')]
    private string $updatedAt;

    #[Field(name: '删除时间')]
    private string $deletedAt;

    public function getServer(): MessageTplServer
    {
        return $this->server;
    }

    public function setServer(MessageTplServer $server): void
    {
        $this->server = $server;
    }

    public function getToList(): array
    {
        return json_decode($this->getTo(), true);
    }

    public function getContentVarsList(): array
    {
        return json_decode($this->getContentVars(), true);
    }

    public function getPostPlanDelay(): int
    {
        if (! $this->isPropertyInitialized('postPlanTime')) {
            return 0;
        }
        $delay = strtotime($this->getPostPlanTime()) - time();

        return max($delay, 0);
    }

    public function toArrayRecursion(): array
    {
        $result = [];
        $vars = get_class_vars(__CLASS__);
        foreach ($vars as $field => $val) {
            if (! $this->isPropertyInitialized($field)) {
                continue;
            }
            $val = $this->{$field};
            $result[$field] = $val;
            if ($val instanceof EntityInterface) {
                $result[$field] = $val->toArray();
            }
        }
        return $result;
    }
}
