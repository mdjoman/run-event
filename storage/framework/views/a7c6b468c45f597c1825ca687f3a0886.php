<?php $__env->startSection('title', 'Event Registration - Run Burjowan'); ?>

<?php $__env->startSection('body'); ?>

<?php
    /* ============================================================
       PREPARE CATEGORIES
       ============================================================ */
    $eventCategories = $active_event->categories ?? [];

    if (empty($eventCategories)) {
        $eventCategories = [[
            'distance' => $active_event->category ?? 'General',
            'name'     => $active_event->category ?? 'General',
            'fee'      => (float) ($active_event->fee ?? 0),
        ]];
    }
?>

<div class="reg-page-wrapper">
    <div class="reg-page-container">

        
        <div class="reg-banner-header">
            <div class="reg-brand-area">
                <img src="<?php echo e(asset('img/logo.png')); ?>"
                     alt="Logo"
                     class="reg-header-logo">
                <div class="reg-header-text">
                    <h1 class="reg-header-title">EVENT REGISTRATION</h1>
                    <p class="reg-header-subtitle">
                        Complete the form below to confirm your official participation
                    </p>
                </div>
            </div>
        </div>

        
        <?php if(isset($active_event) && $active_event): ?>
        <div class="reg-info-strip">

            
            <div class="reg-info-status-row">

                <div class="reg-status-badges">
                    <span class="reg-status-badge">
                        <i class="fa-solid fa-circle-check"></i>
                        <?php if($active_event->status === 'active'): ?>
                            Registration Open
                        <?php else: ?>
                            Registration Closed
                        <?php endif; ?>
                    </span>

                    <?php if(isset($active_event->slots) && isset($active_event->registered)): ?>
                        <span class="reg-slots-text">
                            <i class="fa-solid fa-users"></i>
                            <?php echo e($active_event->registered); ?> / <?php echo e($active_event->slots); ?> slots filled
                        </span>
                    <?php endif; ?>
                </div>

                <?php
                    $eventDate = \Carbon\Carbon::parse($active_event->event_date)->startOfDay();
                    $today     = now()->startOfDay();
                    $days      = (int) $today->diffInDays($eventDate, false);
                ?>

                <?php if($days > 0): ?>
                    <span class="reg-days-badge">
                        <i class="fa-solid fa-hourglass-half"></i>
                        <?php echo e($days); ?> <?php echo e($days == 1 ? 'day' : 'days'); ?> left
                    </span>
                <?php elseif($days === 0): ?>
                    <span class="reg-days-badge reg-days-today">
                        <i class="fa-solid fa-fire"></i>
                        Race Day!
                    </span>
                <?php endif; ?>
            </div>

            
            <div class="reg-info-grid">

                <div class="reg-info-item">
                    <i class="fa-solid fa-flag-checkered reg-info-icon"></i>
                    <div class="reg-info-content">
                        <p class="reg-info-label">Event</p>
                        <p class="reg-info-value"><?php echo e($active_event->title); ?></p>
                    </div>
                </div>

                <div class="reg-info-item">
                    <i class="fa-regular fa-calendar-days reg-info-icon"></i>
                    <div class="reg-info-content">
                        <p class="reg-info-label">Date</p>
                        <p class="reg-info-value">
                            <?php echo e(\Carbon\Carbon::parse($active_event->event_date)->format('d M Y')); ?>

                        </p>
                    </div>
                </div>

                <?php if($active_event->start_time): ?>
                <div class="reg-info-item">
                    <i class="fa-regular fa-clock reg-info-icon"></i>
                    <div class="reg-info-content">
                        <p class="reg-info-label">Start Time</p>
                        <p class="reg-info-value">
                            <?php echo e(\Carbon\Carbon::parse($active_event->start_time)->format('h:i A')); ?>

                        </p>
                    </div>
                </div>
                <?php endif; ?>

                <div class="reg-info-item">
                    <i class="fa-solid fa-location-dot reg-info-icon"></i>
                    <div class="reg-info-content">
                        <p class="reg-info-label">Location</p>
                        <p class="reg-info-value"><?php echo e($active_event->location); ?></p>
                    </div>
                </div>

                <div class="reg-info-item">
                    <i class="fa-solid fa-person-running reg-info-icon"></i>
                    <div class="reg-info-content">
                        <p class="reg-info-label">Categories</p>
                        <p class="reg-info-value">
                            <?php echo e(collect($eventCategories)->pluck('distance')->filter()->implode(' • ')); ?>

                        </p>
                    </div>
                </div>

                <div class="reg-info-item">
                    <i class="fa-solid fa-ticket reg-info-icon"></i>
                    <div class="reg-info-content">
                        <p class="reg-info-label">Fee</p>
                        <p class="reg-info-value reg-info-fee">
                            BDT <?php echo e(number_format($active_event->fee)); ?>

                        </p>
                    </div>
                </div>

            </div>
        </div>
        <?php endif; ?>


        
        <form id="registrationForm"
              method="POST"
              action="<?php echo e(route('registrations.store')); ?>"
              enctype="multipart/form-data"
              novalidate
              class="reg-form-body">

            <?php echo csrf_field(); ?>
            <input type="hidden" name="event_id" id="event_id_field"
                   value="<?php echo e($active_event->id ?? 1); ?>">

            
            <div class="reg-section-card">

                <div class="reg-section-header">
                    <div class="reg-step-number">1</div>
                    <div class="reg-section-title">
                        <i class="fa-solid fa-user"></i>
                        <span>PERSONAL DETAILS</span>
                    </div>
                </div>

                <div class="reg-form-grid-2">

                    
                    <div class="reg-form-group" style="grid-column: 1 / -1;">
                        <label class="reg-label">
                            Profile Image
                            <span class="reg-optional">(Optional, max 50 MB)</span>
                        </label>

                        <div id="profile_dropzone" class="reg-dropzone">
                            <input type="file"
                                   name="profile_image"
                                   id="profile_image_input"
                                   accept="image/*"
                                   hidden>

                            <div id="profile_preview_wrapper" class="reg-preview-wrapper">
                                <img id="profile_preview_img"
                                     src=""
                                     alt=""
                                     class="reg-preview-img">
                                <i id="profile_placeholder_icon"
                                   class="fa-solid fa-user reg-placeholder-icon"></i>
                                <button type="button"
                                        id="profile_remove_btn"
                                        class="reg-remove-btn">
                                    &times;
                                </button>
                            </div>

                            <div class="reg-upload-info">
                                <p class="reg-upload-title">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                    <span id="profile_upload_text">Click to upload or drag &amp; drop</span>
                                </p>
                                <p class="reg-upload-hint">
                                    JPG, PNG or WEBP • Max 50 MB • Recommended 500×500
                                </p>
                            </div>

                            <span id="profile_action_chip" class="reg-action-chip">
                                Browse
                            </span>
                        </div>

                        <small id="profile_error" class="reg-field-error"></small>
                    </div>

                    
                    <div class="reg-form-group">
                        <label class="reg-label">
                            First Name <span class="reg-required">*</span>
                        </label>
                        <input type="text"
                               name="first_name"
                               placeholder="Enter your first name"
                               class="reg-input"
                               required>
                    </div>

                    
                    <div class="reg-form-group">
                        <label class="reg-label">
                            Last Name <span class="reg-required">*</span>
                        </label>
                        <input type="text"
                               name="last_name"
                               placeholder="Enter your last name"
                               class="reg-input"
                               required>
                    </div>

                    
                    <div class="reg-form-group">
                        <label class="reg-label">
                            Mobile Number <span class="reg-required">*</span>
                        </label>
                        <input type="tel"
                               name="phone"
                               id="phoneInput"
                               value="+880 "
                               placeholder="+880 1XXXXXXXXX"
                               class="reg-input"
                               required>
                    </div>

                    
                    <div class="reg-form-group">
                        <label class="reg-label">
                            WhatsApp Number <span class="reg-required">*</span>
                        </label>
                        <input type="tel"
                               name="whatsapp_number"
                               id="whatsappInput"
                               value="+880 "
                               placeholder="+880 1XXXXXXXXX"
                               class="reg-input"
                               required>
                    </div>

                    
                    <div class="reg-form-group">
                        <label class="reg-label">
                            Email Address <span class="reg-optional">(Optional)</span>
                        </label>
                        <input type="email"
                               name="email"
                               placeholder="example@email.com"
                               class="reg-input">
                    </div>

                    
                    <div class="reg-form-group">
                        <label class="reg-label">
                            Blood Group <span class="reg-required">*</span>
                        </label>
                        <select name="blood_group" class="reg-input" required>
                            <option value="" disabled selected>Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>

                    
                    <div class="reg-form-group" style="grid-column: 1 / -1;">
                        <label class="reg-label">
                            Gender <span class="reg-required">*</span>
                        </label>
                        <div class="reg-radio-group">
                            <label class="reg-radio-card">
                                <input type="radio" name="gender" value="Male" required>
                                <span>Male</span>
                            </label>
                            <label class="reg-radio-card">
                                <input type="radio" name="gender" value="Female">
                                <span>Female</span>
                            </label>
                            <label class="reg-radio-card">
                                <input type="radio" name="gender" value="Other">
                                <span>Other</span>
                            </label>
                        </div>
                    </div>

                    
                    <div class="reg-form-group">
                        <label class="reg-label">
                            Date of Birth <span class="reg-required">*</span>
                        </label>
                        <input type="text"
                               name="dob"
                               id="event-date"
                               placeholder="dd/mm/yyyy"
                               class="reg-input"
                               required>
                    </div>

                    
                    <div class="reg-form-group">
                        <label class="reg-label">
                            NID / Any Identification <span class="reg-required">*</span>
                        </label>
                        <input type="text"
                               name="nid"
                               placeholder="National ID or Passport Number"
                               class="reg-input"
                               required>
                    </div>

                    
                    <div class="reg-form-group" style="grid-column: 1 / -1;">
                        <label class="reg-label">
                            Address <span class="reg-optional">(Optional)</span>
                        </label>
                        <input type="text"
                               name="address"
                               placeholder="House/Street, Area, City"
                               class="reg-input">
                    </div>

                </div>
            </div>

            
            <div class="reg-section-card">

                <div class="reg-section-header">
                    <div class="reg-step-number">2</div>
                    <div class="reg-section-title">
                        <i class="fa-solid fa-phone"></i>
                        <span>EMERGENCY CONTACT</span>
                    </div>
                </div>

                <div class="reg-form-grid-2">
                    <div class="reg-form-group">
                        <label class="reg-label">
                            Contact Name <span class="reg-required">*</span>
                        </label>
                        <input type="text"
                               name="emergency_name"
                               placeholder="Contact Person Name"
                               class="reg-input"
                               required>
                    </div>

                    <div class="reg-form-group">
                        <label class="reg-label">
                            Contact Number <span class="reg-required">*</span>
                        </label>
                        <input type="tel"
                               name="emergency_phone"
                               id="emergencyPhoneInput"
                               value="+880 "
                               placeholder="+880 1XXXXXXXXX"
                               class="reg-input"
                               required>
                    </div>
                </div>
            </div>

            
            <div class="reg-section-card">

                <div class="reg-section-header">
                    <div class="reg-step-number">3</div>
                    <div class="reg-section-title">
                        <i class="fa-solid fa-shirt"></i>
                        <span>RUN SPECIFICATION & T-SHIRT</span>
                    </div>
                </div>

                <div class="reg-form-grid-2">

                    
                    <div class="reg-form-group">
                        <label class="reg-label">
                            Race Categories <span class="reg-required">*</span>
                        </label>
                        <select name="category" id="categorySelect" class="reg-input" required>
                            <option value="" disabled selected>Select Category</option>

                            <?php $__currentLoopData = $eventCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $distance = $cat['distance'] ?? '';
                                    $name     = $cat['name'] ?? '';
                                    $fee      = isset($cat['fee']) ? (float) $cat['fee'] : null;
                                ?>

                                <option value="<?php echo e($distance); ?>"
                                        data-fee="<?php echo e($fee ?? ''); ?>"
                                        data-name="<?php echo e($name); ?>">
                                    <?php echo e($name); ?> (<?php echo e($distance); ?>)
                                    <?php if($fee !== null): ?>
                                        — BDT <?php echo e(number_format($fee)); ?>

                                    <?php endif; ?>
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="reg-form-group">
                        <label class="reg-label">
                            T-Shirt Size <span class="reg-required">*</span>
                        </label>
                        <div class="reg-radio-group">
                            <label class="reg-radio-card tshirt-parent">
                                <input type="radio" name="tshirt" value="M">
                                <span>M</span>
                                <div class="tshirt-tooltip">
                                    <img src="<?php echo e(asset('img/t-shirt.png')); ?>" alt="T-Shirt">
                                </div>
                            </label>
                            <label class="reg-radio-card tshirt-parent">
                                <input type="radio" name="tshirt" value="L">
                                <span>L</span>
                                <div class="tshirt-tooltip">
                                    <img src="<?php echo e(asset('img/t-shirt.png')); ?>" alt="T-Shirt">
                                </div>
                            </label>
                            <label class="reg-radio-card tshirt-parent">
                                <input type="radio" name="tshirt" value="XL">
                                <span>XL</span>
                                <div class="tshirt-tooltip">
                                    <img src="<?php echo e(asset('img/t-shirt.png')); ?>" alt="T-Shirt">
                                </div>
                            </label>
                            <label class="reg-radio-card tshirt-parent">
                                <input type="radio" name="tshirt" value="XXL">
                                <span>XXL</span>
                                <div class="tshirt-tooltip">
                                    <img src="<?php echo e(asset('img/t-shirt.png')); ?>" alt="T-Shirt">
                                </div>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            
            <div class="reg-section-card" style="margin-bottom: 20px;">

                <div class="reg-section-header">
                    <div class="reg-step-number reg-step-number-green">4</div>
                    <div class="reg-section-title reg-section-title-green">
                        <i class="fa-solid fa-credit-card"></i>
                        <span>PAYMENT VERIFICATION</span>
                    </div>
                </div>

                <div class="reg-form-group">
                    <label class="reg-label">
                        Payment Method <span class="reg-required">*</span>
                    </label>
                    <div class="reg-radio-group">
                        <label class="reg-radio-card">
                            <input type="radio" name="payment_method" value="bKash" checked required>
                            <i class="fa-solid fa-paper-plane" style="color: #e11d48;"></i>
                            <span>bKash</span>
                        </label>
                        <label class="reg-radio-card">
                            <input type="radio" name="payment_method" value="Nagad" required>
                            <i class="fa-solid fa-paper-plane" style="color: #d2640b;"></i>
                            <span>Nagad</span>
                        </label>
                    </div>
                </div>

                <div class="reg-bkash-box">
                    <div class="reg-bkash-title">
                        <i class="fa-solid fa-paper-plane"></i>
                        bKash / Nagad Payment Verification
                    </div>
                    <div class="reg-bkash-sub">
                        <strong>Please complete your payment to our Personal bKash / Nagad Number (+880 1911469861) first</strong>,
                        then enter the verification details below.
                    </div>

                    <div class="reg-payment-grid">
                        <div class="reg-form-group">
                            <label class="reg-label">Amount</label>
                            <input type="text"
                                   name="event_price"
                                   id="eventPrice"
                                   value="<?php echo e(number_format($active_event->fee ?? 0)); ?>"
                                   class="reg-input reg-input-readonly"
                                   readonly>
                        </div>

                        <div class="reg-form-group">
                            <label class="reg-label">
                                Last 3 Digit of Sender # <span class="reg-required">*</span>
                            </label>
                            <input type="text"
                                   name="sender_phone_last3"
                                   placeholder="e.g., 762"
                                   maxlength="3"
                                   class="reg-input"
                                   required>
                        </div>

                        <div class="reg-form-group">
                            <label class="reg-label">
                                Transaction ID <span class="reg-required">*</span>
                            </label>
                            <input type="text"
                                   name="trx_id"
                                   placeholder="e.g., TRX987654321"
                                   class="reg-input"
                                   required>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="reg-confirmation-box">
                <input type="checkbox"
                       id="confirm_terms"
                       name="confirm_terms"
                       value="1"
                       required>
                <label for="confirm_terms">
                    I confirm that the information provided above is accurate and complete.
                    I agree to abide by the event rules and regulations.
                </label>
            </div>

            <button type="submit" class="reg-submit-btn" id="submitBtn">
                <span id="submitBtnText">Complete Registration</span>
                <span id="submitBtnSpinner" style="display:none; margin-left:8px;">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                </span>
            </button>

        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
