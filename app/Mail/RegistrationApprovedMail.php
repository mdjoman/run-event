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
use Illuminate\Support\Facades\Log;

class RegistrationApprovedMail extends Mailable implements ShouldQueue
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
            subject: 'Registration Approved - BIB #' . $this->registration->bib_number,
            replyTo: [
                new Address(
                    config('mail.from.address'),
                    config('mail.from.name')
                ),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.registration-approved-text',
            with: [
                'registration' => $this->registration,
                'event'        => $this->registration->event,
            ],
        );
    }

    /**
     * Queue job permanently failed — log it.
     */
    public function failed(\Throwable $e): void
    {
        Log::error('RegistrationApprovedMail permanently failed', [
            'registration_id' => $this->registration->id,
            'error'           => $e->getMessage(),
        ]);
    }
}
