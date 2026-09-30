Registration Approved - {{ $event->title ?? 'the event' }}
==========================================================

Congratulations, {{ $registration->first_name }}!

Great news! Your registration for {{ $event->title ?? 'the event' }}
has been APPROVED. You are officially confirmed.

YOUR BIB NUMBER
---------------
{{ $registration->bib_number }}

Save this number - you will need it on race day.

CONFIRMATION DETAILS
--------------------
BIB Number       : {{ $registration->bib_number }}
Registration ID  : #{{ $registration->id }}
Full Name        : {{ $registration->first_name }} {{ $registration->last_name }}
Category         : {{ $registration->category ?? 'Not provided' }}
T-Shirt Size     : {{ $registration->tshirt_size ?? 'Not provided' }}
Payment Method   : {{ $registration->payment_method ?? 'Not provided' }}
Transaction ID   : {{ $registration->trx_id ?? 'Not provided' }}

STATUS
------
Approved

@if(!empty($registration->admin_note))
NOTE FROM ORGANIZERS
--------------------
{{ $registration->admin_note }}

@endif
WHAT'S NEXT?
------------
Keep this email safe. On race day, show your BIB number at the
registration desk to collect your kit. Please arrive at least
30 minutes early to avoid any delays.

If you have any questions, please contact the event organizers.

Thank you for joining {{ config('app.name') }}.

--
This is an automated message - please do not reply directly.
(c) {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
