<?php

declare(strict_types=1);
/**
 * This file is part of maliboot module.
 *
 * @link     https://github.com/maliboot
 */
namespace Module\Medium\Client\Dto;

use MaliBoot\Dto\Annotation\DataTransferObject;
use MaliBoot\Lombok\Annotation\Field;

/**
 * MediumCloudServerCreateDTO
 */
#[DataTransferObject(name: "MediumCloudServerCreate", type: "command")]
class MediumCloudServerCreateDTO
{
    #[Field(name: "type", type: "integer", desc: "类型：0服务器本地; 1阿里云OSS; 2腾讯云COS; 3七牛云")]
    private int $type;

    #[Field(name: "serverNo", type: "string", desc: "编号")]
    private string $serverNo;

    #[Field(name: "localRoot", type: "string", desc: "type=0时必须，服务器资源文件夹路径；")]
    private string $localRoot;

    #[Field(name: "ossAccessId", type: "string", desc: "type=1时必须；oss应用id")]
    private string $ossAccessId;

    #[Field(name: "ossAccessSecret", type: "string", desc: "type=1时必须；oss应用密钥")]
    private string $ossAccessSecret;

    #[Field(name: "ossEndpoint", type: "string", desc: "type=1时必须；阿里云oss资源域名")]
    private string $ossEndpoint;

    #[Field(name: "ossBucket", type: "string", desc: "type=1时必须；阿里云oss分区")]
    private string $ossBucket;

    #[Field(name: "ossSignTimeout", type: "integer", desc: "type=1时必须；阿里云url签名url有效时间(秒)，为0时则为public资源")]
    private int $ossSignTimeout;


}