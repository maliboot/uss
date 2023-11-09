<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\MessageSender\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_CLASS)]
class MessageSender extends AbstractAnnotation
{
    /**
     * @param int $messageType 消息发送者类型，参考 <a href='psi_element://\Uss\Message\Domain\Model\Message\Message::$type'>Message::$type</a>
     */
    public function __construct(
        public int $messageType = 0,
        public int $priority = 0,
    ) {
        parent::__construct($this->messageType, $this->priority);
    }
}
