<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistration extends Mailable
{
    use Queueable, SerializesModels;
    private string $_email, $_name, $_password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( string $email, string $name, string $password )
    {
        $this->_email = $email;
        $this->_name = $name;
        $this->_password = $password;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address( 'gladmoredzinduwa@gmail.com', 'Sally Mugabe Central Hospital Patient Records' ),
            subject: 'User Registration',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.user-registration',
            with: [
                '_email'    => $this->_email,
                '_name'     => $this->_name,
                '_password' => $this->_password
            ]
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
