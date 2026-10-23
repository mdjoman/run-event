Registration Received - {{ $event->title ?? 'the event' }}
==========================================================

Thank you, {{ $registration->first_name }}!

Your registration for {{ $event->title ?? 'the event' }} has been
received successfully. Our team will review your payment details
and confirm your spot shortly.

STATUS
------
{{ ucfirst($registration->status ?? 'pending') }}

YOUR REGISTRATION DETAILS
-------------------------
Registration ID  : #{{ $registration->id }}
Full Name        : {{ $registration->first_name }} {{ $registration->last_name }}
Category         : {{ $registration->category ?? 'Not provided' }}
T-Shirt Size     : {{ $registration->tshirt_size ?? 'Not provided' }}
Amount           : {{ $registration->amount ?? 'Not provided' }}
Payment Method   : {{ $registration->payment_method ?? 'Not provided' }}
Transaction ID   : {{ $registration->trx_id ?? 'Not provided' }}

WHAT'S NEXT?
------------
Our team will verify your payment. Once approved, you will receive
a confirmation via email, SMS, or WhatsApp along with your BIB number.

Keep this email for your records. If you have any questions, please
contact the event organizers.

Thank you for choosing {{ config('app.name') }}.

--
This is an automated message - please do not reply directly.
(c) {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
