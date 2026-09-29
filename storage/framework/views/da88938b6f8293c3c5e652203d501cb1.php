<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration Approved</title>
</head>
<body style="margin:0; padding:0; background-color:#eef2f7; font-family:'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color:#2d3748; line-height:1.6;">

    <!-- Preheader -->
    <div style="display:none; max-height:0; overflow:hidden; opacity:0;">
        Your registration is approved! BIB #<?php echo e($registration->bib_number); ?> for <?php echo e($event->title ?? 'the event'); ?>.
    </div>

    <!-- Outer wrapper -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#eef2f7; padding:30px 15px;">
        <tr>
            <td align="center">

                <!-- Main card -->
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; width:100%; background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">

                    <!-- Header with success gradient -->
                    <tr>
                        <td style="background:linear-gradient(135deg,#16a34a 0%,#059669 100%); padding:40px 30px; text-align:center; color:#ffffff;">
                            <div style="font-size:52px; line-height:1; margin-bottom:10px;">✅</div>
                            <h1 style="margin:0; font-size:26px; font-weight:700; letter-spacing:0.3px;">
                                Registration Approved!
                            </h1>
                            <p style="margin:8px 0 0; font-size:15px; opacity:0.95;">
                                Congratulations, <?php echo e($registration->first_name); ?>!
                            </p>
                        </td>
                    </tr>

                    <!-- BIB Number Highlight -->
                    <tr>
                        <td style="padding:35px 35px 0; text-align:center;">

                            <p style="margin:0 0 15px; font-size:14px; color:#718096; text-transform:uppercase; letter-spacing:1px; font-weight:600;">
                                Your BIB Number
                            </p>

                            <div style="display:inline-block; background:linear-gradient(135deg,#fef3c7 0%,#fde68a 100%); border:3px dashed #b45309; border-radius:14px; padding:20px 45px; margin:0 0 15px;">
                                <span style="font-size:42px; font-weight:900; color:#92400e; letter-spacing:3px; font-family:'Courier New', monospace;">
                                    <?php echo e($registration->bib_number); ?>

                                </span>
                            </div>

                            <p style="margin:0; font-size:13px; color:#718096;">
                                Save this number — you will need it on race day.
                            </p>

                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:35px 35px 10px;">

                            <p style="margin:0 0 20px; font-size:15px; color:#4a5568;">
                                Great news! Your registration for
                                <strong style="color:#059669;"><?php echo e($event->title ?? 'the event'); ?></strong>
                                has been <strong style="color:#16a34a;">approved</strong>. You are officially confirmed.
                            </p>

                            <!-- Status Badge -->
                            <div style="text-align:center; margin:25px 0;">
                                <span style="display:inline-block; background-color:#dcfce7; color:#166534; font-size:13px; font-weight:700; padding:8px 18px; border-radius:20px; letter-spacing:0.5px; text-transform:uppercase;">
                                    ✓ Approved
                                </span>
                            </div>

                            <!-- Registration Details -->
                            <h3 style="margin:30px 0 12px; font-size:16px; font-weight:700; color:#2d3748; border-left:4px solid #16a34a; padding-left:10px;">
                                Confirmation Details
                            </h3>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; border-spacing:0 6px; font-size:14px;">

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f0fdf4; color:#718096; font-weight:600; width:45%; border-radius:8px 0 0 8px;">
                                        BIB Number
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f0fdf4; color:#16a34a; font-weight:700; font-family:'Courier New', monospace; font-size:15px; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->bib_number); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
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

                            <?php if(!empty($registration->admin_note)): ?>
                            <!-- Admin Note -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:25px;">
                                <tr>
                                    <td style="background-color:#eff6ff; border-left:4px solid #2563eb; padding:15px 18px; border-radius:8px;">
                                        <p style="margin:0 0 5px; font-size:12.5px; color:#1e40af; text-transform:uppercase; font-weight:700; letter-spacing:0.5px;">
                                            Note from organizers
                                        </p>
                                        <p style="margin:0; font-size:14px; color:#1e40af;">
                                            <?php echo e($registration->admin_note); ?>

                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <?php endif; ?>

                            <!-- What's next -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:25px;">
                                <tr>
                                    <td style="background-color:#f0fdf4; border-left:4px solid #16a34a; padding:15px 18px; border-radius:8px;">
                                        <p style="margin:0; font-size:13.5px; color:#166534;">
                                            <strong>What's next?</strong> Keep this email safe. On race day, show your BIB number at the registration desk to collect your kit. Arrive at least 30 minutes early.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:25px 0 0; font-size:14px; color:#718096;">
                                If you have any questions, please contact the event organizers.
                            </p>

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
                                Thank you for joining <strong style="color:#059669;"><?php echo e(config('app.name')); ?></strong>
                            </p>
                            <p style="margin:0;">
                                This is an automated message &mdash; please do not reply directly.
                            </p>
                        </td>
                    </tr>

                </table>

                <!-- Bottom note -->
                <p style="margin:20px 0 0; font-size:12px; color:#a0aec0; text-align:center;">
                    &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. All rights reserved.
                </p>

            </td>
        </tr>
    </table>

</body>
</html><?php /**PATH D:\laragon\www\run-event\resources\views/emails/registration-approved.blade.php ENDPATH**/ ?>