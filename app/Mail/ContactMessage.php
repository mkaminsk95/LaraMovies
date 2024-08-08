<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public array $details;

    public function __construct(array $details)
    {
        $this->details = $details;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from_contact_address.address'), config('mail.from_contact_address.name')),
            to: [
                new Address(config('mail.from_support_address.address'))
            ],
            replyTo: [
                new Address($this->details['userEmail']),
            ],
            subject: 'Contact Form Submission',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
