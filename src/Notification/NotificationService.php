<?php

namespace App\Notification;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class NotificationService
{
    private $mailer;

    public function __construct(MailerInterface $mailer) {
        $this->mailer = $mailer;
    }

    public function sendMailAnimalCreation($senderMail, $receiverMail, $user) {
        $email = (new Email())
            ->from($senderMail)
            ->to($receiverMail)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Un nouvel animal a été créé!')
            ->html('<h1>Nouvel animal!</h1><p>Un animal a été créé par '. $user->getEmail() .'</p>');

        $this->mailer->send($email);
    }
}