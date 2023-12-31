# 简介
通用支撑管理系统（USS Universal Support System），旨在抽象业务模块，向下沉淀为基础支撑域模块，避免业务模块的重复开发

# 模块列表
### 消息通知模块
#### 简介
这是一个简洁、独立的消息管理模块，可无缝接入所有老系统。也同时是一个开箱即用的消息服务系统。无需代码配置，不会随业务的变动而产生迭代需求。所有的业务变动都焦距在API的参数里
#### 依赖
* Mysql >= 5.7
* Redis
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
>> * 企业微信群
>> * 飞书群
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