$(function () {
    'use strict';

    /* ============================================================
       CATEGORY CHANGE → UPDATE AMOUNT
       ============================================================ */
    const $categorySelect = $('#categorySelect');
    const $eventPrice     = $('#eventPrice');

    $categorySelect.on('change', function () {
        const $selected = $(this).find('option:selected');
        const fee       = $selected.data('fee');

        if (fee !== undefined && fee !== '' && !isNaN(fee)) {
            $eventPrice.val(Number(fee).toLocaleString());
        }
    });
});
</script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('styles'); ?>
<style>
/* ============================================================================
   REGISTRATION FORM PAGE — Styles
   ============================================================================ */

/* ---------- PAGE WRAPPER ---------- */
.reg-page-wrapper {
    min-height: 100vh;
    background: #f8fafc;
    padding: 40px 20px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.reg-page-container {
    width: 100%;
    max-width: 850px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border: 1px solid #e2e8f0;
}

/* ---------- BANNER HEADER ---------- */
.reg-banner-header {
    background: linear-gradient(135deg, #fff 0%, #6bad3f 100%);
    padding: 25px 27px;
}

.reg-brand-area {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.reg-header-logo {
    height: 80px;
    object-fit: contain;
    flex-shrink: 0;
}

.reg-header-text {
    flex: 1;
    min-width: 200px;
}

.reg-header-title {
    margin: 0;
    font-size: 26px;
    font-weight: 800;
    letter-spacing: 0.5px;
    color: #2a2850;
    line-height: 1.2;
}

.reg-header-subtitle {
    margin: 6px 0 0 0;
    font-size: 13.5px;
    color: #2a2850;
    opacity: 0.9;
}

/* ---------- EVENT INFO STRIP ---------- */
.reg-info-strip {
    background: linear-gradient(135deg, #f0fdf4 0%, #ecfccb 100%);
    border-bottom: 1px solid #d9f99d;
    padding: 18px 25px;
}

.reg-info-status-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 14px;
}

.reg-status-badges {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.reg-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #459f0a;
    color: #fff;
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: 0.08em;
    padding: 5px 12px;
    border-radius: 999px;
    text-transform: uppercase;
}

.reg-status-badge i {
    font-size: 10px;
}

.reg-slots-text {
    font-size: 11.5px;
    color: #166534;
    font-weight: 700;
}

.reg-days-badge {
    font-size: 11.5px;
    color: #166534;
    font-weight: 800;
    background: #fff;
    padding: 5px 12px;
    border-radius: 999px;
    border: 1px solid #bbf7d0;
}

.reg-days-today {
    color: #b91c1c;
    border-color: #fecaca;
}

/* ---------- EVENT INFO GRID ---------- */
.reg-info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.reg-info-item {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid #d9f99d;
    min-width: 0;
}

.reg-info-icon {
    color: #459f0a;
    font-size: 14px;
    width: 16px;
    text-align: center;
    flex-shrink: 0;
}

.reg-info-content {
    min-width: 0;
    flex: 1;
}

.reg-info-label {
    margin: 0;
    font-size: 9.5px;
    font-weight: 800;
    color: #65a30d;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.reg-info-value {
    margin: 1px 0 0;
    font-size: 12.5px;
    font-weight: 700;
    color: #0f172a;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.reg-info-fee {
    color: #166534;
    font-weight: 800;
}

/* ---------- FORM BODY ---------- */
.reg-form-body {
    padding: 20px 24px 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    background-color: #f8fafc;
}

/* ---------- SECTION CARD ---------- */
.reg-section-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    border: 1px solid #f1f5f9;
}

.reg-section-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f1f5f9;
}

.reg-step-number {
    background: #6bad3f;
    color: #ffffff;
    width: 28px;
    height: 28px;
    border-radius: 50% 50% 50% 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 12px;
    flex-shrink: 0;
}

.reg-step-number-green {
    background: #459f0a;
}

.reg-section-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 800;
    font-size: 13px;
    color: #2f7102;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.reg-section-title-green {
    color: #1e293b;
}

