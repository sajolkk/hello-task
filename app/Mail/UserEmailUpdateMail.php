<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserEmailUpdateMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $user;
    protected $sent_type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$sent_type)
    {
        $this->user = $user;
        $this->sent_type = $sent_type;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Hello Task | Mail Changed',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.user_email_udpate',
            with: ['user' => $this->user, 'sent_type' => $this->sent_type],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
