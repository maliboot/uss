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
use MaliBoot\Lombok\Annotation\Field;
use Uss\Message\Domain\Model\MessageTplAppLink\MessageTplAppLink;
use Uss\Message\Domain\Model\MessageTplServer\MessageTplServer;
use Uss\Message\Infra\Common\Json;

/**
 * 消息推送
 */
#[AggregateRoot(name: 'Message', desc: '消息推送')]
class Message
{
    #[Field(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Field(name: 'uniqid', type: 'string', desc: '唯一识别符（不可重复）')]
    private string $uniqid;

    #[Field(name: 'tplId', type: 'int', desc: '模板id')]
    private int $tplId;

    #[Field(name: 'tplGroupId', type: 'int', desc: '模板分组id')]
    private int $tplGroupId;

    #[Field(name: 'server', type: MessageTplServer::class, desc: '@varMessageTplServer服务配置，如机器人服务配置、邮件服务配置等…')]
    private MessageTplServer $server;

    #[Field(name: 'type', type: 'int', desc: '类型0邮件1阿里云短信2App推送4websocket8钉钉群')]
    private int $type;

    #[Field(name: 'title', type: 'string', desc: '标题')]
    private string $title;

    #[Field(name: 'content', type: 'string', desc: '内容')]
    private string $content;

    #[Field(name: 'contentType', type: 'int', desc: '内容类型0text1html2markdown')]
    private int $contentType;

    #[Field(name: 'appLink', type: MessageTplAppLink::class, desc: '@varMessageTplAppLinkApp推送-跳转页面配置')]
    private MessageTplAppLink $appLink;

    #[Field(name: 'mailFiles', type: 'string', desc: '邮件附件')]
    private string $mailFiles;

    #[Field(name: 'smsSign', type: 'string', desc: '短信签名')]
    private string $smsSign;

    #[Field(name: 'smsTemplateCode', type: 'string', desc: '短信模板code编号')]
    private string $smsTemplateCode;

    #[Field(name: 'appLinkExt', type: 'string', desc: 'App推送可选参数')]
    private string $appLinkExt;

    #[Field(name: 'contentVars', type: 'string', desc: '内容变量')]
    private string $contentVars;

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

    #[Field(name: 'postError', type: 'string', desc: '发送失败错误信息')]
    private string $postError;

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

    public function getServer(): MessageTplServer
    {
        return $this->server;
    }

    public function setServer(MessageTplServer $server): void
    {
        $this->server = $server;
    }

    public function setAppLink(MessageTplAppLink $appLink): void
    {
        $this->appLink = $appLink;
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

    public function initAppLinkExt(): void
    {
        $this->initJPushAppLinkExt();
    }

    protected function initJPushAppLinkExt(): void
    {
        $appLink = $this->getAppLink();
        $msgId = $this->getUniqid('');
        $sound = $appLink?->getSound();
        $bizExt = Json::decode($this->getBizExt(''));
        $openUrl = $appLink?->getUri() ?? '';
        $androidUriActivity = $appLink?->getAndroidUriActivity() ?? '';
        if (! empty($openUrl) && ! empty($bizExt)) {
            [$baseUri, $queryArr] = $this->parseUrl($openUrl);
            $openUrl = $baseUri . '?' . http_build_query([...$queryArr, ...$bizExt]);
        }
        $notification = ['extras' => ['message_id' => $msgId, 'open_url' => $openUrl, 'biz_id' => $this->getBizId(0), 'biz_no' => $this->getBizNo(''), 'biz_type' => $this->getBizType('')]];
        $sound && ($notification['sound'] = $sound);
        if (! empty($androidUriActivity) && str_contains($androidUriActivity, '://')) {
            if (str_contains($androidUriActivity, '?')) {
                $androidUriActivity .= '&open_url=' . urlencode($openUrl);
            } else {
                $androidUriActivity .= '?open_url=' . urlencode($openUrl);
            }
            $notification['intent']['url'] = $androidUriActivity;
        }
        $oldAppLinkExt = Json::decode($this->getAppLinkExt(''));
        $oldAppLinkExt['jpush'] = ['notification' => $notification];
        $this->setAppLinkExt(json_encode($oldAppLinkExt, JSON_UNESCAPED_UNICODE));
    }

    protected function parseUrl(string $url): array
    {
        $queryFlagIndex = mb_strpos($url, '?');
        $query = $queryFlagIndex === false ? '' : mb_substr($url, $queryFlagIndex + 1);
        $baseUri = $queryFlagIndex === false ? $url : mb_substr($url, 0, $queryFlagIndex);
        $queryArr = [];
        mb_parse_str($query, $queryArr);
        return [$baseUri, $queryArr];
    }
}