.reg-section-title i {
    color: #265a03;
}

/* ---------- FORM GRID ---------- */
.reg-form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.reg-form-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.reg-label {
    font-size: 11.5px;
    font-weight: 700;
    color: #334155;
}

.reg-required {
    color: #ef4444;
}

.reg-optional {
    color: #64748b;
    font-weight: 400;
    font-size: 10.5px;
}

/* ---------- INPUTS ---------- */
.reg-input {
    width: 100%;
    padding: 9px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background-color: #f8fafc;
    font-size: 12.5px;
    color: #334155;
    outline: none;
    transition: all 0.2s ease;
    font-family: inherit;
}

.reg-input:focus {
    border-color: #6bad3f;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(107, 173, 63, 0.1);
}

.reg-input::placeholder {
    color: #94a3b8;
}

.reg-input-readonly {
    background-color: #f1f5f9;
    color: #475569;
    font-weight: 700;
    cursor: not-allowed;
}

/* ---------- RADIO GROUPS ---------- */
.reg-radio-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.reg-radio-card {
    flex: 1 1 0;
    min-width: 80px;
    border: 1px solid #cbd5e1;
    background-color: #f8fafc;
    border-radius: 8px;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 600;
    color: #334155;
    transition: all 0.2s ease;
    position: relative;
}

