<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration Confirmation</title>
</head>
<body style="margin:0; padding:0; background-color:#eef2f7; font-family:'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color:#2d3748; line-height:1.6;">

    <!-- Preheader (hidden preview text) -->
    <div style="display:none; max-height:0; overflow:hidden; opacity:0;">
        Your registration for <?php echo e($event->title ?? 'the event'); ?> has been received. Confirmation #<?php echo e($registration->id); ?>.
    </div>

    <!-- Outer wrapper -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#eef2f7; padding:30px 15px;">
        <tr>
            <td align="center">

                <!-- Main card -->
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; width:100%; background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">

                    <!-- Header with gradient -->
                    <tr>
                        <td style="background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); padding:40px 30px; text-align:center; color:#ffffff;">
                            <div style="font-size:48px; line-height:1; margin-bottom:10px;">🎉</div>
                            <h1 style="margin:0; font-size:26px; font-weight:700; letter-spacing:0.3px;">
                                Registration Received!
                            </h1>
                            <p style="margin:8px 0 0; font-size:15px; opacity:0.95;">
                                Thank you, <?php echo e($registration->first_name); ?> 👋
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:35px 35px 10px;">

                            <p style="margin:0 0 20px; font-size:15px; color:#4a5568;">
                                Your registration for
                                <strong style="color:#5a3d99;"><?php echo e($event->title ?? 'the event'); ?></strong>
                                has been received successfully. Our team will review your payment details and confirm your spot shortly.
                            </p>

                            <!-- Status badge -->
                            <div style="text-align:center; margin:25px 0;">
                                <span style="display:inline-block; background-color:#fef3c7; color:#b45309; font-size:13px; font-weight:600; padding:8px 18px; border-radius:20px; letter-spacing:0.5px; text-transform:uppercase;">
                                    ⏳ Status: <?php echo e(ucfirst($registration->status)); ?>

                                </span>
                            </div>

                            <!-- Section title -->
                            <h3 style="margin:30px 0 12px; font-size:16px; font-weight:700; color:#2d3748; border-left:4px solid #667eea; padding-left:10px;">
                                Your Registration Details
                            </h3>

                            <!-- Details table -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; border-spacing:0 6px; font-size:14px;">

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; width:45%; border-radius:8px 0 0 8px;">
                                        Registration ID
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; font-weight:700; border-radius:0 8px 8px 0;">
                                        #<?php echo e($registration->id); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Full Name
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->first_name); ?> <?php echo e($registration->last_name); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Category
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->category); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        T-Shirt Size
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->tshirt_size); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Amount
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#16a34a; font-weight:700; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->amount); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Payment Method
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->payment_method); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Transaction ID
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; font-family:'Courier New', monospace; font-size:13px; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->trx_id); ?>

                                    </td>
                                </tr>

                            </table>

                            <!-- Info box -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:25px;">
                                <tr>
                                    <td style="background-color:#eff6ff; border-left:4px solid #3b82f6; padding:15px 18px; border-radius:8px;">
                                        <p style="margin:0; font-size:13.5px; color:#1e40af;">
                                            💡 <strong>What's next?</strong> Our team will verify your payment. You'll receive another email once your registration is approved.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:25px 0 0; font-size:14px; color:#718096;">
                                Keep this email for your records. If you have any questions, please contact the event organizers.
                            </p>

                        </td>
                    </tr>

                    <!-- Call to action -->
                    <tr>
                        <td style="padding:10px 35px 35px; text-align:center;">
                            <a href="<?php echo e(config('app.url')); ?>"
                               style="display:inline-block; background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:#ffffff; text-decoration:none; font-size:14px; font-weight:600; padding:13px 32px; border-radius:8px; letter-spacing:0.3px;">
                                Visit Our Website →
                            </a>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding:0 35px;">
                            <hr style="border:none; border-top:1px solid #e2e8f0; margin:0;">
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:25px 35px 30px; text-align:center; color:#a0aec0; font-size:12.5px;">
                            <p style="margin:0 0 8px;">
                                Thank you for choosing <strong style="color:#5a3d99;"><?php echo e(config('app.name')); ?></strong> 💜
                            </p>
                            <p style="margin:0;">
                                This is an automated message — please do not reply directly.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- /Main card -->

                <!-- Bottom note -->
                <p style="margin:20px 0 0; font-size:12px; color:#a0aec0; text-align:center;">
                    © <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. All rights reserved.
                </p>

            </td>
        </tr>
    </table>

</body>
</html><?php /**PATH C:\laragon\www\run-event\resources\views/emails/registration-confirmation.blade.php ENDPATH**/ ?>