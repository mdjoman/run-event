<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewRegistrationAdminMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 30;
    public int $timeout = 60;

    public function __construct(
        public Registration $registration
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Registration Received #' . $this->registration->id,
            replyTo: [
                new Address(
                    $this->registration->email ?? config('mail.from.address'),
                    trim($this->registration->first_name . ' ' . $this->registration->last_name)
                ),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-registration-admin',
            with: [
                'registration' => $this->registration,
                'event'        => $this->registration->event,
            ],
        );
    }
}