.reg-radio-card:hover {
    border-color: #6bad3f;
    background-color: #f0fdf4;
}

.reg-radio-card input[type="radio"] {
    accent-color: #6bad3f;
    cursor: pointer;
}

.reg-radio-card:has(input:checked) {
    border-color: #6bad3f;
    background-color: #f0fdf4;
    box-shadow: 0 0 0 2px rgba(107, 173, 63, 0.15);
}

/* ---------- DROPZONE ---------- */
.reg-dropzone {
    position: relative;
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 16px 18px;
    border: 2px dashed #fbcfe8;
    border-radius: 12px;
    background: linear-gradient(135deg, #fff 0%, #fff5f7 100%);
    cursor: pointer;
    transition: all 0.25s ease;
    flex-wrap: wrap;
}

.reg-dropzone:hover {
    border-color: #e11d48;
    background: linear-gradient(135deg, #fff5f7 0%, #ffe4e9 100%);
    box-shadow: 0 6px 20px rgba(225, 29, 72, 0.12);
}

.reg-preview-wrapper {
    position: relative;
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
    box-shadow: 0 4px 14px rgba(225, 29, 72, 0.15);
    border: 3px solid #fff;
    transition: all 0.25s ease;
}

.reg-preview-img {
    display: none;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.reg-placeholder-icon {
    font-size: 26px;
    color: #e11d48;
    opacity: 0.55;
}

.reg-remove-btn {
    display: none;
    position: absolute;
    top: -3px;
    right: -3px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: #e11d48;
    color: #fff;
    border: 2px solid #fff;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    line-height: 1;
    padding: 0;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
}

.reg-upload-info {
    flex: 1;
    min-width: 180px;
}

.reg-upload-title {
    margin: 0;
    font-size: 13.5px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.2;
}

.reg-upload-title i {
    color: #e11d48;
    margin-right: 4px;
}

.reg-upload-hint {
    margin: 4px 0 0;
    font-size: 11px;
    color: #64748b;
}

.reg-action-chip {
    padding: 6px 14px;
    font-size: 12px;
    font-weight: 700;
    color: #e11d48;
    background: #fff;
    border: 1.5px solid #fbcfe8;
    border-radius: 999px;
    white-space: nowrap;
}

.reg-field-error {
    display: none;
    color: #dc2626;
    font-size: 12px;
    margin-top: 6px;
    font-weight: 500;
}

/* ---------- BKASH BOX ---------- */
.reg-bkash-box {
    background-color: #fdf2f8;
    border: 1px solid #fbcfe8;
    border-radius: 10px;
    padding: 14px;
    margin-top: 14px;
}

.reg-bkash-title {
    color: #be185d;
    font-size: 12px;
    font-weight: 800;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 4px;
}

.reg-bkash-sub {
    font-size: 11.5px;
    color: #9d174d;
    margin-bottom: 12px;
    line-height: 1.5;
}

.reg-payment-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    width: 100%;
}

/* ---------- CONFIRMATION BOX ---------- */
.reg-confirmation-box {
    background-color: #e0f2fe;
    border-radius: 10px;
    padding: 12px 16px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 11.5px;
    color: #0369a1;
    font-weight: 600;
    line-height: 1.5;
}

.reg-confirmation-box input[type="checkbox"] {
    margin-top: 3px;
    accent-color: #0284c7;
    flex-shrink: 0;
    width: 16px;
    height: 16px;
}

/* ---------- SUBMIT BUTTON ---------- */
.reg-submit-btn {
    width: 100%;
    background: linear-gradient(135deg, #6bad3f 0%, #4f8a2c 100%);
    color: #ffffff;
    border: none;
    padding: 14px 20px;
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 0.5px;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 6px 20px rgba(107, 173, 63, 0.3);
}

.reg-submit-btn:hover {
    background: linear-gradient(135deg, #4f8a2c 0%, #3d6b22 100%);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(107, 173, 63, 0.4);
}

.reg-submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* ---------- TSHIRT TOOLTIP ---------- */
.tshirt-parent {
    position: relative;
}

.tshirt-tooltip {
    display: none;
    position: absolute;
    bottom: 115%;
    left: 50%;
    transform: translateX(-50%);
    width: 300px;
    max-width: 80vw;
    background: #ffffff;
    padding: 6px;
    border: 1px solid #cbd5e1;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.15);
    border-radius: 6px;
    z-index: 99999;
    text-align: center;
}

.tshirt-tooltip img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 4px;
}

.tshirt-parent:hover .tshirt-tooltip {
    display: block;
}

/* ============================================================================
   MOBILE RESPONSIVE
   ============================================================================ */

/* Tablet (≤ 768px) */
@media (max-width: 768px) {
    .reg-page-wrapper {
        padding: 20px 12px;
    }

    .reg-banner-header {
        padding: 20px 18px;
        text-align: center;
    }

    .reg-brand-area {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 12px;
    }

    .reg-header-logo {
        height: 70px;
    }

    .reg-header-title {
        font-size: 20px;
    }

    .reg-header-subtitle {
        font-size: 12px;
    }

    .reg-info-strip {
        padding: 16px 18px;
    }

    .reg-info-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .reg-info-status-row {
        justify-content: center;
        text-align: center;
    }

    .reg-status-badges {
        justify-content: center;
    }

    .reg-form-body {
        padding: 16px 14px 20px;
        gap: 14px;
    }

    .reg-section-card {
        padding: 14px;
    }

    .reg-section-header {
        gap: 8px;
        margin-bottom: 12px;
    }

    .reg-section-title {
        font-size: 12px;
    }

    .reg-form-grid-2 {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .reg-radio-group {
        gap: 8px;
    }

    .reg-radio-card {
        flex: 1 1 45%;
        font-size: 13px;
        padding: 10px;
    }

    .reg-dropzone {
        padding: 14px;
        gap: 14px;
    }

    .reg-preview-wrapper {
        width: 60px;
        height: 60px;
    }

    .reg-placeholder-icon {
        font-size: 22px;
    }

    .reg-upload-info {
        min-width: 100%;
    }

    .reg-action-chip {
        width: 100%;
        text-align: center;
        padding: 10px 14px;
    }

    .reg-payment-grid {
        grid-template-columns: 1fr;
    }

    .reg-submit-btn {
        padding: 15px 20px;
        font-size: 14px;
    }
}

/* Small phone (≤ 480px) */
@media (max-width: 480px) {
    .reg-page-wrapper {
        padding: 12px 8px;
    }

    .reg-page-container {
        border-radius: 12px;
    }

    .reg-banner-header {
        padding: 16px 14px;
    }

    .reg-header-logo {
        height: 60px;
    }

    .reg-header-title {
        font-size: 17px;
    }

    .reg-header-subtitle {
        font-size: 11.5px;
    }

    .reg-info-strip {
        padding: 14px;
    }

    .reg-info-item {
        padding: 9px 12px;
    }

    .reg-info-value {
        font-size: 12px;
    }

    .reg-form-body {
        padding: 12px 10px 16px;
    }

    .reg-section-card {
        padding: 12px;
        border-radius: 10px;
    }

    .reg-section-title {
        font-size: 11.5px;
    }

    .reg-step-number {
        width: 24px;
        height: 24px;
        font-size: 11px;
    }

    .reg-label {
        font-size: 11px;
    }

    .reg-input {
        padding: 10px 12px;
        font-size: 13px;
    }

    .reg-radio-card {
        flex: 1 1 100%;
        font-size: 12.5px;
    }

    .reg-confirmation-box {
        font-size: 11px;
        padding: 11px 14px;
    }

    .reg-submit-btn {
        padding: 14px 16px;
        font-size: 13px;
    }
}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\run-event\resources\views/form.blade.php ENDPATH**/ ?>