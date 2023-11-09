<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */

namespace Uss\Message\Infra\MessageSender;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Uss\Message\Infra\MessageSender\Annotation\MessageSender;

#[MessageSender(messageType: 0)]
class MailSender extends AbstractMessageSender
{
    protected int $maxAttempts = 0;

    public function execute(): bool
    {
        $dsn = $this->msgParams['server']['mailDsn'] ?? '';
        $from = $this->msgParams['from'] ?? '';
        $fromName = $this->msgParams['fromName'] ?? '';
        $toList = $this->getArrayFromJson('to');
        $title = $this->msgParams['title'] ?? '';
        $content = $this->msgParams['content'] ?? '';
        $mailFiles = $this->getArrayFromJson('mailFiles');

        $transport = Transport::fromDsn($dsn);
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from(new Address($from, $fromName))
            ->to(...$toList)
            ->subject($title)
            ->html($content);
        if (! empty($mailFiles)) {
            foreach ($mailFiles as $mailFile) {
                $email->attachFromPath($mailFile);
            }
        }
        $mailer->send($email);
        return true;
    }
}
