<?php

declare(strict_types=1);
/**
 * This file is part of maliboot module.
 *
 * @link     https://github.com/maliboot
 */
namespace Module\Medium\Infra\DataObject;

use MaliBoot\Cola\Annotation\Database;
use MaliBoot\Database\Annotation\Column;

/**
 * MediumCloudServerDO
 */
#[Database(table: "medium_cloud_server", connection: "default", softDeletes: true)]
class MediumCloudServerDO
{
    #[Column(name: "id", type: "int", desc: "")]
    private int $id;

    #[Column(name: "type", type: "int", desc: "类型：0服务器本地; 1阿里云OSS; 2腾讯云COS; 3七牛云")]
    private int $type;

    #[Column(name: "server_no", type: "string", desc: "编号")]
    private string $serverNo;

    #[Column(name: "local_root", type: "string", desc: "type=0时必须，服务器资源文件夹路径；")]
    private string $localRoot;

    #[Column(name: "oss_access_id", type: "string", desc: "type=1时必须；oss应用id")]
    private string $ossAccessId;

    #[Column(name: "oss_access_secret", type: "string", desc: "type=1时必须；oss应用密钥")]
    private string $ossAccessSecret;

    #[Column(name: "oss_endpoint", type: "string", desc: "type=1时必须；阿里云oss资源域名")]
    private string $ossEndpoint;

    #[Column(name: "oss_bucket", type: "string", desc: "type=1时必须；阿里云oss分区")]
    private string $ossBucket;

    #[Column(name: "oss_sign_timeout", type: "int", desc: "type=1时必须；阿里云url签名url有效时间(秒)，为0时则为public资源")]
    private int $ossSignTimeout;

    #[Column(name: "created_at", type: "string", desc: "创建时间")]
    private string $createdAt;

    #[Column(name: "updated_at", type: "string", desc: "更新时间")]
    private string $updatedAt;


}
