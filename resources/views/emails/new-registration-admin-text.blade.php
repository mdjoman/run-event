New Registration Received
=========================

Dear Admin,

A new registration has been submitted and is currently awaiting your review.

REGISTRATION SUMMARY
--------------------
Registration ID  : #{{ $registration->id }}
Applicant Name   : {{ $registration->first_name }} {{ $registration->last_name }}
Email Address    : {{ $registration->email ?? 'Not provided' }}
Phone Number     : {{ $registration->phone ?? 'Not provided' }}
WhatsApp Number  : {{ $registration->whatsapp_number ?? 'Not provided' }}
Gender           : {{ $registration->gender ?? 'Not provided' }}
Blood Group      : {{ $registration->blood_group ?? 'Not provided' }}
NID              : {{ $registration->nid ?? 'Not provided' }}
Category         : {{ $registration->category ?? 'Not provided' }}
T-Shirt Size     : {{ $registration->tshirt_size ?? 'Not provided' }}

EVENT
-----
Event Title      : {{ $event->title ?? 'the event' }}

STATUS
------
Current Status   : {{ ucfirst($registration->status ?? 'pending') }}

PAYMENT DETAILS
---------------
Amount           : {{ $registration->amount ?? 'Not provided' }}
Payment Method   : {{ $registration->payment_method ?? 'Not provided' }}
Sender Last 3    : {{ $registration->sender_phone_last3 ?? 'Not provided' }}
Transaction ID   : {{ $registration->trx_id ?? 'Not provided' }}

ACTION REQUIRED
---------------
Please log in to the admin panel at your earliest convenience to review
this registration and either approve or reject it. Timely action ensures
the applicant receives prompt confirmation regarding their submission.

Thank you for your attention to this matter.

Best regards,
{{ config('app.name') }} - Admin Notification System

--
This is an automated message. Please do not reply directly to this email.
(c) {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
