Registration Received - <?php echo e($event->title ?? 'the event'); ?>

==========================================================

Thank you, <?php echo e($registration->first_name); ?>!

Your registration for <?php echo e($event->title ?? 'the event'); ?> has been
received successfully. Our team will review your payment details
and confirm your spot shortly.

STATUS
------
<?php echo e(ucfirst($registration->status ?? 'pending')); ?>


YOUR REGISTRATION DETAILS
-------------------------
Registration ID  : #<?php echo e($registration->id); ?>

Full Name        : <?php echo e($registration->first_name); ?> <?php echo e($registration->last_name); ?>

Category         : <?php echo e($registration->category ?? 'Not provided'); ?>

T-Shirt Size     : <?php echo e($registration->tshirt_size ?? 'Not provided'); ?>

Amount           : <?php echo e($registration->amount ?? 'Not provided'); ?>

Payment Method   : <?php echo e($registration->payment_method ?? 'Not provided'); ?>

Transaction ID   : <?php echo e($registration->trx_id ?? 'Not provided'); ?>


WHAT'S NEXT?
------------
Our team will verify your payment. Once approved, you will receive
a confirmation via email, SMS, or WhatsApp along with your BIB number.

Keep this email for your records. If you have any questions, please
contact the event organizers.

Thank you for choosing <?php echo e(config('app.name')); ?>.

--
This is an automated message - please do not reply directly.
(c) <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. All rights reserved.
<?php /**PATH D:\laragon\www\run-event\resources\views/emails/registration-confirmation-text.blade.php ENDPATH**/ ?>