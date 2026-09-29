
<div class="modal-overlay" id="registrationModal">
    <div class="modal-container">
        <button type="button" class="close-btn" id="closeRegModal">&times;</button>

        <div class="banner-header">
            <div class="brand-section">
                <div class="logo-area">
                    <i class="fa-solid fa-person-running logo-icon"></i>
                    <div class="header-title-area">
                        <h1>EVENT REGISTRATION</h1>
                        <p id="regModalSubtitle">Complete the form below to confirm your official participation</p>
                    </div>
                </div>
            </div>
        </div>

        <form class="modal-body" id="registrationForm" method="POST"
              action="<?php echo e(route('registrations.store')); ?>"
              enctype="multipart/form-data" novalidate>

            <?php echo csrf_field(); ?>
            <input type="hidden" name="event_id" id="event_id_field" value="">

            
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
                        <label>WhatsApp Number <span class="required">*</span></label>
                        <input type="tel" name="whatsapp_number" id="whatsappInput" value="+880 " placeholder="+880 1XXXXXXXXX" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address <span class="optional">(Optional)</span></label>
                        <input type="email" name="email" placeholder="example@email.com">
                    </div>
                    <div class="form-group">
                        <label>Blood Group <span class="required">*</span></label>
                        <select name="blood_group" required style="padding:8px; width:100%; font-size:13px;">
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

                <div class="form-grid-2" style="margin-top: 12px;">
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
                        <label>Contact Name <span class="required">*</span></label>
                        <input type="text" name="emergency_name" placeholder="Contact Person Name" required>
                    </div>
                    <div class="form-group">
                        <label>Contact Number <span class="required">*</span></label>
                        <input type="tel" name="emergency_phone" id="emergencyPhoneInput" value="+880 " placeholder="+880 1XXXXXXXXX" required>
                    </div>
                </div>
            </div>

            
            <div class="section-card">
                <div class="section-header">
                    <div class="step-number">3</div>
                    <div class="section-header-title">
                        <i class="fa-solid fa-shirt"></i>
                        <span>RUN SPECIFICATION & T-SHIRT</span>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Categories <span class="required">*</span></label>
                        <select name="category" id="modalCategorySelect" required style="padding:5px; font-size:13px;">
                            <option value="">Select Category</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>T-Shirt Size <span class="required">*</span></label>
                        <div class="radio-options-group" style="display: flex; gap: 10px;">
                            <label class="radio-card tshirt-parent">
                                <input type="radio" name="tshirt" value="M"> M
                                <div class="tshirt-tooltip"><img src="<?php echo e(asset('img/t-shirt.png')); ?>" alt="T-Shirt"></div>
                            </label>
                            <label class="radio-card tshirt-parent">
                                <input type="radio" name="tshirt" value="L"> L
                                <div class="tshirt-tooltip"><img src="<?php echo e(asset('img/t-shirt.png')); ?>" alt="T-Shirt"></div>
                            </label>
                            <label class="radio-card tshirt-parent">
                                <input type="radio" name="tshirt" value="XL"> XL
                                <div class="tshirt-tooltip"><img src="<?php echo e(asset('img/t-shirt.png')); ?>" alt="T-Shirt"></div>
                            </label>
                            <label class="radio-card tshirt-parent">
                                <input type="radio" name="tshirt" value="XXL"> XXL
                                <div class="tshirt-tooltip"><img src="<?php echo e(asset('img/t-shirt.png')); ?>" alt="T-Shirt"></div>
                            </label>
                        </div>
                    </div>

                    <style>
                        .tshirt-parent { position: relative; cursor: pointer; }
                        .tshirt-tooltip {
                            display: none;
                            position: absolute;
                            bottom: 115%; left: 50%;
                            transform: translateX(-50%);
                            width: 500px;
                            background: #ffffff;
                            padding: 6px;
                            border: 1px solid #cbd5e1;
                            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.15);
                            border-radius: 6px;
                            z-index: 99999;
                            text-align: center;
                        }
                        .tshirt-tooltip img { width: 100%; height: auto; display: block; border-radius: 4px; }
                        .tshirt-parent:hover .tshirt-tooltip { display: block; }
                    </style>
                </div>
            </div>

            
            <div class="section-card" style="margin-bottom: 30px;">
                <div class="section-header" style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">
                    <div class="step-number" style="background: #459f0a; color: #fff; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 700; font-size: 13px;">4</div>
                    <div class="section-header-title" style="font-weight: 700; color: #1e293b; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-credit-card" style="color: #459f0a;"></i>
                        <span>PAYMENT VERIFICATION</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Payment Method <span class="required">*</span></label>
                    <div class="radio-options-group">
                        <label class="radio-card">
                            <input type="radio" name="payment_method" value="bKash" checked required>
                            <i class="fa-solid fa-paper-plane" style="color:#e11d48;"></i> bKash
                        </label>
                        <label class="radio-card">
                            <input type="radio" name="payment_method" value="Nagad" required>
                            <i class="fa-solid fa-paper-plane" style="color:#d2640b;"></i> Nagad
                        </label>
                    </div>
                </div>

                <div class="bkash-box">
                    <div class="bkash-title">
                        <i class="fa-solid fa-paper-plane"></i> bKash / Nagad Payment Verification
                    </div>
                    <div class="bkash-sub">
                        <strong style="font-size: 13px !important;">Please complete your payment to our Personal bKash / Nagad Number (+880 1911469861) first</strong>, then enter the verification details below.
                    </div>
                    <div class="payment-grid-container" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; width: 100%;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label>Amount</label>
                            <input class="amount" type="text" name="event_price" placeholder=""
                                   id="eventPrice" value="" readonly style="width: 100%;">
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <label>Last 3 Digit of Sender # <span class="required">*</span></label>
                            <input type="text" name="sender_phone_last3" placeholder="e.g., 762" maxlength="3" required style="width: 100%;">
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <label>Transaction ID <span class="required">*</span></label>
                            <input type="text" name="trx_id" placeholder="e.g., TRX987654321" required style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>

            <style>
                @media (max-width: 768px) {
                    .payment-grid-container { grid-template-columns: 1fr !important; }
                }
            </style>

            
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
</div><?php /**PATH D:\laragon\www\run-event\resources\views/registration-modal.blade.php ENDPATH**/ ?>