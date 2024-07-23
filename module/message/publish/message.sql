/*
 Navicat Premium Data Transfer

 Target Server Type    : MySQL
 Target Server Version : 50735
 File Encoding         : 65001

 Date: 1/07/2023 12:36:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`
(
    `id`                int(11)      NOT NULL AUTO_INCREMENT,
    `uniqid`            varchar(255)      DEFAULT '' COMMENT '唯一识别符(不可重复)',
    `agent_id`          int(11)           DEFAULT '0' COMMENT '应用Id',
    `tpl_id`            int(11)           DEFAULT '0' COMMENT '模板id',
    `tpl_group_id`      int(11)           DEFAULT '0' COMMENT '模板分组id',
    `type`              tinyint(1)        DEFAULT '0' COMMENT '类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉应用消息 16飞书应用消息',
    `title`             varchar(255)      DEFAULT '' COMMENT '标题',
    `content`           text COMMENT '内容',
    `content_vars`      json              DEFAULT NULL COMMENT '模板变量值，如短信模板变量',
    `mail_files`        json              DEFAULT NULL COMMENT '邮件附件',
    `sms_sign`          varchar(255)      DEFAULT '' COMMENT '短信签名',
    `sms_template_code` varchar(255)      DEFAULT '' COMMENT '短信模板code号',
    `app_link_ext`      json         NULL COMMENT 'App推送可选参数',
    `from`              varchar(255)      DEFAULT '' COMMENT '发送人标识，如邮箱，手机号，机器人唯一标识',
    `from_name`         varchar(255)      DEFAULT '' COMMENT '发送人名称',
    `to`                json              DEFAULT NULL COMMENT '收信人标识，如邮箱，手机号。一般情况为1个。群发时为多个',
    `post_plan_time`    timestamp    NULL DEFAULT NULL COMMENT '计划发送时间',
    `post_time`         timestamp    NULL DEFAULT NULL COMMENT '实际发送时间',
    `post_state`        tinyint(1)        DEFAULT '0' COMMENT '发送状态：0待发送 1已发送 2发送失败',
    `post_error`        varchar(500)      DEFAULT '' COMMENT '发送失败错误信息',
    `read_time`         timestamp    NULL DEFAULT NULL COMMENT '阅读时间',
    `request_id`        varchar(255)      DEFAULT '' COMMENT '请求（客户端）序列号（如回溯日志）。同批次号，一组消息模板发一次消息为一个批次',
    `request_source`    varchar(255)      DEFAULT '' COMMENT '请求来源（客户端），如项目（模块）名称，业务关键词等…',
    `biz_id`            int(11)           DEFAULT '0' COMMENT '扩展字段-业务id，如订单id、商品id，上（下）游客户id，销售库存id、账单id、审批id等….',
    `biz_no`            varchar(255)      DEFAULT '' COMMENT '扩展字段-业务编号，如验证码、订单号、库存编号、还款编号、审批编号等….',
    `biz_type`          varchar(255)      DEFAULT '' COMMENT '扩展字段-业务类型，如验证码类型、订单类型、仓库类型、还款类型、审批类型等…',
    `biz_ext`           json              DEFAULT NULL COMMENT '扩展字段-业务其它内容',
    `biz_callback_url`  varchar(255)      DEFAULT '' COMMENT '扩展字段-业务回调地址。当消息发送完成（成功OR失败）时触发，回调参数为本表所有字段',
    `biz_callback_response`  json         DEFAULT NULL COMMENT '回调响应内容',
    `created_id`        int(11)           DEFAULT '0' COMMENT '创建人id ',
    `created_name`      varchar(255)      DEFAULT '' COMMENT '创建人名称',
    `updated_id`        int(11)           DEFAULT '0' COMMENT '更新人id  ',
    `updated_name`      varchar(255)      DEFAULT '' COMMENT '更新人名称 ',
    `created_at`        timestamp    NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at`        timestamp    NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    `deleted_at`        timestamp    NULL DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB
    COMMENT ='消息推送';

-- ----------------------------
-- Table structure for message_tpl
-- ----------------------------
DROP TABLE IF EXISTS `message_tpl`;
CREATE TABLE `message_tpl`
(
    `id`              int(11)   NOT NULL AUTO_INCREMENT,
    `group_id`        int(11)        DEFAULT '0' COMMENT '分组id',
    `type`            tinyint(1)     DEFAULT '0' COMMENT '类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉应用消息 16飞书应用消息',
    `title`           varchar(255)   DEFAULT '' COMMENT '模板标题',
    `content`         text COMMENT '模板内容',
    `app_link_id`     int(11)        DEFAULT '0' COMMENT 'App推送-跳转页面链接id，type=2时必填',
    `sms_template_id` int(11)        DEFAULT '0' COMMENT '短信模板配置id，短信时时必填',
    `server_id`       int(11)        DEFAULT '0' COMMENT '服务配置id，如机器人服务配置、邮件服务配置等…',
    `topic`           varchar(255)   DEFAULT '' COMMENT '订阅消费话题，type=4、mqtt等时必填',
    `phones`          json           DEFAULT NULL COMMENT '推送手机，type=1、2、8时必填',
    `emails`          json           DEFAULT NULL COMMENT '推送邮箱，type=0时必填',
    `status`          tinyint(1)     DEFAULT '0' COMMENT '模板状态 0不启用 1启用',
    `created_id`      int(11)        DEFAULT '0' COMMENT '创建人id ',
    `created_name`    varchar(255)   DEFAULT '' COMMENT '创建人名称',
    `updated_id`      int(11)        DEFAULT '0' COMMENT '更新人id  ',
    `updated_name`    varchar(255)   DEFAULT '' COMMENT '更新人名称 ',
    `created_at`      timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at`      timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    `deleted_at`      timestamp NULL DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB
    COMMENT ='消息模版';

-- ----------------------------
-- Table structure for message_tpl_app_link
-- ----------------------------
DROP TABLE IF EXISTS `message_tpl_app_link`;
CREATE TABLE `message_tpl_app_link`
(
    `id`                   int(11)   NOT NULL AUTO_INCREMENT,
    `server_id`            int(11)        DEFAULT '0' COMMENT '服务id',
    `name`                 varchar(255)   DEFAULT '' COMMENT '名称',
    `description`          varchar(255)   DEFAULT '' COMMENT '描述',
    `uri`                  varchar(255)   DEFAULT '' COMMENT '链接',
    `android_uri_activity` varchar(255)   DEFAULT '' COMMENT 'Android专用跳转参数，如极光推送时为uri_activity=xxxx',
    `sound`                varchar(255)   DEFAULT '' COMMENT '铃声',
    `status`               tinyint(1)     DEFAULT '0' COMMENT '状态 0不启用 1启用',
    `created_id`           int(11)        DEFAULT '0' COMMENT '创建人id ',
    `created_name`         varchar(255)   DEFAULT '' COMMENT '创建人名称',
    `updated_id`           int(11)        DEFAULT '0' COMMENT '更新人id  ',
    `updated_name`         varchar(255)   DEFAULT '' COMMENT '更新人名称 ',
    `created_at`           timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at`           timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    `deleted_at`           timestamp NULL DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB
    COMMENT ='消息模板-app推送-页面跳转链接';

-- ----------------------------
-- Table structure for message_tpl_group
-- ----------------------------
DROP TABLE IF EXISTS `message_tpl_group`;
CREATE TABLE `message_tpl_group`
(
    `id`           int(11)   NOT NULL AUTO_INCREMENT,
    `uniqid`       varchar(255)   DEFAULT '' COMMENT '唯一识别符(不可重复)',
    `name`         varchar(255)   DEFAULT '' COMMENT '名称',
    `description`  varchar(255)   DEFAULT '' COMMENT '描述',
    `created_id`   int(11)        DEFAULT '0' COMMENT '创建人id ',
    `created_name` varchar(255)   DEFAULT '' COMMENT '创建人名称',
    `updated_id`   int(11)        DEFAULT '0' COMMENT '更新人id  ',
    `updated_name` varchar(255)   DEFAULT '' COMMENT '更新人名称 ',
    `created_at`   timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at`   timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    `deleted_at`   timestamp NULL DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB
    COMMENT ='消息模板-分组';

-- ----------------------------
-- Table structure for message_tpl_server
-- ----------------------------
DROP TABLE IF EXISTS `message_tpl_server`;
CREATE TABLE `message_tpl_server`
(
    `id`           int(11)   NOT NULL AUTO_INCREMENT,
    `uniqid`       varchar(255)   DEFAULT '' COMMENT '唯一识别符(不可重复)',
    `type`         smallint(6)    DEFAULT '0' COMMENT '类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉应用消息  16飞书应用消息',
    `name`         varchar(255)   DEFAULT '' COMMENT '名称',
    `description`  varchar(255)   DEFAULT '' COMMENT '描述',
    `dd_webhook`   varchar(255)   DEFAULT '' COMMENT '钉钉推送地址',
    `dd_secret`    varchar(255)   DEFAULT '' COMMENT '钉钉密钥',
    `dd_cor_pid`   varchar(255)   DEFAULT '' COMMENT '钉钉cor_pid',
    `dd_agent_id`  varchar(255)   DEFAULT '' COMMENT '钉钉agent_id',
    `mail_dsn`     varchar(255)   DEFAULT '' COMMENT '邮件DSN，格式如smtp://user:pass@smtp.example.com:port',
    `mail_address` varchar(255)   DEFAULT '' COMMENT '邮件地址',
    `app_key`      varchar(255)   DEFAULT '' COMMENT '通用keyId',
    `app_secret`   varchar(255)   DEFAULT '' COMMENT '通用keySecret',
    `created_id`   int(11)        DEFAULT '0' COMMENT '创建人id ',
    `created_name` varchar(255)   DEFAULT '' COMMENT '创建人名称',
    `updated_id`   int(11)        DEFAULT '0' COMMENT '更新人id  ',
    `updated_name` varchar(255)   DEFAULT '' COMMENT '更新人名称 ',
    `created_at`   timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at`   timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    `deleted_at`   timestamp NULL DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB
    COMMENT ='消息模板-服务配置，如机器人、邮件发件人等…';

-- ----------------------------
-- Table structure for message_tpl_sms_template
-- ----------------------------
DROP TABLE IF EXISTS `message_tpl_sms_template`;
CREATE TABLE `message_tpl_sms_template`
(
    `id`           int(11)   NOT NULL AUTO_INCREMENT,
    `server_id`    int(11)        DEFAULT '0' COMMENT '服务id',
    `name`         varchar(255)   DEFAULT '' COMMENT '名称',
    `description`  varchar(255)   DEFAULT '' COMMENT '描述',
    `sign`         varchar(255)   DEFAULT '' COMMENT '签名',
    `code`         varchar(255)   DEFAULT '' COMMENT '模板code',
    `status`       tinyint(1)     DEFAULT '0' COMMENT '状态 0不启用 1启用',
    `created_id`   int(11)        DEFAULT '0' COMMENT '创建人id ',
    `created_name` varchar(255)   DEFAULT '' COMMENT '创建人名称',
    `updated_id`   int(11)        DEFAULT '0' COMMENT '更新人id  ',
    `updated_name` varchar(255)   DEFAULT '' COMMENT '更新人名称 ',
    `created_at`   timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at`   timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    `deleted_at`   timestamp NULL DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB
    COMMENT ='消息模板-短信模板';

-- ----------------------------
-- Table structure for message_tpl_var
-- ----------------------------
DROP TABLE IF EXISTS `message_tpl_var`;
CREATE TABLE `message_tpl_var`
(
    `id`           int(11)   NOT NULL AUTO_INCREMENT,
    `group_id`     int(11)        DEFAULT '0' COMMENT '分组id',
    `uniqid`       varchar(255)   DEFAULT '' COMMENT '唯一识别符(不可重复)',
    `type`         tinyint(4)     DEFAULT '0' COMMENT '变量类型，0字符串 1list 2map',
    `name`         varchar(255)   DEFAULT '' COMMENT '变量名，模板变量替换时使用',
    `label`        varchar(255)   DEFAULT '' COMMENT '变量label',
    `description`  varchar(255)   DEFAULT '' COMMENT '描述',
    `status`       tinyint(1)     DEFAULT '0' COMMENT '状态 0不启用 1启用',
    `sample`       text COMMENT '使用例子，尤其当type=list、map时，应该给出示例说明规范',
    `created_id`   int(11)        DEFAULT '0' COMMENT '创建人id ',
    `created_name` varchar(255)   DEFAULT '' COMMENT '创建人名称',
    `updated_id`   int(11)        DEFAULT '0' COMMENT '更新人id  ',
    `updated_name` varchar(255)   DEFAULT '' COMMENT '更新人名称 ',
    `created_at`   timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at`   timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    `deleted_at`   timestamp NULL DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB
    COMMENT ='消息模板-变量';

-- ----------------------------
-- Table structure for message_tpl_var_group
-- ----------------------------
DROP TABLE IF EXISTS `message_tpl_var_group`;
CREATE TABLE `message_tpl_var_group`
(
    `id`           int(11)   NOT NULL AUTO_INCREMENT,
    `name`         varchar(255)   DEFAULT '' COMMENT '名称',
    `description`  varchar(255)   DEFAULT '' COMMENT '描述',
    `created_id`   int(11)        DEFAULT '0' COMMENT '创建人id ',
    `created_name` varchar(255)   DEFAULT '' COMMENT '创建人名称',
    `updated_id`   int(11)        DEFAULT '0' COMMENT '更新人id  ',
    `updated_name` varchar(255)   DEFAULT '' COMMENT '更新人名称 ',
    `created_at`   timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `updated_at`   timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    `deleted_at`   timestamp NULL DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB
    COMMENT ='消息模板 - 变量分组';

-- ----------------------------
-- Table structure for app_agent
-- ----------------------------
DROP TABLE IF EXISTS `app_agent`;
CREATE TABLE "app_agent" (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `no` varchar(255) DEFAULT '' COMMENT '应用编号',
                             `name` varchar(255)  DEFAULT '' COMMENT '应用名称',
                             `path` varchar(255) DEFAULT '' COMMENT '应用路径=项目/模块/子模块',
                             `description` varchar(255)  DEFAULT '' COMMENT '描述',
                             `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
                             `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
                             `deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
                             PRIMARY KEY ("id") USING BTREE
) ENGINE=InnoDB
    COMMENT='应用表';

SET FOREIGN_KEY_CHECKS = 1;
