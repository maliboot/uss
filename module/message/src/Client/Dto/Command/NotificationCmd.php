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
 * MessageCreateCmd.
 *
 * @method string getUpdatedName() 获取更新人名称.
 * @method self setUpdatedName(string $updatedName) 设置更新人名称.
 * @method int getUpdatedId() 获取更新人id.
 * @method self setUpdatedId(int $updatedId) 设置更新人id.
 * @method string getCreatedName() 获取创建人名称.
 * @method self setCreatedName(string $createdName) 设置创建人名称.
 * @method int getCreatedId() 获取创建人id.
 * @method self setCreatedId(int $createdId) 设置创建人id.
 * @method string getPostPlanTime() 获取计划发送时间.
 * @method array getVars() 获取模板变量内容.
 * @method self setVars(array $vars) 设置模板变量内容.
 * @method string getTplGroupUniqid() 获取模板分组标识.
 * @method self setTplGroupUniqid(string $tplGroupUniqid) 设置模板分组标识.
 * @method string getMailFiles() 获取邮件附件.
 * @method self setMailFiles(string $mailFiles) 设置邮件附件.
 * @method string getFrom() 获取发送人标识，如邮箱，手机号，机器人唯一标识.
 * @method self setFrom(string $from) 设置发送人标识，如邮箱，手机号，机器人唯一标识.
 * @method string getFromName() 获取发送人名称.
 * @method self setFromName(string $fromName) 设置发送人名称.
 * @method self setPostPlanTime(string $postPlanTime) 设置计划发送时间.
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
 * @method self setBizCallbackUrl(string $bizCallbackUrl) 设置扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段.
 * @method string getBizCallbackUrl() 获取扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段.
 */
#[DataTransferObject(name: 'Message', type: 'command')]
class NotificationCmd extends AbstractCommand
{
    #[Field(name: '模板分组标识', type: 'string')]
    private string $tplGroupUniqid;

    #[Field(name: '模板变量内容', type: 'string')]
    private string $vars = '';

    #[Field(name: '邮件附件', type: 'string')]
    private string $mailFiles = '';

    #[Field(name: '发送人标识，如邮箱，手机号，机器人唯一标识', type: 'string')]
    private string $from = '';

    #[Field(name: '发送人名称', type: 'string')]
    private string $fromName = '';

    #[Field(name: '计划发送时间', type: 'string')]
    private string $postPlanTime = '';

    #[Field(name: '请求（客户端）序列号（如回溯日志）。同批次号，一组消息模板发一次消息为一个批次', type: 'string')]
    private string $requestId;

    #[Field(name: '请求来源（客户端），如项目（模块）名称，业务关键词等…', type: 'string')]
    private string $requestSource;

    #[Field(name: '扩展字段-业务id，如订单id、商品id，上（下）游客户id，销售库存id、账单id、审批id等….', type: 'int')]
    private int $bizId = 0;

    #[Field(name: '扩展字段-业务编号，如验证码、订单号、库存编号、还款编号、审批编号等….', type: 'string')]
    private string $bizNo = '';

    #[Field(name: '扩展字段-业务类型，如验证码类型、订单类型、仓库类型、还款类型、审批类型等…', type: 'string')]
    private string $bizType = '';

    #[Field(name: '扩展字段-业务其它内容', type: 'string')]
    private string $bizExt = '';

    #[Field(name: '扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段', type: 'string')]
    private string $bizCallbackUrl = '';

    #[Field(name: '创建人id ', type: 'int')]
    private int $createdId = 0;

    #[Field(name: '创建人名称', type: 'string')]
    private string $createdName = '';

    #[Field(name: '更新人id  ', type: 'int')]
    private int $updatedId = 0;

    #[Field(name: '更新人名称 ', type: 'string')]
    private string $updatedName = '';

    /**
     * @return string ...
     */
    public function getDefaultPostPlanTime(): string
    {
        if ($this->postPlanTime === '') {
            return date('Y-m-d H:i:s');
        }
        return $this->postPlanTime;
    }

    public function parseVarsToArray(): array
    {
        if (empty($this->vars)) {
            return [];
        }
        $result = json_decode($this->vars, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $result = [];
        }
        return $result;
    }

    public function getBizExtByJson(): string
    {
        return $this->getDefaultJson($this->getBizExt());
    }

    public function getMailFilesByJson(): string
    {
        return $this->getDefaultJson($this->getMailFiles());
    }

    protected function getDefaultJson(string $str): string
    {
        $result = json_decode($str, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $result = [];
        }
        return json_encode($result);
    }
}
