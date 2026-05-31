<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChatNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectStr;
    public $htmlBody;

    /**
     * Create a new message instance.
     */
    public function __construct(string $subjectStr, string $htmlBody)
    {
        $this->subjectStr = $subjectStr;
        $this->htmlBody = $htmlBody;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectStr,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'emails.chat_notification',
            with: [
                'body' => $this->htmlBody,
            ]
        );
    }
}
