<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationRejectedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Registration $registration
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration Update — #' . $this->registration->id,
        );
    }

    public function content(): Content
    {
        $reg   = $this->registration;
        $event = $reg->event;

        // 👇 Plain-text body — no HTML, no Blade view file needed
        $body = "Dear {$reg->first_name} {$reg->last_name},\n\n"
              . "Thank you for your interest in " . ($event->title ?? 'our event') . ".\n\n"
              . "After reviewing your registration (ID: #{$reg->id}), we regret to inform you "
              . "that your registration could not be approved at this time.\n\n";

        if (!empty($reg->admin_note)) {
            $body .= "Reason: {$reg->admin_note}\n\n";
        }

        $body .= "Registration Details:\n"
               . "- Registration ID: #{$reg->id}\n"
               . "- Name: {$reg->first_name} {$reg->last_name}\n"
               . "- Category: {$reg->category}\n"
               . "- Transaction ID: {$reg->trx_id}\n\n"
               . "If you believe this was a mistake or need clarification, please contact "
               . "the event organizers with your Registration ID.\n\n"
               . "Thank you,\n"
               . config('app.name');

        return new Content(
            text: 'emails.registration-rejected-text',  // see below
            with: [
                'registration' => $reg,
                'event'        => $event,
                'body'         => $body,
            ],
        );
    }
}
