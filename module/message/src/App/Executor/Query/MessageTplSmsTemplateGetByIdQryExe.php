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
use Uss\Message\Client\ViewObject\MessageTplSmsTemplateVO;
use Uss\Message\Infra\Repository\MessageTplSmsTemplateQryRepo;

/**
 * MessageTplSmsTemplateGetByIdQryExe.
 */
#[AppService]
class MessageTplSmsTemplateGetByIdQryExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplSmsTemplateQryRepo $messageTplSmsTemplateQryRepo;

    public function execute(int $id): MessageTplSmsTemplateVO
    {
        $result = $this->messageTplSmsTemplateQryRepo->getById($id);
        return MessageTplSmsTemplateVO::ofDO($result);
    }
}
