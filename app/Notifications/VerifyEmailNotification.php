<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly string $code
    ) {}

    /**
     * Deliver via email.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Build the email.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('P-FUNDS — Verify Your Email Address')
            ->greeting("Hello {$notifiable->name}!")
            ->line('Welcome to P-FUNDS! Please use the verification code below to verify your email address.')
            ->line("Your verification code is: **{$this->code}**")
            ->line('This code will expire in 15 minutes.')
            ->line('If you did not create an account, no further action is required.')
            ->salutation('— The P-FUNDS Team');
    }
}
