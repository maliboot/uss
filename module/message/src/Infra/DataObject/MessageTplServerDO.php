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
 * 消息模板-服务配置，如机器人、邮件发件人等….
 */
#[Database(softDeletes: true)]
class MessageTplServerDO
{
    #[Column(name: 'id', type: 'int', desc: '')]
    private int $id;

    #[Column(name: 'uniqid', type: 'string', desc: '唯一识别符（不可重复）')]
    private string $uniqid;

    #[Column(name: 'type', type: 'int', desc: '类型0邮件1阿里云短信2App推送4websocket8钉钉群')]
    private int $type;

    #[Column(name: 'name', type: 'string', desc: '名称')]
    private string $name;

    #[Column(name: 'description', type: 'string', desc: '描述')]
    private string $description;

    #[Column(name: 'dd_webhook', type: 'string', desc: '钉钉推送地址')]
    private string $ddWebhook;

    #[Column(name: 'dd_secret', type: 'string', desc: '钉钉密钥')]
    private string $ddSecret;

    #[Column(name: 'dd_corp_id', type: 'string', desc: '钉钉corp_id')]
    private string $ddCorpId;

    #[Column(name: 'dd_agent_id', type: 'string', desc: '钉钉agent_id')]
    private string $ddAgentId;

    #[Column(name: 'mail_dsn', type: 'string', desc: '邮件DSN，格式如smtp:user:pass@smtp.example.com:port')]
    private string $mailDsn;

    #[Column(name: 'mail_address', type: 'string', desc: '邮件地址')]
    private string $mailAddress;

    #[Column(name: 'app_key', type: 'string', desc: '通用keyId')]
    private string $appKey;

    #[Column(name: 'app_secret', type: 'string', desc: '通用keySecret')]
    private string $appSecret;

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
