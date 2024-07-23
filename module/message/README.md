# 消息通知模块
## 简介
这是一个简洁、独立的消息管理模块，可无缝接入所有老系统。也同时是一个开箱即用的消息服务系统。无需代码配置，不会随业务的变动而产生迭代需求。所有的业务变动都焦距在API的参数里
#### 功能列表
> 支持类型
>> * 邮件
>> * app推送
>> * 短信
>> * Websocket（站内信）
>> * Mqtt
>> * RabbitMQ
>> * Http
>> * 钉钉群
>> * 钉钉应用通知
>> * 企业微信群
>> * 飞书应用通知
>> * 扩展自定义类型，允许根据相应的`Interface`规范下，适配更多的消息适配器：
> ##### 业务解耦
> 本消息模块绝对独立，不依赖其它任何模块代码、数据库表（数据隔离）。既可与其它模块一起运行使用，也可以当成一个消息系统开箱即用
>> * 通过API交互，平滑接入自有老平台的后台用户管理、客户管理模块
>> * 预留业务扩展字段，平滑接入自有老平台系统模块，如
     >>   * 订单模块
>>   * 商品模块
>>   * 审批模块
>>   * 还款模块
>>   * 审批模块
>>   * ......
>> * 支持消息回调，每条消息模板都可单独配置回调。当业务异步感知后，可通过回调的业务扩展字段定制老系统业务逻辑
     > 消息模板
>> * 支持blade模板，发送消息时通过API送模板变量即可
>> * 支持blade-markdown语法，可在balde里编辑markdown
>> * 自定义模板变量管理、分组管理
>> * 自定义App推送链接管理、分组管理
>> * 消息服务账号配置管理，支持多不同账号、多不同消息配置化同时一并发送
     > 发送管理
>> * 支持定时发送
>> * 支持一个模板群发多人
>> * 支持多通道队列高速发送，可通过配置队列参数进一步提高性能
>> * 消息幂等，可分布式多实例部署
     > 日志回溯
>> * `requestId`交互，实时跟踪每一条消息
>> * `requestSrouce`交互，清晰回溯每一条消息来源
     > 异常报警
>> * 消息异常触发熔断，及时运维报警(需代码配置)。一般为第三方服务异常，如短信欠费，邮件密码被更改等
     > 内置消息管理模块的简单UI界面
>> * 地址: localhost:9501/ui/
>> * 建议根据UI接口的基础上进行API改造，平滑接入自有老系统UI
     > 自定义消息类型适配器
>> - 1、创建适配器类`Uss\Message\Infra\MessageSender\FooSender::class`，并继承`Uss\Message\Infra\MessageSender\AbstractMessageSender`
>> - 2、添加类注解：`Uss\Message\Infra\MessageSender\Annotation\MessageSender`
>> - 3、消息分发器会根据数据表`message.type`的值自动收集到该适配器，无需求额外代码配置，查看效果即可
>> - 4、当需要覆盖重写原有的适配器时，在继承原适配器类后，将自定义的适配类的注解参数`MessageSender::$priority`调整高即可
## 接口列表

### 发送消息接口

#### 描述
* 发送消息
#### 请求类型
* POST
#### 请求URL
* /admin/message/send
#### 请求参数
| 名称                        | 类型     | 是否必须 | 描述                                                                              |
|:--------------------------|:-------|:-----|:--------------------------------------------------------------------------------|
| tplGroupUniqid            | string | 是    | message_tpl_group.name字段                                                        |
| type                      | int    | 是    | 发送消息类型0邮件 1阿里云短信  2App推送  4websocket 8钉钉应用消息 16 飞书应用消息｜                         
| requestId                 | string | 是    | 请求（客户端）序列号（如回溯日志）。同批次号，一组消息模板发一次消息为一个批次                                         |
| requestSource             | string | 是    | 请求来源（客户端），如项目（模块）名称，业务关键词等…                                                     |
| appPushTo                | string | 是    | app推送-接收人手机号。一般情况为1个。群发时为多个。JSON串，当type为2时必填,[\\"13131067597\\"]格式              |
| smsTo                | string | 是    | 短信-接收人手机号。一般情况为1个。群发时为多个,JSON串，当type为0时必填,[\\"13131067597\\"]格式                 |
| mailTo                | string | 是    | 邮箱-接收人手机号。一般情况为1个。群发时为多个，JSON串，当type为0时必填,[\\"13131067597\\"]格式                 |
| title                     | string | 否    | 消息标题,如果为空则会取模版的title,表message_tpl.title                                         |
| content                   | string | 否    | 消息内容,如果为空则会取模版的content,表message_tpl.content                                     |
| vars                      | string | 否    | 模板变量内容,格式为json字符串如:{\"test\":\"aaa\"}                                           |
| from                      | string | 否    | 发送人标识，如邮箱，手机号，机器人唯一标识                                                           |
| fromName                  | string | 否    | 发送人名称                                                                           |
| postPlanTime              | string | 否    | 计划发送时间格式为 2024-7-19 12:00:00                                                    |
| bizId                     | int    | 否    | 扩展字段-业务id，如订单id、商品id，上（下）游客户id，销售库存id、账单id、审批id等…                               |
| bizNo                     | string | 否    | 扩展字段-业务编号，如验证码、订单号、库存编号、还款编号、审批编号等…                                             |
| bizType                   | string | 否    | 扩展字段-业务类型，如验证码类型、订单类型、仓库类型、还款类型、审批类型等…                                          |
| bizExt                    | string | 否    | 扩展字段-业务其它内容,格式为json字符串如:{\"test\":\"aaa\"}                                      |
| bizCallbackUrl            | string | 否    | 扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段                                      |
| bizCallbackResponse       | string | 否    | 回调响应内容,json格式                                                                   |
| createdId                 | string | 否    | 创建人id，默认为0                                                                      |
| createdName               | string | 否    | 创建人名称，默认为空                                                                      |
| mailFiles                 | string | 否    | 邮件附件，当type为0邮件并且需要发送附件时传入，结构为 [\"fujian1_url_address\",\"fujian2_url_address\"] |
| appLinkUri                | string | 否    | appLinkUri 当type类型为2时传入                                                         |
| appLinkAndroidUriActivity | string | 否    | 当type类型为2时传入  appLinkAndroidUriActivity                                         |
| agentId                   | int    | 否    | 应用ID                                                                            |
#### Header 参数
| 名称           | 类型     | 是否必须 | 描述                                                |
|:-------------|:-------|:-----|:--------------------------------------------------|
| Content-Type | string | 是    | application/json                                  |
#### 请求发送飞书消息示例
```
{
    "tplGroupUniqid": "tg6696371b010bc",
    "type": 16,
    "requestId": "19b5f70b1a1d7b9cf1a49b2aa41066ae",
    "requestSource": "testHttp",
    "title": "飞书通知",
    "content": "测试",
    "to": "[\"13111122233\"]",
    "from": "13111122234",
    "fromName": "测试发送",
    "postPlanTime": "2024-7-19 12:00:00",
    "bizId": 1,
    "bizNo": "SCO2323",
    "bizType": "order",
    "bizCallbackUrl": "http://www.baidu.com",
    "bizExt": "{\"test\":\"aaa\"}",
    "createdId": 3,
    "createdName": "测试创建消息"
}
```
#### 返回结构
```
{
    "code": 0,
    "msg": "success",
    "data": {
    }
}
```
#### 错误编码
|       错误代码        |   描述   |  语义   |    
|:---------------:|:------:|:-----:|
| 100001 | 服务器异常 | 服务器错误 |          