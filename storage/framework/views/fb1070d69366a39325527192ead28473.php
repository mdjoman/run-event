<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'RUN BURJOWAN - Running Events & Community'); ?></title>
    <link rel="icon" type="image/webp" href="<?php echo e(asset('img/logo.png')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* ============ SWEETALERT THEME ============ */
        .swal2-popup {
            border-radius: 16px !important;
            font-family: 'Inter', sans-serif !important;
            padding: 24px !important;
        }
        .swal2-title {
            font-weight: 700 !important;
            color: #1e293b !important;
            font-size: 20px !important;
        }
        .swal2-html-container {
            color: #64748b !important;
            font-size: 14px !important;
        }
        .swal2-confirm {
            border-radius: 10px !important;
            font-weight: 600 !important;
            padding: 10px 22px !important;
        }

        /* ============ CUSTOM SUCCESS MODAL ============ */
        #successModal {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .6);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 16px;
        }
        #successModal.show {
            display: flex;
            animation: fadeInSuccess .25s ease;
        }
        @keyframes fadeInSuccess {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .success-card {
            background: #fff;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0,0,0,.25);
            overflow: hidden;
            animation: popInSuccess .35s cubic-bezier(.18,.89,.32,1.28);
        }
        @keyframes popInSuccess {
            0%   { transform: scale(.85); opacity: 0; }
            100% { transform: scale(1);   opacity: 1; }
        }
        .success-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 28px 20px 22px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .success-header::before,
        .success-header::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
        }
        .success-header::before { width: 120px; height: 120px; top: -50px; right: -30px; }
        .success-header::after  { width: 80px;  height: 80px;  bottom: -30px; left: -20px; }

        .success-checkmark {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,.15);
            position: relative;
            z-index: 2;
        }
        .success-checkmark i {
            font-size: 32px;
            color: #10b981;
        }
        .success-header h2 {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 4px;
            position: relative;
            z-index: 2;
        }
        .success-header p {
            color: rgba(255,255,255,.9);
            font-size: 13px;
            margin: 0;
            position: relative;
            z-index: 2;
        }
        .success-body {
            padding: 22px 24px 24px;
            text-align: center;
        }
        .success-body p {
            color: #475569;
            font-size: 14px;
            margin: 0 0 4px;
            line-height: 1.5;
        }
        .success-body .success-note {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 6px;
        }
        .success-close-btn {
            width: 100%;
            margin-top: 18px;
            padding: 12px;
            background: #e11d48;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s ease;
        }
        .success-close-btn:hover {
            background: #be123c;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(225,29,72,.3);
        }
        .success-close-btn:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>


<header class="header">
    <div class="container nav-container">
        <a href="<?php echo e(route('home')); ?>" class="logo">
            <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Run Burjowan">
        </a>

        <nav class="nav-links">
            <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Home</a>
            <a class="nav-link <?php echo e(request()->routeIs('event') ? 'active' : ''); ?>" href="<?php echo e(route('event')); ?>">Events</a>
            <a class="nav-link <?php echo e(request()->routeIs('about') ? 'active' : ''); ?>" href="<?php echo e(route('about')); ?>">About</a>
            <a class="nav-link <?php echo e(request()->routeIs('activity') ? 'active' : ''); ?>" href="<?php echo e(route('activity')); ?>">Activities</a>
            <a class="nav-link <?php echo e(request()->routeIs('service') ? 'active' : ''); ?>" href="<?php echo e(route('service')); ?>">Services</a>
            <a class="nav-link <?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>" href="<?php echo e(route('contact')); ?>">Contact</a>
            <a href="#">Results</a>
            <a href="#">Gallery</a>
        </nav>

        <div class="nav-actions">
            <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="#" class="btn-login">Login</a>
            <a href="#" class="btn-primary">Join Us</a>
        </div>
    </div>
</header>


<?php echo $__env->yieldContent('body'); ?>


