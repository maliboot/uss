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
 * MessageTplCreateCmd.
 *
 * @method int getId() ...
 * @method self setId(int $id) ...
 * @method int getGroupId() 获取分组id.
 * @method self setGroupId(int $groupId) 设置分组id.
 * @method int getType() 获取模板类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群.
 * @method self setType(int $type) 设置模板类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群.
 * @method string getTitle() 获取模板标题.
 * @method self setTitle(string $title) 设置模板标题.
 * @method string getContent() 获取模板内容.
 * @method self setContent(string $content) 设置模板内容.
 * @method int getContentType() 获取内容类型 0text 1html 2markdown.
 * @method self setContentType(int $contentType) 设置内容类型 0text 1html 2markdown.
 * @method int getAppLinkId() 获取App推送-跳转页面链接id，type = 2时必填.
 * @method self setAppLinkId(int $appLinkId) 设置App推送-跳转页面链接id，type = 2时必填.
 * @method int getServerId() 获取服务配置id，如机器人服务配置、邮件服务配置等….
 * @method self setServerId(int $serverId) 设置服务配置id，如机器人服务配置、邮件服务配置等….
 * @method string getPhones() 获取推送手机，type = 1、2、8时必填.
 * @method self setPhones(string $phones) 设置推送手机，type = 1、2、8时必填.
 * @method string getEmails() 获取推送邮箱，type = 0时必填.
 * @method self setEmails(string $emails) 设置推送邮箱，type = 0时必填.
 * @method int getStatus() 获取模板状态 0不启用 1启用.
 * @method self setStatus(int $status) 设置模板状态 0不启用 1启用.
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
#[DataTransferObject(name: 'MessageTpl', type: 'command')]
class MessageTplCreateCmd extends AbstractCommand
{
    #[Field(name: '', type: 'int')]
    private int $id;

    #[Field(name: '分组id', type: 'int')]
    private int $groupId;

    #[Field(name: '模板类型 0邮件 1阿里云短信  2App推送  4websocket 8钉钉群', type: 'int')]
    private int $type;

    #[Field(name: '模板标题', type: 'string')]
    private string $title;

    #[Field(name: '模板内容', type: 'string')]
    private string $content;

    #[Field(name: '内容类型 0text 1html 2markdown', type: 'int')]
    private int $contentType;

    #[Field(name: 'App推送-跳转页面链接id，type=2时必填', type: 'int')]
    private int $appLinkId;

    #[Field(name: '服务配置id，如机器人服务配置、邮件服务配置等…', type: 'int')]
    private int $serverId;

    #[Field(name: '推送手机，type=1、2、8时必填', type: 'string')]
    private string $phones;

    #[Field(name: '推送邮箱，type=0时必填', type: 'string')]
    private string $emails;

    #[Field(name: '模板状态 0不启用 1启用', type: 'int')]
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
