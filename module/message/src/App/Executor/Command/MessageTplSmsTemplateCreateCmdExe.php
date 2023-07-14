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
use MaliBoot\Dto\IdVO;
use Uss\Message\Client\Dto\Command\MessageTplSmsTemplateCreateCmd;
use Uss\Message\Domain\Model\MessageTplSmsTemplate\MessageTplSmsTemplate;
use Uss\Message\Domain\Repository\MessageTplSmsTemplateRepo;

/**
 * 消息模板-短信模板.
 */
#[AppService]
class MessageTplSmsTemplateCreateCmdExe extends AbstractExecutor
{
    #[Inject]
    protected MessageTplSmsTemplateRepo $messageTplSmsTemplateRepo;

    public function execute(MessageTplSmsTemplateCreateCmd $messageTplSmsTemplateCreateCmd): IdVo
    {
        $params = MessageTplSmsTemplate::of($messageTplSmsTemplateCreateCmd->toArray());
        $result = $this->messageTplSmsTemplateRepo->create($params);
        return (new IdVO())->setId($result);
    }
}
