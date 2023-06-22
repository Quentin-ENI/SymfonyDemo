<?php

namespace App\Notification;

use App\Helper\HelperService;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class NotificationService
{
    private $mailer;
    private $helperService;

    public function __construct(
        MailerInterface $mailer,
        HelperService $helperService
    ) {
        $this->mailer = $mailer;
        $this->helperService = $helperService;
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

        $this->helperService->helpUser("A mail will be sent.");
        $this->mailer->send($email);
    }
}