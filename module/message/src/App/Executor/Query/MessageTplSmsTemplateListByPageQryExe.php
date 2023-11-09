<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\App\Executor\Query;

use MaliBoot\Cola\Annotation\AppService;
use MaliBoot\Cola\App\AbstractExecutor;
use MaliBoot\Di\Annotation\Inject;
use MaliBoot\Dto\PageVO;
use Uss\Message\Client\Dto\Query\MessageTplSmsTemplateListByPageQry;
use Uss\Message\Infra\Repository\MessageTplSmsTemplateQryRepo;

/**
 * MessageTplSmsTemplateListByPageQryExe.
 */
#[AppService]
class MessageTplSmsTemplateListByPageQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplSmsTemplateQryRepo $messageTplSmsTemplateQryRepo;

    public function execute(MessageTplSmsTemplateListByPageQry $messageTplSmsTemplateListByPageQry): PageVO
    {
        return $this->messageTplSmsTemplateQryRepo->listByPage($messageTplSmsTemplateListByPageQry);
    }
}
