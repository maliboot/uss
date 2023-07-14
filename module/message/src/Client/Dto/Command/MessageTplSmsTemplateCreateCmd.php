<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Client\Dto\Command;

use MaliBoot\Dto\AbstractCommand;
use MaliBoot\Dto\Annotation\DataTransferObject;
use MaliBoot\Dto\Annotation\Field;

/**
 * MessageTplSmsTemplateCreateCmd.
 *
 * @method int getId() ...
 * @method self setId(int $id) ...
 * @method int getServerId() 获取服务id.
 * @method self setServerId(int $serverId) 设置服务id.
 * @method string getName() 获取名称.
 * @method self setName(string $name) 设置名称.
 * @method string getDescription() 获取描述.
 * @method self setDescription(string $description) 设置描述.
 * @method string getSign() 获取签名.
 * @method self setSign(string $sign) 设置签名.
 * @method string getCode() 获取模板code.
 * @method self setCode(string $code) 设置模板code.
 * @method int getStatus() 获取状态 0不启用 1启用.
 * @method self setStatus(int $status) 设置状态 0不启用 1启用.
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
#[DataTransferObject(name: 'MessageTplSmsTemplate', type: 'command')]
class MessageTplSmsTemplateCreateCmd extends AbstractCommand
{
    #[Field(name: '', type: 'int')]
    private int $id;

    #[Field(name: '服务id', type: 'int')]
    private int $serverId;

    #[Field(name: '名称', type: 'string')]
    private string $name;

    #[Field(name: '描述', type: 'string')]
    private string $description;

    #[Field(name: '签名', type: 'string')]
    private string $sign;

    #[Field(name: '模板code', type: 'string')]
    private string $code;

    #[Field(name: '状态 0不启用 1启用', type: 'int')]
    private int $status;

    #[Field(name: '创建人id ', type: 'int')]
    private int $createdId;

    #[Field(name: '创建人名称', type: 'string')]
    private string $createdName;

    #[Field(name: '更新人id  ', type: 'int')]
    private int $updatedId;

    #[Field(name: '更新人名称 ', type: 'string')]
    private string $updatedName;

    #[Field(name: '创建时间', type: 'string')]
    private string $createdAt;

    #[Field(name: '更新时间', type: 'string')]
    private string $updatedAt;

    #[Field(name: '删除时间', type: 'string')]
    private string $deletedAt;
}
