<?php $__env->startSection('body'); ?>
<div class="page-wrapper" style="min-height: 100vh; background: #f8fafc; padding: 40px 20px; display: flex; justify-content: center; align-items: center;">
    <div class="page-container" style="width: 100%; max-width: 800px; background: #ffffff; border-radius: 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); overflow: hidden; border: 1px solid #e2e8f0;">
        <div class="banner-header" style="background: linear-gradient(135deg, #fff 0%, #6bad3f  100%); color: #fff; padding: 30px 40px;">
            <div class="brand-section" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="logo-area" style="display: flex; align-items: center; gap: 16px;">
                    <img src="<?php echo e(asset('img/logo.png')); ?>" alt="" style="height: 100px;">
                    <div class="header-title-area">
                        <h1 style="margin: 0; font-size: 29px; font-weight: 800; letter-spacing: 0.5px;color: #2a2850; ">EVENT REGISTRATION</h1>
                        <p style="margin: 6px 0 0 0; font-size: 14px; opacity: 0.9;color: #2a2850; ">Complete the form below to confirm your official participation</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form class="modal-body" id="registrationForm" method="POST" action="<?php echo e(route('registrations.store')); ?>" enctype="multipart/form-data" novalidate style="padding: 40px;">

            <?php echo csrf_field(); ?>
            <input type="hidden" name="event_id" id="event_id_field" value="1">

            
            <div class="section-card" style="margin-bottom: 30px;">
                <div class="section-header" style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">
                    <div class="step-number" style="background: #459f0a; color: #fff; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 700; font-size: 13px;">1</div>
                    <div class="section-header-title" style="font-weight: 700; color: #1e293b; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-user" style="color: #459f0a;"></i>
                        <span>PERSONAL DETAILS</span>
                    </div>
                </div>

                <div class="form-grid-2" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px;">
                    
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 8px;">Profile Image <span class="optional" style="color: #94a3b8; font-weight: 400;">(Optional, max 50 MB)</span></label>

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
                                    <i class="fa-solid fa-cloud-arrow-up" style="color:#459f0a;"></i>
                                    <span id="profile_upload_text">Click to upload or drag &amp; drop</span>
                                </p>
                                <p style="margin:4px 0 0; font-size:11.5px; color:#64748b;">
                                    JPG, PNG or WEBP • Max 50 MB • Recommended 500×500
                                </p>
                            </div>

                            <span id="profile_action_chip"
                                  style="padding:6px 14px; font-size:12px; font-weight:700;
                                         color:#459f0a; background:#fff; border:1.5px solid #fbcfe8;
                                         border-radius:999px; white-space:nowrap;">
                                Browse
                            </span>
                        </div>

                        <small id="profile_error"
                               style="display:none; color:#dc2626; font-size:12px; margin-top:6px; font-weight:500;"></small>
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">First Name <span class="required" style="color: #e11d48;">*</span></label>
                        <input type="text" name="first_name" placeholder="Enter your first name" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Last Name <span class="required" style="color: #e11d48;">*</span></label>
                        <input type="text" name="last_name" placeholder="Enter your last name" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Mobile Number <span class="required" style="color: #e11d48;">*</span></label>
                        <input type="tel" name="phone" id="phoneInput" value="+880 " placeholder="+880 1XXXXXXXXX" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">WhatsApp Number <span class="required" style="color: #e11d48;">*</span></label>
                        <input type="tel" name="whatsapp_number" id="whatsappInput" value="+880 " placeholder="+880 1XXXXXXXXX" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Email Address <span class="optional" style="color: #94a3b8; font-weight: 400;">(Optional)</span></label>
                        <input type="email" name="email" placeholder="example@email.com" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Blood Group <span class="required" style="color: #e11d48;">*</span></label>
                        <select name="blood_group" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: #fff;">
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
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Gender <span class="required" style="color: #e11d48;">*</span></label>
                        <div class="radio-options-group" style="display: flex; gap: 10px;">
                            <label class="radio-card" style="display: flex; align-items: center; gap: 6px; font-size: 13px; cursor: pointer;"><input type="radio" name="gender" value="Male" required> Male</label>
                            <label class="radio-card" style="display: flex; align-items: center; gap: 6px; font-size: 13px; cursor: pointer;"><input type="radio" name="gender" value="Female"> Female</label>
                            <label class="radio-card" style="display: flex; align-items: center; gap: 6px; font-size: 13px; cursor: pointer;"><input type="radio" name="gender" value="Other"> Other</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Date of Birth <span class="required" style="color: #e11d48;">*</span></label>
                        <input type="text" name="dob" id="event-date" placeholder="dd/mm/yyyy" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                </div>

                
                <div class="form-grid-2" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; margin-top: 20px;">
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">NID / Any Identification Number <span class="required" style="color: #e11d48;">*</span></label>
                        <input type="text" name="nid" placeholder="National ID or Passport Number" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Preferred BIB Number <span class="optional" style="color: #94a3b8; font-weight: 400;">(Optional)</span></label>
                        <input type="text" name="bib_number" placeholder="e.g. 101 or preferred number" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                </div>

                <div class="form-grid-1" style="margin-top: 20px;">
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Address <span class="optional" style="color: #94a3b8; font-weight: 400;">(Optional)</span></label>
                        <input type="text" name="address" placeholder="House/Street, Area, City" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                </div>
            </div>

            
            <div class="section-card" style="margin-bottom: 30px;">
                <div class="section-header" style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">
                    <div class="step-number" style="background: #459f0a; color: #fff; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 700; font-size: 13px;">2</div>
                    <div class="section-header-title" style="font-weight: 700; color: #1e293b; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-phone" style="color: #459f0a;"></i>
                        <span>EMERGENCY CONTACT DETAILS</span>
                    </div>
                </div>

                <div class="form-grid-2" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px;">
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Emergency Contact Name <span class="required" style="color: #e11d48;">*</span></label>
                        <input type="text" name="emergency_name" placeholder="Contact Person Name" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Emergency Contact Number <span class="required" style="color: #e11d48;">*</span></label>
                        <input type="tel" name="emergency_phone" id="emergencyPhoneInput" value="+880 " placeholder="+880 1XXXXXXXXX" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    </div>
                </div>
            </div>

            
            <div class="section-card" style="margin-bottom: 30px;">
                <div class="section-header" style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">
                    <div class="step-number" style="background: #459f0a; color: #fff; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 700; font-size: 13px;">3</div>
                    <div class="section-header-title" style="font-weight: 700; color: #1e293b; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-shirt" style="color: #459f0a;"></i>
                        <span>EVENT SPECIFICATIONS & T-SHIRT</span>
                    </div>
                </div>

                <div class="form-grid-2" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px;">
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Race Categories / Ticket Type <span class="required" style="color: #e11d48;">*</span></label>
                        <select name="category" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: #fff;">
                            <option value="" disabled selected>Select Category</option>
                            <option value="7.5k">7.5K Run</option>
                            <option value="15k">15K Run</option>
                            <option value="21.5k">21.5K Run</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">T-Shirt Size <span class="required" style="color: #e11d48;">*</span></label>
                        <div class="radio-options-group" style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <label class="radio-card" style="display: flex; align-items: center; gap: 4px; font-size: 13px; cursor: pointer;"><input type="radio" name="tshirt" value="S" required> S</label>
                            <label class="radio-card" style="display: flex; align-items: center; gap: 4px; font-size: 13px; cursor: pointer;"><input type="radio" name="tshirt" value="M"> M</label>
                            <label class="radio-card" style="display: flex; align-items: center; gap: 4px; font-size: 13px; cursor: pointer;"><input type="radio" name="tshirt" value="L"> L</label>
                            <label class="radio-card" style="display: flex; align-items: center; gap: 4px; font-size: 13px; cursor: pointer;"><input type="radio" name="tshirt" value="XL"> XL</label>
                            <label class="radio-card" style="display: flex; align-items: center; gap: 4px; font-size: 13px; cursor: pointer;"><input type="radio" name="tshirt" value="XXL"> XXL</label>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="section-card" style="margin-bottom: 30px;">
                <div class="section-header" style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">
                    <div class="step-number" style="background: #459f0a; color: #fff; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 700; font-size: 13px;">4</div>
                    <div class="section-header-title" style="font-weight: 700; color: #1e293b; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-credit-card" style="color: #459f0a;"></i>
                        <span>PAYMENT METHOD & VERIFICATION</span>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Payment Method <span class="required" style="color: #e11d48;">*</span></label>
                    <div class="radio-options-group">
                        <label class="radio-card" style="display: inline-flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                            <input type="radio" name="payment_method" value="bKash" checked required>
                            <i class="fa-solid fa-paper-plane" style="color:#e11d48;"></i> bKash
                        </label>
                    </div>
                </div>

                <div class="bkash-box" style="background: #fff5f7; border: 1px solid #fbcfe8; padding: 20px; border-radius: 12px;">
                    <div class="bkash-title" style="font-weight: 700; color: #be123c; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-paper-plane"></i> bKash Payment Verification
                    </div>
                    <div class="bkash-sub" style="font-size: 13px; color: #475569; margin-bottom: 16px;">
                        <strong style="font-size: 13px !important; color: #1e293b;">Please complete your payment to our Personal bKash Number (+880 1711808026) first</strong>, then enter the verification details below.
                    </div>

                    <div class="form-grid-2" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px;">
                        <div class="form-group">
                            <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Sender Phone # (Last 3 Digits) <span class="required" style="color: #e11d48;">*</span></label>
                            <input type="text" name="sender_phone_last3" placeholder="e.g., 762" maxlength="3" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: #fff;">
                        </div>
                        <div class="form-group">
                            <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Transaction ID <span class="required" style="color: #e11d48;">*</span></label>
                            <input type="text" name="trx_id" placeholder="e.g., TRX987654321" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: #fff;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="confirmation-box" style="display: flex; align-items: flex-start; gap: 10px; margin-bottom: 25px;">
                <input type="checkbox" id="confirm_terms" name="confirm_terms" value="1" required style="margin-top: 3px;">
                <label for="confirm_terms" style="font-size: 13px; color: #475569; line-height: 1.5; cursor: pointer;">
                    I confirm that the information provided above is accurate and complete.
                    I agree to abide by the event rules and regulations.
                </label>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn" style="width: 100%; background: #459f0a; color: #fff; border: none; padding: 14px 20px; font-size: 16px; font-weight: 700; border-radius: 10px; cursor: pointer; transition: background 0.2s;">
                <span id="submitBtnText">Complete Registration</span>
                <span id="submitBtnSpinner" style="display:none; margin-left:8px;">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                </span>
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\run-event\resources\views/form.blade.php ENDPATH**/ ?>