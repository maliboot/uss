<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Infra\DataObject;

use Hyperf\Database\Model\SoftDeletes;
use MaliBoot\Cola\Annotation\Column;
use MaliBoot\Cola\Annotation\DataObject;
use MaliBoot\Cola\Infra\AbstractDatabaseDO;

/**
 * 消息模板-服务配置，如机器人、邮件发件人等….
 *
 * @method string getAppSecret() 获取通用keySecret.
 * @method self setAppSecret(string $appSecret) 设置通用keySecret.
 * @method string getAliKey() 获取通用keyId.
 * @method self setAliKey(string $appKey) 设置通用keyId.
 * @method int getId() ...
 * @method self setId(int $id) ...
 * @method string getUniqid() 获取唯一识别符（不可重复）.
 * @method self setUniqid(string $uniqid) 设置唯一识别符（不可重复）.
 * @method int getType() 获取类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群.
 * @method self setType(int $type) 设置类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群.
 * @method string getName() 获取名称.
 * @method self setName(string $name) 设置名称.
 * @method string getDescription() 获取描述.
 * @method self setDescription(string $description) 设置描述.
 * @method string getDdWebhook() 获取钉钉推送地址.
 * @method self setDdWebhook(string $ddWebhook) 设置钉钉推送地址.
 * @method string getDdSecret() 获取钉钉密钥.
 * @method self setDdSecret(string $ddSecret) 设置钉钉密钥.
 * @method string getMailDsn() 获取邮件DSN，格式如smtp://user:pass@smtp.example.com:port.
 * @method self setMailDsn(string $mailDsn) 设置邮件DSN，格式如smtp://user:pass@smtp.example.com:port.
 * @method string getMailAddress() 获取邮件地址.
 * @method self setMailAddress(string $mailAddress) 设置邮件地址.
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
#[DataObject(name: 'MessageTplServer', table: 'message_tpl_server', connection: 'default')]
class MessageTplServerDO extends AbstractDatabaseDO
{
    use SoftDeletes;

    #[Column(name: 'id', desc: '', type: 'int')]
    private int $id;

    #[Column(name: 'uniqid', desc: '唯一识别符（不可重复）', type: 'string')]
    private string $uniqid;

    #[Column(name: 'type', desc: '类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群', type: 'int')]
    private int $type;

    #[Column(name: 'name', desc: '名称', type: 'string')]
    private string $name;

    #[Column(name: 'description', desc: '描述', type: 'string')]
    private string $description;

    #[Column(name: 'dd_webhook', desc: '钉钉推送地址', type: 'string')]
    private string $ddWebhook;

    #[Column(name: 'dd_secret', desc: '钉钉密钥', type: 'string')]
    private string $ddSecret;

    #[Column(name: 'mail_dsn', desc: '邮件DSN，格式如smtp://user:pass@smtp.example.com:port', type: 'string')]
    private string $mailDsn;

    #[Column(name: 'mail_address', desc: '邮件地址', type: 'string')]
    private string $mailAddress;

    #[Column(name: 'app_key', desc: '通用keyId', type: 'string')]
    private string $appKey;

    #[Column(name: 'app_secret', desc: '通用keySecret', type: 'string')]
    private string $appSecret;

    #[Column(name: 'created_id', desc: '创建人id ', type: 'int')]
    private int $createdId;

    #[Column(name: 'created_name', desc: '创建人名称', type: 'string')]
    private string $createdName;

    #[Column(name: 'updated_id', desc: '更新人id  ', type: 'int')]
    private int $updatedId;

    #[Column(name: 'updated_name', desc: '更新人名称 ', type: 'string')]
    private string $updatedName;

    #[Column(name: 'created_at', desc: '创建时间', type: 'string')]
    private string $createdAt;

    #[Column(name: 'updated_at', desc: '更新时间', type: 'string')]
    private string $updatedAt;

    #[Column(name: 'deleted_at', desc: '删除时间', type: 'string')]
    private string $deletedAt;
}