<section class="cta-banner" style="background-image: url('<?php echo e(asset('img/home3.jpg')); ?>');">
    <div class="cta-overlay"></div>
    <div class="cta-brush-left"></div>

    <div class="container cta-content-wrapper">
        <div class="cta-text">
            <h2>Your Next Finish Line<br><span class="highlight">Starts Here</span></h2>
            <p>Be part of the journey. Register for upcoming events and take the first step towards a healthier, stronger you.</p>
        </div>
        <a href="<?php echo e(route('event')); ?>" class="btn-cta">
            Explore Events <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</section>


<footer class="footer">
    <div class="container footer-top">
        <div class="footer-brand">
            <a href="<?php echo e(route('home')); ?>" class="logo">
                <img src="<?php echo e(asset('img/logo2.png')); ?>" alt="Run Burjowan">
            </a>
        </div>

        <div class="footer-links">
            <a href="<?php echo e(route('home')); ?>">Home</a>
            <a href="<?php echo e(route('event')); ?>">Events</a>
            <a href="<?php echo e(route('activity')); ?>">Activities</a>
            <a href="<?php echo e(route('about')); ?>">About</a>
            <a href="<?php echo e(route('service')); ?>">Services</a>
            <a href="<?php echo e(route('contact')); ?>">Contact</a>
            <a href="#">Results</a>
            <a href="#">Gallery</a>
        </div>

        <div class="footer-contact">
            <div class="social-icons">
                <a href="https://www.facebook.com/RunBujowan" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <p><i class="fa-regular fa-envelope"></i> info@runburjowan.com</p>
            <p><i class="fa-solid fa-location-dot"></i> Dhaka, Bangladesh</p>
        </div>
    </div>

    <div class="container footer-bottom">
        <p><span id="year"></span> Run Burjowan. All rights reserved.</p>
        <p>Running Together for a Healthier Tomorrow</p>
    </div>
</footer>


