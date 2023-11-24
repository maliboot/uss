<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Client\Dto\Command;

use JetBrains\PhpStorm\ExpectedValues;
use MaliBoot\Dto\Annotation\DataTransferObject;

/**
 * MessageCreateCmd.
 */
#[DataTransferObject(name: 'Message', type: 'command')]
class NotificationCmd
{
    /**
     * 模板分组标识.
     */
    private string $tplGroupUniqid;

    /**
     * 模板变量内容.
     */
    private string $vars = '';

    private string $title;

    private string $content;

    /**
     * 邮件附件.
     */
    private string $mailFiles = '';

    private string $appLinkUri;

    private string $appLinkAndroidUriActivity;

    /**
     * 发送人标识，如邮箱，手机号，机器人唯一标识.
     */
    private string $from = '';

    /**
     * 发送人名称.
     */
    private string $fromName = '';

    /**
     * app推送-接收人手机号。一般情况为1个。群发时为多个。JSON串，选填.
     */
    private string $appPushTo = '';

    /**
     * 短信-接收人手机号。一般情况为1个。群发时为多个。JSON串，选填.
     */
    private string $smsTo = '';

    /**
     * 邮箱-接收人手机号。一般情况为1个。群发时为多个。JSON串，选填.
     */
    private string $mailTo = '';

    /**
     * Topic-（消息发布）话题名。一般情况为1个。群发时为多个。JSON串，选填.
     */
    private string $websocketTo = '';

    /**
     * 计划发送时间.
     */
    private string $postPlanTime = '';

    /**
     * 请求（客户端）序列号（如回溯日志）。同批次号，一组消息模板发一次消息为一个批次.
     */
    private string $requestId;

    /**
     * 请求来源（客户端），如项目（模块）名称，业务关键词等….
     */
    private string $requestSource;

    /**
     * 扩展字段-业务id，如订单id、商品id，上（下）游客户id，销售库存id、账单id、审批id等…..
     */
    private int $bizId = 0;

    /**
     * 扩展字段-业务编号，如验证码、订单号、库存编号、还款编号、审批编号等…..
     */
    private string $bizNo = '';

    /**
     * 扩展字段-业务类型，如验证码类型、订单类型、仓库类型、还款类型、审批类型等….
     */
    private string $bizType = '';

    /**
     * 扩展字段-业务其它内容.
     */
    private string $bizExt = '';

    /**
     * 扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段.
     */
    private string $bizCallbackUrl = '';

    /**
     * 创建人id.
     */
    private int $createdId = 0;

    /**
     * 创建人名称.
     */
    private string $createdName = '';

    /**
     * 更新人id.
     */
    private int $updatedId = 0;

    /**
     * 更新人名称.
     */
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

    public function getArrayByJson(string $str, array $default = []): array
    {
        $result = json_decode($str, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $result = $default;
        }
        return $result;
    }

    public function getToList(#[ExpectedValues([0, 1, 2, 4])] int $type): array
    {
        return match ($type) {
            0 => $this->getArrayByJson($this->getMailTo()),
            1 => $this->getArrayByJson($this->getSmsTo()),
            2 => $this->getArrayByJson($this->getAppPushTo()),
            4 => $this->getArrayByJson($this->getWebsocketTo()),
            default => [],
        };
    }

    protected function getDefaultJson(string $str): string
    {
        return json_encode($this->getArrayByJson($str));
    }
}
