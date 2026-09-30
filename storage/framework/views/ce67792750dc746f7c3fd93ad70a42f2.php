New Registration Received
=========================

Dear Admin,

A new registration has been submitted and is currently awaiting your review.

REGISTRATION SUMMARY
--------------------
Registration ID  : #<?php echo e($registration->id); ?>

Applicant Name   : <?php echo e($registration->first_name); ?> <?php echo e($registration->last_name); ?>

Email Address    : <?php echo e($registration->email ?? 'Not provided'); ?>

Phone Number     : <?php echo e($registration->phone ?? 'Not provided'); ?>

WhatsApp Number  : <?php echo e($registration->whatsapp_number ?? 'Not provided'); ?>

Gender           : <?php echo e($registration->gender ?? 'Not provided'); ?>

Blood Group      : <?php echo e($registration->blood_group ?? 'Not provided'); ?>

Date of Birth    : <?php echo e($registration->dob ?? 'Not provided'); ?>

NID              : <?php echo e($registration->nid ?? 'Not provided'); ?>

Category         : <?php echo e($registration->category ?? 'Not provided'); ?>

T-Shirt Size     : <?php echo e($registration->tshirt_size ?? 'Not provided'); ?>


EVENT
-----
Event Title      : <?php echo e($event->title ?? 'the event'); ?>


STATUS
------
Current Status   : <?php echo e(ucfirst($registration->status ?? 'pending')); ?>


PAYMENT DETAILS
---------------
Amount           : <?php echo e($registration->amount ?? 'Not provided'); ?>

Payment Method   : <?php echo e($registration->payment_method ?? 'Not provided'); ?>

Sender Last 3    : <?php echo e($registration->sender_phone_last3 ?? 'Not provided'); ?>

Transaction ID   : <?php echo e($registration->trx_id ?? 'Not provided'); ?>


ACTION REQUIRED
---------------
Please log in to the admin panel at your earliest convenience to review
this registration and either approve or reject it. Timely action ensures
the applicant receives prompt confirmation regarding their submission.

Thank you for your attention to this matter.

Best regards,
<?php echo e(config('app.name')); ?> - Admin Notification System

--
This is an automated message. Please do not reply directly to this email.
(c) <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. All rights reserved.
<?php /**PATH D:\laragon\www\run-event\resources\views/emails/new-registration-admin-text.blade.php ENDPATH**/ ?>