<div class="modal-overlay" id="registrationModal">
    <div class="modal-container">
        <button type="button" class="close-btn" id="closeRegModal">&times;</button>

        <div class="banner-header">
            <div class="brand-section">
                <div class="logo-area">
                    <i class="fa-solid fa-person-running logo-icon"></i>
                    <div class="header-title-area">
                        <h1>EVENT REGISTRATION</h1>
                        <p>Complete the form below to confirm your official participation</p>
                    </div>
                </div>
                <div class="header-title-area"></div>
            </div>
        </div>

        <form class="modal-body"
              id="registrationForm"
              method="POST"
              action="<?php echo e(route('registrations.store')); ?>"
              enctype="multipart/form-data"
              novalidate>

            <?php echo csrf_field(); ?>
            <input type="hidden" name="event_id" id="event_id_field" value="1">

            
            <div class="section-card">
                <div class="section-header">
                    <div class="step-number">1</div>
                    <div class="section-header-title">
                        <i class="fa-solid fa-user"></i>
                        <span>PERSONAL DETAILS</span>
                    </div>
                </div>

                <div class="form-grid-2">
                    
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Profile Image <span class="optional">(Optional, max 50 MB)</span></label>

                        <div id="profile_dropzone"
                             style="position:relative; display:flex; align-items:center; gap:18px;
                                    padding:16px 18px; border:2px dashed #fbcfe8; border-radius:12px;
                                    background:linear-gradient(135deg,#fff 0%,#fff5f7 100%);
                                    cursor:pointer; transition:all .25s ease; flex-wrap:wrap;">

                            <input type="file" name="profile_image" id="profile_image_input"
                                   accept="image/*" style="display:none;">

                            <div id="profile_preview_wrapper"
                                 style="position:relative; width:72px; height:72px; border-radius:50%;
                                        background:linear-gradient(135deg,#fce7f3 0%,#fbcfe8 100%);
                                        display:flex; align-items:center; justify-content:center;
                                        flex-shrink:0; overflow:hidden;
                                        box-shadow:0 4px 14px rgba(225,29,72,.15);
                                        border:3px solid #fff; transition:all .25s ease;">
                                <img id="profile_preview_img" src="" alt=""
                                     style="display:none; width:100%; height:100%; object-fit:cover;">
                                <i id="profile_placeholder_icon" class="fa-solid fa-user"
                                   style="font-size:26px; color:#e11d48; opacity:.55;"></i>
                                <button type="button" id="profile_remove_btn"
                                        style="display:none; position:absolute; top:-3px; right:-3px;
                                               width:22px; height:22px; border-radius:50%;
                                               background:#e11d48; color:#fff; border:2px solid #fff;
                                               cursor:pointer; align-items:center; justify-content:center;
                                               font-size:11px; line-height:1; padding:0;
                                               box-shadow:0 2px 6px rgba(0,0,0,.15);">
                                    &times;
                                </button>
                            </div>

                            <div style="flex:1; min-width:180px;">
                                <p style="margin:0; font-size:14px; font-weight:700; color:#1e293b; line-height:1.2;">
                                    <i class="fa-solid fa-cloud-arrow-up" style="color:#e11d48;"></i>
                                    <span id="profile_upload_text">Click to upload or drag &amp; drop</span>
                                </p>
                                <p style="margin:4px 0 0; font-size:11.5px; color:#64748b;">
                                    JPG, PNG or WEBP • Max 50 MB • Recommended 500×500
                                </p>
                            </div>

                            <span id="profile_action_chip"
                                  style="padding:6px 14px; font-size:12px; font-weight:700;
                                         color:#e11d48; background:#fff; border:1.5px solid #fbcfe8;
                                         border-radius:999px; white-space:nowrap;">
                                Browse
                            </span>
                        </div>

                        <small id="profile_error"
                               style="display:none; color:#dc2626; font-size:12px; margin-top:6px; font-weight:500;"></small>
                    </div>

                    <div class="form-group">
                        <label>First Name <span class="required">*</span></label>
                        <input type="text" name="first_name" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name <span class="required">*</span></label>
                        <input type="text" name="last_name" placeholder="Enter your last name" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number <span class="required">*</span></label>
                        <input type="tel" name="phone" id="phoneInput" value="+880 " placeholder="+880 1XXXXXXXXX" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address <span class="optional">(Optional)</span></label>
                        <input type="email" name="email" placeholder="example@email.com">
                    </div>
                    <div class="form-group">
                        <label>Gender <span class="required">*</span></label>
                        <div class="radio-options-group">
                            <label class="radio-card"><input type="radio" name="gender" value="Male" required> Male</label>
                            <label class="radio-card"><input type="radio" name="gender" value="Female"> Female</label>
                            <label class="radio-card"><input type="radio" name="gender" value="Other"> Other</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth <span class="required">*</span></label>
                        <input type="text" name="dob" id="event-date" placeholder="dd/mm/yyyy" required>
                    </div>
                </div>

                <div class="form-grid-1" style="margin-top: 12px;">
                    <div class="form-group">
                        <label>NID / Any Identification Number <span class="required">*</span></label>
                        <input type="text" name="nid" placeholder="National ID or Passport Number" required>
                    </div>
                    <div class="form-group">
                        <label>Address <span class="optional">(Optional)</span></label>
                        <input type="text" name="address" placeholder="House/Street, Area, City">
                    </div>
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <div class="step-number">2</div>
                    <div class="section-header-title">
                        <i class="fa-solid fa-phone"></i>
                        <span>EMERGENCY CONTACT DETAILS</span>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Emergency Contact Name <span class="required">*</span></label>
                        <input type="text" name="emergency_name" placeholder="Contact Person Name" required>
                    </div>
                    <div class="form-group">
                        <label>Emergency Contact Number <span class="required">*</span></label>
                        <input type="tel" name="phone" id="phoneInput" value="+880 " placeholder="+880 1XXXXXXXXX" required>
                    </div>
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <div class="step-number">3</div>
                    <div class="section-header-title">
                        <i class="fa-solid fa-shirt"></i>
                        <span>EVENT SPECIFICATIONS & T-SHIRT</span>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Race Categories / Ticket Type <span class="required">*</span></label>
                        <select name="category" required style="padding:5px;">
                            <option value="" disabled selected>Select Category</option>
                            <option value="5k">7.5K Run</option>
                            <option value="10k">15K Run</option>
                            <option value="10k">21.5K Run</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>T-Shirt Size <span class="required">*</span></label>
                        <div class="radio-options-group">
                            <label class="radio-card"><input type="radio" name="tshirt" value="S" required> S</label>
                            <label class="radio-card"><input type="radio" name="tshirt" value="M"> M</label>
                            <label class="radio-card"><input type="radio" name="tshirt" value="L"> L</label>
                            <label class="radio-card"><input type="radio" name="tshirt" value="XL"> XL</label>
                            <label class="radio-card"><input type="radio" name="tshirt" value="XXL"> XXL</label>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <div class="step-number">4</div>
                    <div class="section-header-title">
                        <i class="fa-solid fa-credit-card"></i>
                        <span>PAYMENT METHOD & VERIFICATION</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Payment Method <span class="required">*</span></label>
                    <div class="radio-options-group">
                        <label class="radio-card">
                            <input type="radio" name="payment_method" value="bKash" checked required>
                            <i class="fa-solid fa-paper-plane" style="color:#e11d48;"></i> bKash
                        </label>
                    </div>
                </div>

                <div class="bkash-box">
                    <div class="bkash-title">
                        <i class="fa-solid fa-paper-plane"></i> bKash Payment Verification
                    </div>
                    <div class="bkash-sub">
                        <strong style="font-size: 13px !important;">Please complete your payment to our Personal bKash Number (+880 1711808026) first</strong>, then enter the verification details below.
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label>Sender Phone # (Last 3 Digits) <span class="required">*</span></label>
                            <input type="text" name="sender_phone_last3" placeholder="e.g., 762" maxlength="3" required>
                        </div>
                        <div class="form-group">
                            <label>Transaction ID <span class="required">*</span></label>
                            <input type="text" name="trx_id" placeholder="e.g., TRX987654321" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="confirmation-box">
                <input type="checkbox" id="confirm_terms" name="confirm_terms" value="1" required>
                <label for="confirm_terms">
                    I confirm that the information provided above is accurate and complete.
                    I agree to abide by the event rules and regulations.
                </label>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">
                <span id="submitBtnText">Complete Registration</span>
                <span id="submitBtnSpinner" style="display:none; margin-left:8px;">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                </span>
            </button>
        </form>
    </div>
</div>


<div id="successModal">
    <div class="success-card">
        <div class="success-header">
            <div class="success-checkmark">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2>Registration Successful!</h2>
            <p>Your spot has been reserved</p>
        </div>
        <div class="success-body">
            <p id="successMessage">Your registration has been received.</p>
            <p class="success-note">We'll review your payment and notify you shortly.</p>
            <button type="button" class="success-close-btn" id="successCloseBtn">
                <i class="fa-solid fa-check"></i> &nbsp;Great, Got It!
            </button>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Tailwind config


    document.addEventListener('DOMContentLoaded', function () {

        /* ============================================================
           YEAR
           ============================================================ */
        const yearEl = document.getElementById('year');
        if (yearEl) yearEl.textContent = new Date().getFullYear();


        /* ============================================================
           MODAL OPEN / CLOSE
           ============================================================ */
        const modal    = document.getElementById('registrationModal');
        const closeBtn = document.getElementById('closeRegModal');

        if (modal) {
            document.addEventListener('click', function (e) {
                const trigger = e.target.closest('.openRegModal');
                if (trigger) {
                    e.preventDefault();
                    const evId = trigger.getAttribute('data-event-id');
                    const evField = document.getElementById('event_id_field');
                    if (evId && evField) evField.value = evId;
                    modal.classList.add('active');
                }
            });

            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    modal.classList.remove('active');
                });
            }

            modal.addEventListener('click', function (e) {
                if (e.target === modal) modal.classList.remove('active');
            });
        }


        /* ============================================================
           PROFILE IMAGE — DROPZONE + PREVIEW + 50 MB LIMIT
           ============================================================ */
        const profileInput       = document.getElementById('profile_image_input');
        const profileDropzone    = document.getElementById('profile_dropzone');
        const profilePreview     = document.getElementById('profile_preview_img');
        const profilePlaceholder = document.getElementById('profile_placeholder_icon');
        const profileRemoveBtn   = document.getElementById('profile_remove_btn');
        const profileErrorEl     = document.getElementById('profile_error');
        const profileTitleText   = document.getElementById('profile_upload_text');
        const profileActionChip  = document.getElementById('profile_action_chip');

        const PROFILE_MAX_SIZE = 50 * 1024 * 1024;

        if (profileInput && profileDropzone) {

            profileDropzone.addEventListener('click', function (e) {
                if (e.target === profileRemoveBtn || profileRemoveBtn.contains(e.target)) return;
                profileInput.click();
            });

            profileDropzone.addEventListener('mouseenter', function () {
                profileDropzone.style.borderColor = '#e11d48';
                profileDropzone.style.background = 'linear-gradient(135deg,#fff5f7 0%,#ffe4e9 100%)';
                profileDropzone.style.boxShadow = '0 6px 20px rgba(225,29,72,.12)';
                profileActionChip.style.background = '#e11d48';
                profileActionChip.style.color = '#fff';
                profileActionChip.style.borderColor = '#e11d48';
            });
            profileDropzone.addEventListener('mouseleave', function () {
                profileDropzone.style.borderColor = '#fbcfe8';
                profileDropzone.style.background = 'linear-gradient(135deg,#fff 0%,#fff5f7 100%)';
                profileDropzone.style.boxShadow = 'none';
                profileActionChip.style.background = '#fff';
                profileActionChip.style.color = '#e11d48';
                profileActionChip.style.borderColor = '#fbcfe8';
            });

            ['dragenter', 'dragover'].forEach(function (evt) {
                profileDropzone.addEventListener(evt, function (e) {
                    e.preventDefault(); e.stopPropagation();
                    profileDropzone.style.borderColor = '#e11d48';
                    profileDropzone.style.borderStyle = 'solid';
                    profileDropzone.style.background = 'linear-gradient(135deg,#ffe4e9 0%,#fbcfe8 100%)';
                });
            });
            ['dragleave', 'drop'].forEach(function (evt) {
                profileDropzone.addEventListener(evt, function (e) {
                    e.preventDefault(); e.stopPropagation();
                    profileDropzone.style.borderColor = '#fbcfe8';
                    profileDropzone.style.borderStyle = 'dashed';
                    profileDropzone.style.background = 'linear-gradient(135deg,#fff 0%,#fff5f7 100%)';
                });
            });

            profileDropzone.addEventListener('drop', function (e) {
                const f = e.dataTransfer.files[0];
                if (f) handleProfileFile(f);
            });
            profileInput.addEventListener('change', function (e) {
                const f = e.target.files[0];
                if (f) handleProfileFile(f);
            });

            function handleProfileFile(file) {
                profileErrorEl.style.display = 'none';
                profileErrorEl.textContent = '';

                if (!file.type.startsWith('image/')) {
                    showProfileError('Please select a valid image (JPG, PNG, WEBP).');
                    return;
                }
                if (file.size > PROFILE_MAX_SIZE) {
                    const mb = (file.size / (1024 * 1024)).toFixed(2);
                    showProfileError('Image is too large (' + mb + ' MB). Maximum is 50 MB.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (ev) {
                    profilePreview.src = ev.target.result;
                    profilePreview.style.display = 'block';
                    profilePlaceholder.style.display = 'none';
                    profileRemoveBtn.style.display = 'flex';
                    profileTitleText.textContent = file.name.length > 34
                        ? file.name.slice(0, 31) + '…'
                        : file.name;
                    profileActionChip.textContent = 'Change';
                    profileDropzone.style.borderStyle = 'solid';
                    profileDropzone.style.borderColor = '#e11d48';
                };
                reader.readAsDataURL(file);
            }

            function showProfileError(msg) {
                profileErrorEl.textContent = msg;
                profileErrorEl.style.display = 'block';
                profileInput.value = '';
            }

            profileRemoveBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                resetProfileUploader();
            });

            function resetProfileUploader() {
                profileInput.value = '';
                profilePreview.src = '';
                profilePreview.style.display = 'none';
                profilePlaceholder.style.display = 'block';
                profileRemoveBtn.style.display = 'none';
                profileTitleText.textContent = 'Click to upload or drag & drop';
                profileActionChip.textContent = 'Browse';
                profileDropzone.style.borderStyle = 'dashed';
                profileDropzone.style.borderColor = '#fbcfe8';
                profileErrorEl.style.display = 'none';
            }

            window.resetProfileUploader = resetProfileUploader;
        }


        /* ============================================================
           AJAX SUBMIT + CUSTOM SUCCESS MODAL
           ============================================================ */
        const form      = document.getElementById('registrationForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText   = document.getElementById('submitBtnText');
        const btnSpin   = document.getElementById('submitBtnSpinner');

        const successModal     = document.getElementById('successModal');
        const successMessage   = document.getElementById('successMessage');
        const successCloseBtn  = document.getElementById('successCloseBtn');

        if (!form) return;

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            clearFieldErrors();
            setLoading(true);

            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                let data;
                try {
                    data = await response.json();
                } catch (parseErr) {
                    console.error('Invalid JSON:', parseErr);
                    setLoading(false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'Unexpected response from server. Please try again.',
                        confirmButtonColor: '#e11d48',
                    });
                    return;
                }

                /* ---------- Validation errors (422) ---------- */
                if (response.status === 422) {
                    displayErrors(data.errors || {});
                    setLoading(false);
                    scrollToFirstError();

                    const firstError = Object.values(data.errors || {})[0]?.[0]
                        || 'Please fix the highlighted fields.';

                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: firstError,
                        confirmButtonColor: '#e11d48',
                        confirmButtonText: 'Fix Now',
                    });
                    return;
                }

                /* ---------- Other HTTP errors ---------- */
                if (!response.ok) {
                    setLoading(false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message || 'Something went wrong. Please try again.',
                        confirmButtonColor: '#e11d48',
                    });
                    return;
                }

                /* ---------- Success ---------- */
                if (data.success) {
                    setLoading(false);

                    // Update success modal message
                    successMessage.textContent = data.message || 'Your registration has been received.';

                    // Show custom success modal
                    successModal.classList.add('show');

                    // Reset form + preview
                    form.reset();
                    if (typeof window.resetProfileUploader === 'function') {
                        window.resetProfileUploader();
                    }

                    // Close registration modal behind success modal
                    if (modal) modal.classList.remove('active');

                } else {
                    setLoading(false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Unknown error.',
                        confirmButtonColor: '#e11d48',
                    });
                }

            } catch (err) {
                console.error('Fetch error:', err);
                setLoading(false);
                Swal.fire({
                    icon: 'error',
                    title: 'Network Error',
                    text: 'Please check your connection and try again.',
                    confirmButtonColor: '#e11d48',
                });
            }
        });

        // Close custom success modal
        if (successCloseBtn) {
            successCloseBtn.addEventListener('click', function () {
                successModal.classList.remove('show');
            });
        }

        // Close on backdrop click
        if (successModal) {
            successModal.addEventListener('click', function (e) {
                if (e.target === successModal) {
                    successModal.classList.remove('show');
                }
            });
        }


        /* ============================================================
           HELPERS
           ============================================================ */
        function setLoading(isLoading) {
            submitBtn.disabled = isLoading;
            btnText.style.opacity = isLoading ? '.5' : '1';
            btnSpin.style.display = isLoading ? 'inline-block' : 'none';
            submitBtn.style.cursor = isLoading ? 'not-allowed' : 'pointer';
        }

        function displayErrors(errors) {
            Object.keys(errors).forEach(function (field) {
                const inputs = form.querySelectorAll('[name="' + field + '"]');
                if (!inputs.length) return;

                const first = inputs[0];
                const wrapper = first.closest('.form-group') || first.parentElement;

                inputs.forEach(function (el) {
                    el.style.borderColor = '#ef4444';
                    el.style.boxShadow = '0 0 0 2px rgba(239,68,68,.15)';
                });

                let err = wrapper.querySelector('.field-error');
                if (!err) {
                    err = document.createElement('small');
                    err.className = 'field-error';
                    err.style.cssText = 'display:block; color:#ef4444; font-size:11px; margin-top:4px; font-weight:500;';
                    wrapper.appendChild(err);
                }
                err.textContent = errors[field][0];
            });
        }

        function clearFieldErrors() {
            form.querySelectorAll('.field-error').forEach(function (el) { el.remove(); });
            form.querySelectorAll('input, select, textarea').forEach(function (el) {
                el.style.borderColor = '';
                el.style.boxShadow = '';
            });
        }

        function scrollToFirstError() {
            const first = form.querySelector('.field-error');
            if (first) {
                first.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }


        /* ============================================================
           MISC EFFECTS           ============================================================ */
        document.querySelectorAll('.btn-register, .btn-search, .btn-subscribe').forEach(function (button) {
            button.addEventListener('click', function () {
                this.style.transform = 'scale(0.95)';
                const self = this;
                setTimeout(function () { self.style.transform = 'none'; }, 150);
            });
        });

        const dots = document.querySelectorAll('.dot');
        dots.forEach(function (dot) {
            dot.addEventListener('click', function () {
                dots.forEach(function (d) { d.classList.remove('active'); });
                dot.classList.add('active');
            });
        });

        window.addEventListener('scroll', function () {
            document.querySelectorAll('.cat-card, .event-card, .why-card').forEach(function (card) {
                const cardTop = card.getBoundingClientRect().top;
                if (cardTop < window.innerHeight - 50) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        });

    });

    flatpickr("#event-date", {
        dateFormat: "d/m/Y",
        allowInput: true
    });

    const phoneInput = document.getElementById('phoneInput');
    phoneInput.addEventListener('keydown', function(e) {
        if (this.selectionStart <= 4 && (e.key === 'Backspace' || e.key === 'Delete')) {
            e.preventDefault();
        }
    });

    phoneInput.addEventListener('click', function() {
        if (this.selectionStart < 5) {
            this.setSelectionRange(this.value.length, this.value.length);
        }
    });

    phoneInput.addEventListener('input', function() {
        if (!this.value.startsWith('+880 ')) {
            this.value = '+880 ';
        }
    });
    /*==============================================================
    ==================================================================*/
    document.addEventListener('DOMContentLoaded', function () {
    const registerBtns = document.querySelectorAll('.proceedRegistrationBtn');

    registerBtns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: '<span style="color: #e11d48;">Payment Instruction</span>',
                html: '<p style="color: #475569; font-size: 14px;">Please complete your payment to our Personal bKash Number (<strong style="color: #e11d52;">+880 1711808026</strong>) first, then enter the verification details below.</p>',
                background: '#fff5f7',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'I am ready, OK',
                cancelButtonText: 'Go Back',
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const registrationModal = document.getElementById('registrationModal');
                    if (registrationModal) {
                        registrationModal.style.display = 'flex';
                        registrationModal.classList.add('active');
                    }
                }
            });
        });
    });
});
</script>
</body>
</html>
<?php /**PATH C:\laragon\www\run-event\resources\views/master.blade.php ENDPATH**/ ?>