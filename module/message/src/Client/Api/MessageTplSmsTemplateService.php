<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\Client\Api;

use MaliBoot\Dto\EmptyVO;
use MaliBoot\Dto\IdVO;
use MaliBoot\Dto\PageVO;
use Uss\Message\Client\Dto\Command\MessageTplSmsTemplateCreateCmd;
use Uss\Message\Client\Dto\Command\MessageTplSmsTemplateUpdateCmd;
use Uss\Message\Client\Dto\Query\MessageTplSmsTemplateListByPageQry;
use Uss\Message\Client\ViewObject\MessageTplSmsTemplateVO;

/**
 * MessageTplSmsTemplateService.
 */
interface MessageTplSmsTemplateService
{
    public function listByPage(MessageTplSmsTemplateListByPageQry $messageTplSmsTemplateListByPageQry): PageVO;

    public function create(MessageTplSmsTemplateCreateCmd $messageTplSmsTemplateCreateCmd): IdVO;

    public function update(MessageTplSmsTemplateUpdateCmd $messageTplSmsTemplateUpdateCmd): EmptyVO;

    public function delete(int $id): EmptyVO;

    public function getById(int $id): MessageTplSmsTemplateVO;
}
