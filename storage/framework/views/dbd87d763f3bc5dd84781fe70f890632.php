<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Registration</title>
</head>
<body style="margin:0; padding:0; background-color:#eef2f7; font-family:'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color:#2d3748; line-height:1.6;">

    <!-- Preheader -->
    <div style="display:none; max-height:0; overflow:hidden; opacity:0;">
        New registration #<?php echo e($registration->id); ?> from <?php echo e($registration->first_name); ?> <?php echo e($registration->last_name); ?> — awaiting review.
    </div>

    <!-- Outer wrapper -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#eef2f7; padding:30px 15px;">
        <tr>
            <td align="center">

                <!-- Main card -->
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; width:100%; background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">

                    <!-- Header with gradient (blue theme) -->
                    <tr>
                        <td style="background:linear-gradient(135deg,#2563eb 0%,#1e40af 100%); padding:40px 30px; text-align:center; color:#ffffff;">
                            <div style="font-size:48px; line-height:1; margin-bottom:10px;">🔔</div>
                            <h1 style="margin:0; font-size:26px; font-weight:700; letter-spacing:0.3px;">
                                New Registration Received
                            </h1>
                            <p style="margin:8px 0 0; font-size:15px; opacity:0.95;">
                                Action required — please review
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:35px 35px 10px;">

                            <p style="margin:0 0 20px; font-size:15px; color:#4a5568;">
                                A new registration has been submitted for
                                <strong style="color:#1e40af;"><?php echo e($event->title ?? 'the event'); ?></strong>.
                                Please review the details below and approve or reject it in the admin panel.
                            </p>

                            <!-- Status badge -->
                            <div style="text-align:center; margin:25px 0;">
                                <span style="display:inline-block; background-color:#fef3c7; color:#b45309; font-size:13px; font-weight:600; padding:8px 18px; border-radius:20px; letter-spacing:0.5px; text-transform:uppercase;">
                                    ⏳ Status: <?php echo e(ucfirst($registration->status)); ?>

                                </span>
                            </div>

                            <!-- Section: Applicant Info -->
                            <h3 style="margin:30px 0 12px; font-size:16px; font-weight:700; color:#2d3748; border-left:4px solid #2563eb; padding-left:10px;">
                                👤 Applicant Information
                            </h3>

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
                                        Email
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#2563eb; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->email ?? '—'); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Phone
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->phone); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        WhatsApp
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->whatsapp_number); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Blood Group
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#dc2626; font-weight:700; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->blood_group); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Gender
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->gender); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Date of Birth
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->dob); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        NID
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f7fafc; color:#1a202c; font-family:'Courier New', monospace; font-size:13px; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->nid); ?>

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

                            </table>

                            <!-- Section: Payment Info -->
                            <h3 style="margin:30px 0 12px; font-size:16px; font-weight:700; color:#2d3748; border-left:4px solid #16a34a; padding-left:10px;">
                                💳 Payment Details
                            </h3>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate; border-spacing:0 6px; font-size:14px;">

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f0fdf4; color:#718096; font-weight:600; width:45%; border-radius:8px 0 0 8px;">
                                        Amount
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f0fdf4; color:#16a34a; font-weight:700; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->amount); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f0fdf4; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Payment Method
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f0fdf4; color:#1a202c; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->payment_method); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f0fdf4; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Sender Last 3 Digits
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f0fdf4; color:#1a202c; font-family:'Courier New', monospace; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->sender_phone_last3); ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 15px; background-color:#f0fdf4; color:#718096; font-weight:600; border-radius:8px 0 0 8px;">
                                        Transaction ID
                                    </td>
                                    <td style="padding:12px 15px; background-color:#f0fdf4; color:#1a202c; font-family:'Courier New', monospace; font-size:13px; border-radius:0 8px 8px 0;">
                                        <?php echo e($registration->trx_id); ?>

                                    </td>
                                </tr>

                            </table>

                            <!-- Info box -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:25px;">
                                <tr>
                                    <td style="background-color:#eff6ff; border-left:4px solid #2563eb; padding:15px 18px; border-radius:8px;">
                                        <p style="margin:0; font-size:13.5px; color:#1e40af;">
                                            ⚡ <strong>Action required:</strong> Please log in to the admin panel to approve or reject this registration.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- CTA Button -->
                    <tr>
                        <td style="padding:10px 35px 35px; text-align:center;">
                            <a href="<?php echo e(route('admin.registrations.show', $registration)); ?>"
                               style="display:inline-block; background:linear-gradient(135deg,#2563eb 0%,#1e40af 100%); color:#ffffff; text-decoration:none; font-size:15px; font-weight:600; padding:14px 38px; border-radius:8px; letter-spacing:0.3px; box-shadow:0 4px 12px rgba(37,99,235,0.3);">
                                👁️ View Full Details
                            </a>
                            <p style="margin:12px 0 0; font-size:12.5px; color:#a0aec0;">
                                or copy this link:
                            </p>
                            <p style="margin:4px 0 0; font-size:12px; color:#2563eb; word-break:break-all;">
                                <?php echo e(route('admin.registrations.show', $registration)); ?>

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
                                <strong style="color:#1e40af;"><?php echo e(config('app.name')); ?></strong> — Admin Notification
                            </p>
                            <p style="margin:0;">
                                This is an automated message. Do not reply directly.
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
</html><?php /**PATH C:\laragon\www\run-event\resources\views/emails/new-registration-admin.blade.php ENDPATH**/ ?>