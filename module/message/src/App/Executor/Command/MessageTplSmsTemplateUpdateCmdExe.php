<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
namespace Uss\Message\App\Executor\Command;

use MaliBoot\Cola\Annotation\AppService;
use MaliBoot\Cola\App\AbstractExecutor;
use MaliBoot\Di\Annotation\Inject;
use MaliBoot\Dto\EmptyVO;
use Uss\Message\Client\Dto\Command\MessageTplSmsTemplateUpdateCmd;
use Uss\Message\Domain\Model\MessageTplSmsTemplate\MessageTplSmsTemplate;
use Uss\Message\Domain\Repository\MessageTplSmsTemplateRepo;

/**
 * MessageTplSmsTemplateUpdateCmdExe.
 */
#[AppService]
class MessageTplSmsTemplateUpdateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplSmsTemplateRepo $messageTplSmsTemplateRepo;

    public function execute(MessageTplSmsTemplateUpdateCmd $messageTplSmsTemplateUpdateCmd): EmptyVO
    {
        $params = MessageTplSmsTemplate::of($messageTplSmsTemplateUpdateCmd->toArray());
        $this->messageTplSmsTemplateRepo->update($params);
        return make(EmptyVO::class);
    }
}
