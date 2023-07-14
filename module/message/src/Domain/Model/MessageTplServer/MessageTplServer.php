<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Domain\Model\MessageTplServer;

use MaliBoot\Cola\Annotation\AggregateRoot;
use MaliBoot\Cola\Annotation\Field;
use MaliBoot\Cola\Domain\AbstractEntity;
use MaliBoot\Cola\Domain\AggregateRootInterface;

/**
 * 消息模板-服务配置，如机器人、邮件发件人等….
 *
 * @method string getAliSecret() 获取阿里云keySecret.
 * @method self setAliSecret(string $aliSecret) 设置阿里云keySecret.
 * @method string getAliKey() 获取阿里云keyId.
 * @method self setAliKey(string $aliKey) 设置阿里云keyId.
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
#[AggregateRoot(name: 'MessageTplServer', desc: '消息模板-服务配置，如机器人、邮件发件人等…')]
class MessageTplServer extends AbstractEntity implements AggregateRootInterface
{
    #[Field(name: '')]
    private int $id;

    #[Field(name: '唯一识别符（不可重复）')]
    private string $uniqid;

    #[Field(name: '类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群')]
    private int $type;

    #[Field(name: '名称')]
    private string $name;

    #[Field(name: '描述')]
    private string $description;

    #[Field(name: '钉钉推送地址')]
    private string $ddWebhook;

    #[Field(name: '钉钉密钥')]
    private string $ddSecret;

    #[Field(name: '邮件DSN，格式如smtp://user:pass@smtp.example.com:port')]
    private string $mailDsn;

    #[Field(name: '邮件地址')]
    private string $mailAddress;

    #[Field(name: '阿里云keyId')]
    private string $aliKey;

    #[Field(name: '阿里云keySecret')]
    private string $aliSecret;

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
}
