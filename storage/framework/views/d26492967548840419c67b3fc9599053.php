<style>
    b, strong {
        font-size: 16px !important;
    }
    small{
        font-size: 12px !important;
    }
    /* ======================= */
    .unique-past-wrapper {
        width: 100% !important;
        overflow: hidden !important;
    }

    .unique-past-grid {
        display: flex !important;
        gap: 20px !important;
        width: 100% !important;
    }

    .unique-past-card {
        min-width: 100% !important;
        flex: 0 0 100% !important;
        box-sizing: border-box !important;
    }

    @media (min-width: 769px) {
        .unique-past-card {
            min-width: calc(25% - 15px) !important;
            flex: 0 0 calc(25% - 15px) !important;
        }
    }
    .action-buttons .shareBtn {
    background: #1877f2;     /* Facebook blue */
}

.action-buttons .shareBtn:hover {
    background: #0f5ecb;
}
</style>
<?php $__env->startSection('body'); ?>
<section class="ev-hero-section" style="background-image: url('img/event.jpg');">
    <div class="ev-hero-overlay"></div>
    <div class="container ev-hero-content">
        <span class="ev-sub-tag">• RUN • CONNECT • EXPLORE</span>
        <h1 class="ev-hero-title">OUR <span class="ev-green-text">EVENTS</span></h1>
        <p class="ev-hero-desc">Join our running community and be part of exciting events, from local runs to major Marathons.</p>
    </div>
</section>

<div class="container ev-main-wrapper">
    <div class="ev-tabs-bar">
        <button class="ev-tab-btn ev-active-tab"><i class="fa-regular fa-calendar-check"></i> Upcoming Events</button>
        <button class="ev-tab-btn"><i class="fa-regular fa-clock"></i> Previous Events</button>
    </div>
    <?php if($active_event): ?>
    <div class="ev-section-header">
        <div>
            <span class="ev-section-tag">UPCOMING EVENT</span>
            <h2 class="ev-section-title"><?php echo e($active_event->title); ?></h2>
            <p class="ev-sub-text">Run through the city of dreams!</p>
        </div>
        <a href="#" class="ev-view-all-link">View All Upcoming <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <div class="ev-main-event-card">
        <div class="ev-event-left-box">
            <div class="ev-event-img-wrap">
                <img src="<?php echo e(asset('img/dhakarun.jpeg')); ?>" alt="Sirajganj City Marathon" onclick="openEventModal()">
                <div class="ev-date-badge">
                     <span class="day"><?php echo e(date('d', strtotime($active_event->event_date))); ?></span>
                     <span class="month"><?php echo e(date('M', strtotime($active_event->event_date))); ?></span>
                     <span class="year"><?php echo e(date('Y', strtotime($active_event->event_date))); ?></span>
                </div>
            </div>

            <div class="ev-meta-grid">
                <div class="ev-meta-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <div><strong>Location</strong><br><small><?php echo e($active_event->location); ?></small></div>
                </div>
                <div class="ev-meta-item">
                    <i class="fa-solid fa-route"></i>
                    <div><strong>Distance</strong><br><small><?php echo e($active_event->category); ?></small></div>
                </div>
                <div class="ev-meta-item">
                    <i class="fa-solid fa-clock"></i>
                    <div><strong>Start Time</strong><br><small>6:00 AM</small></div>
                </div>
            </div>

            <div class="ev-features-list" style="font-size: 14px !important;">
                <span><i class="fa-solid fa-award"></i> Medal</span>
                <span><i class="fa-solid fa-shirt"></i> T-shirt</span>
                <span><i class="fa-solid fa-glass-water"></i> Refreshments</span>
                <span><i class="fa-solid fa-user-nurse"></i> Hydration</span>
            </div>
        </div>

        <div class="ev-widget-right-box">
            <div class="ev-offer-banner">
                <p>Register before 18 Nov 2026</p>
            </div>

            <div class="ev-widget-group">
                <label class="ev-label">Select Your Category</label>
                <div class="ev-category-grid">
                    <button class="ev-cat-btn">7.5K<br><span>BDT 500</span></button>
                    <button class="ev-cat-btn ev-cat-active">15K<br><span>BDT 500</span></button>
                    <button class="ev-cat-btn">21.5K<br><span>BDT 500</span></button>
                    <button class="ev-cat-btn ev-cat-disabled" disabled>42K<br><span>BDT 500</span></button>
                </div>
            </div>

            <div class="ev-widget-group">
                <label class="ev-label">Participant</label>
                <div class="ev-qty-picker">
                    <button class="ev-qty-btn">-</button>
                    <input type="text" value="1" readonly class="ev-qty-input">
                    <button class="ev-qty-btn">+</button>
                </div>
            </div>

            <div class="ev-total-box">
                <span>Total Amount</span>
                <h3 class="ev-total-price">BDT <?php echo e($active_event->fee); ?></h3>
            </div>
                   <?php if($active_event->status == 'active'): ?>
                             <div class="action-buttons">
                                
                                <a href="javascript:void(0)"
                                class="btn-primary shareBtn"
                                data-url="<?php echo e(route('form', $active_event->id)); ?>"
                                data-title="Winter Half Marathon 2026">
                                    Share <i class="fa-solid fa-share-nodes"></i>
                                </a>

                                
                                <a href="#"
                                class="btn-primary proceedRegistrationBtn"
                                data-title="<?php echo e($active_event->title); ?>"
                                data-price="<?php echo e($active_event->fee); ?>"
                                data-event_id="<?php echo e($active_event->id); ?>">
                                    Proceed to Registration <i class="fa-solid fa-arrow-right"></i></i>
                                </a>
                            </div>
                            <?php endif; ?>


            <div class="ev-payment-brands">
                <!--<span><img src="<?php echo e(asset('img/visa.webp')); ?>" alt="Visa"></span>-->
                
                <!--<span><img src="<?php echo e(asset('img/nagod.png')); ?>" alt="Nagad"></span>-->
            </div>
        </div>
    </div>
    <?php else: ?>

    
    <div class="ev-section-header">
        <div>
            <span class="ev-section-tag">UPCOMING EVENT</span>
            <h2 class="ev-section-title">No Upcoming Events</h2>
            <p class="ev-sub-text">Stay tuned! New events will be announced soon.</p>
        </div>
    </div>

    <div class="ev-no-event-box">
        <div class="ev-no-event-icon">
            <i class="fa-regular fa-calendar-xmark"></i>
        </div>
        <h3>No Events Available Right Now</h3>
        <p>We're preparing something exciting. Check back later or follow us for updates.</p>
        <a href="#" class="ev-btn-notify">
            <i class="fa-regular fa-bell"></i> Notify Me
        </a>
    </div>

<?php endif; ?>

    <div class="ev-section-header ev-mt-50">
        <div>
            <span class="ev-section-tag">EVENT HIGHLIGHTS</span>
            <h2 class="ev-section-title">Our Previous Events</h2>
        </div>
        
    </div>

    <div class="unique-past-wrapper">
        <div class="unique-past-grid">
            <div class="unique-past-card">
                <div class="ev-past-img-box">
                    <img src="<?php echo e(asset('img/ur1.jpeg')); ?>" alt="Run Burjowan">
                    <span class="ev-past-date">16 JUL 2026</span>
                </div>
                <div class="ev-past-card-body">
                    <h3 class="ev-past-title">Sirajgang Half Marathon 2026</h3>
                    <p class="ev-past-info"><i class="fa-solid fa-location-dot"></i> Sirajganj</p>
                    <p class="ev-past-info"><i class="fa-solid fa-route"></i> 7.5K | 15K | 21.5K | 30K</p>
                    <a href="#" class="ev-btn-view-more">View More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="unique-past-card">
                <div class="ev-past-img-box">
                    <img src="<?php echo e(asset('img/ur2.jpeg')); ?>" alt="Desert Run">
                    <span class="ev-past-date">16 JUL 2026</span>
                </div>
                <div class="ev-past-card-body">
                    <h3 class="ev-past-title">Sirajgang Half Marathon 2026</h3>
                    <p class="ev-past-info"><i class="fa-solid fa-location-dot"></i> Sirajganj</p>
                    <p class="ev-past-info"><i class="fa-solid fa-route"></i> 7.5K | 15K | 21.5K | 30K</p>
                    <a href="#" class="ev-btn-view-more">View More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="unique-past-card">
                <div class="ev-past-img-box">
                    <img src="<?php echo e(asset('img/ur3.jpeg')); ?>" alt="Community Run">
                    <span class="ev-past-date">16 JUL 2026</span>
                </div>
                <div class="ev-past-card-body">
                    <h3 class="ev-past-title">Sirajgang Half Marathon 2026</h3>
                    <p class="ev-past-info"><i class="fa-solid fa-location-dot"></i> Sirajganj</p>
                    <p class="ev-past-info"><i class="fa-solid fa-route"></i> 7.5K | 15K | 21.5K | 30K</p>
                    <a href="#" class="ev-btn-view-more">View More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="unique-past-card">
                <div class="ev-past-img-box">
                    <img src="<?php echo e(asset('img/ur4.jpeg')); ?>" alt="Night Run">
                    <span class="ev-past-date">16 JUL 2026</span>
                </div>
                <div class="ev-past-card-body">
                    <h3 class="ev-past-title">Sirajgang Half Marathon 2026</h3>
                    <p class="ev-past-info"><i class="fa-solid fa-location-dot"></i> Sirajganj</p>
                    <p class="ev-past-info"><i class="fa-solid fa-route"></i> 7.5K | 15K | 21.5K | 30K</p>
                    <a href="#" class="ev-btn-view-more">View More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="unique-past-card">
                <div class="ev-past-img-box">
                    <img src="<?php echo e(asset('img/ur5.jpeg')); ?>" alt="Extra Run">
                    <span class="ev-past-date">16 JUL 2026</span>
                </div>
                <div class="ev-past-card-body">
                    <h3 class="ev-past-title">Sirajgang Half Marathon 2026</h3>
                    <p class="ev-past-info"><i class="fa-solid fa-location-dot"></i> Sirajganj</p>
                    <p class="ev-past-info"><i class="fa-solid fa-route"></i> 7.5K | 15K | 21.5K | 30K</p>
                    <a href="#" class="ev-btn-view-more">View More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="ev-steps-wrapper">
        <span class="ev-section-tag">HOW TO REGISTER</span>
        <h2 class="ev-section-title">Simple Steps to Join</h2>

        <div class="ev-steps-container">
            <div class="ev-step-card">
                <div class="ev-step-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <h4 class="ev-step-title">1. Choose Your Event</h4>
                <p class="ev-step-desc">Browse upcoming events and select your category.</p>
            </div>
            <div class="ev-step-arrow"><i class="fa-solid fa-angle-right"></i></div>

            <div class="ev-step-card">
                <div class="ev-step-icon"><i class="fa-solid fa-user-pen"></i></div>
                <h4 class="ev-step-title">2. Register</h4>
                <p class="ev-step-desc">Fill in your details and complete the form.</p>
            </div>
            <div class="ev-step-arrow"><i class="fa-solid fa-angle-right"></i></div>

            <div class="ev-step-card">
                <div class="ev-step-icon"><i class="fa-regular fa-credit-card"></i></div>
                <h4 class="ev-step-title">3. Make Payment</h4>
                <p class="ev-step-desc">Secure and easy online payment options.</p>
            </div>
            <div class="ev-step-arrow"><i class="fa-solid fa-angle-right"></i></div>

            <div class="ev-step-card">
                <div class="ev-step-icon"><i class="fa-solid fa-circle-check"></i></div>
                <h4 class="ev-step-title">4. Get Confirmation</h4>
                <p class="ev-step-desc">Receive your e-ticket and event details instantly.</p>
            </div>
        </div>
    </div>
</div>

<title>Run BURJOWAN - Event Details</title>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #eef2f7;
    }

    /* =========================
       MODAL
    ========================== */

    .event-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 25px;
        background: rgba(5, 20, 45, .78);
        backdrop-filter: blur(6px);

        opacity: 0;
        visibility: hidden;
        transition: .3s ease;
    }

    .event-modal.active {
        opacity: 1;
        visibility: visible;
    }

    .event-modal-box {
        width: min(1450px, 96vw);
        max-height: 94vh;
        background: #fff;
        border-radius: 22px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 25px 80px rgba(0,0,0,.35);

        transform: translateY(25px) scale(.97);
        transition: .35s ease;
    }

    .event-modal.active .event-modal-box {
        transform: translateY(0) scale(1);
    }

    /* CLOSE BUTTON */

    .modal-close {
        position: absolute;
        right: 18px;
        top: 18px;
        width: 42px;
        height: 42px;
        border: 0;
        border-radius: 50%;
        background: rgba(255,255,255,.95);
        color: #102c55;
        font-size: 25px;
        cursor: pointer;
        z-index: 20;
        box-shadow: 0 5px 20px rgba(0,0,0,.2);
        transition: .2s;
    }

    .modal-close:hover {
        transform: rotate(90deg);
        background: #6bad3f;
        color: white;
    }

    /* SCROLL AREA */

    .event-scroll {
        max-height: 94vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .event-scroll::-webkit-scrollbar {
        width: 8px;
    }

    .event-scroll::-webkit-scrollbar-thumb {
        background: #142f58;
        border-radius: 20px;
    }

    .event-hero {
        min-height: 310px;
        position: relative;
        overflow: hidden;
        padding: 32px 55px;

        background:
            linear-gradient(
                90deg,
                rgba(255,255,255,.98) 0%,
                rgba(255,255,255,.88) 34%,
                rgba(255,255,255,.10) 72%,
                rgba(255,255,255,0) 100%
            ),
            linear-gradient(
                180deg,
                #a9dcff 0%,
                #f9d49c 62%,
                #b5d6d7 100%
            );
    }

    .bridge {
        position: absolute;
        right: -40px;
        bottom: 55px;
        width: 58%;
        height: 80px;
        opacity: .30;
    }

    .bridge::before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: 12px;
        height: 6px;
        background: #17365f;
        box-shadow: 0 18px 0 #17365f;
    }

    .bridge::after {
        content: "";
        position: absolute;
        left: 8%;
        right: 8%;
        bottom: 0;
        height: 65px;
        border-top: 4px solid #17365f;
        border-radius: 50% 50% 0 0;
        box-shadow:
            100px 0 0 -2px #17365f,
            200px 0 0 -2px #17365f,
            300px 0 0 -2px #17365f;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        width: 58%;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
    }

    .brand-runner {
        font-size: 48px;
    }

    .brand-text {
        line-height: .85;
    }

    .brand-text strong {
        display: block;
        font-size: 28px;
        font-weight: 900;
        color: #102d56;
        letter-spacing: -1px;
    }

    .brand-text span {
        display: block;
        margin-top: 8px;
        color: #102d56;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
    }

    .event-label {
        display: inline-block;
        background: #6bad3f;
        color: white;
        font-size: 13px;
        font-weight: 800;
        padding: 8px 20px;
        transform: skew(-8deg);
        margin-bottom: 9px;
    }

    .presented {
        color: #14345f;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .hero-title {
        display: inline-block;
        background: #102f59;
        color: white;
        padding: 8px 25px 12px;
        font-size: clamp(35px, 4vw, 62px);
        line-height: .9;
        font-weight: 950;
        letter-spacing: -2px;
        position: relative;
    }

    .hero-title span {
        color: #6bad3f;
        display: inline;
    }

    .hero-year {
        color: #102f59;
        font-size: 42px;
        font-weight: 900;
        margin-top: 3px;
    }

    .hero-tagline {
        position: absolute;
        right: 60px;
        top: 35px;
        width: 180px;
        text-align: center;
        color: #14345f;
        font-size: 20px;
        line-height: 1.25;
        font-weight: 800;
        font-style: italic;
    }

    .hero-tagline span {
        color: #6bad3f;
    }

    /* RUNNERS */

    .runners {
        position: absolute;
        right: 4%;
        bottom: 48px;
        display: flex;
        align-items: flex-end;
        gap: 12px;
        z-index: 3;
    }

    .runner {
        width: 50px;
        height: 125px;
        position: relative;
    }

    .runner::before {
        content: "";
        position: absolute;
        width: 25px;
        height: 25px;
        background: #102f59;
        border-radius: 50%;
        left: 14px;
        top: 0;
    }

    .runner::after {
        content: "";
        position: absolute;
        width: 25px;
        height: 75px;
        background: #102f59;
        border-radius: 12px;
        left: 14px;
        top: 24px;
        transform: rotate(-7deg);
        box-shadow:
            -17px 45px 0 -6px #102f59,
            22px 50px 0 -6px #102f59;
    }

    .runner.big {
        width: 70px;
        height: 175px;
    }

    .runner.big::before {
        width: 34px;
        height: 34px;
        left: 18px;
    }

    .runner.big::after {
        width: 35px;
        height: 105px;
        left: 18px;
        top: 32px;
    }

    .event-content {
        padding: 30px 38px 40px;
        background: #fff;
    }

    .intro-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 28px;
        margin-bottom: 28px;
    }

    .intro-text {
        padding: 8px 10px;
    }

    .intro-text p {
        color: #17365f;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .intro-text strong {
        color: #102f59;
    }

    .pink {
        color: #6bad3f !important;
        font-weight: 900;
    }

    .section-title {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #102f59;
        color: white;
        padding: 3px 22px 3px 12px;
        border-radius: 30px 30px 30px 0;
        font-size: 18px;
        font-weight: 900;
        margin-bottom: 15px;
    }

    .section-icon {
        width: 36px;
        height: 36px;
        background: #6bad3f;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-left: -8px;
    }
    .overview {
        background: linear-gradient(135deg, #eef8ff, #e5f2fc);
        border: 1px solid #d4e7f5;
        border-radius: 18px;
        padding: 18px 22px;
        position: relative;
    }

    .overview-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px 25px;
    }

    .overview-item {
        display: grid;
        grid-template-columns: 28px 75px 10px 1fr;
        align-items: center;
        font-size: 13px;
        color: #17365f;
    }

    .overview-item .icon {
        font-size: 17px;
    }

    .overview-item b {
        font-weight: 800;
    }

    .race-section {
        margin-bottom: 28px;
    }

    .race-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .race-card {
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #d8e4ef;
        background: white;
        box-shadow: 0 5px 18px rgba(18,50,90,.08);
    }

    .race-header {
        min-height: 78px;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
    }

    .race-card:nth-child(1) .race-header {
        background: linear-gradient(110deg, #ed0b68, #f58eb7);
    }

    .race-card:nth-child(2) .race-header {
        background: linear-gradient(110deg, #0769bd, #6eb8ed);
    }

    .race-card:nth-child(3) .race-header {
        background: linear-gradient(110deg, #068e75, #7ad6b6);
    }

    .race-distance {
        font-size: 34px;
        line-height: .9;
        font-weight: 950;
    }

    .race-name {
        font-size: 15px;
        font-weight: 900;
        margin-top: 5px;
    }

    .race-runner-icon {
        font-size: 45px;
    }

    .race-body {
        padding: 15px;
        min-height: 155px;
    }

    .race-body h4 {
        color: #17365f;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .race-body p {
        color: #4d6078;
        font-size: 12px;
        line-height: 1.5;
    }

    .cutoff {
        margin-top: 13px;
        background: #edf5fb;
        padding: 9px;
        border-radius: 10px;
        color: #17365f;
        font-size: 11px;
        font-weight: 700;
    }

    .cutoff strong {
        display: block;
        color: #6bad3f;
        font-size: 13px;
        margin-top: 3px;
    }

    .lower-grid {
        display: grid;
        grid-template-columns: 1.25fr .95fr;
        gap: 22px;
        margin-top: 25px;
    }

    .panel {
        border: 1px solid #dbe7f1;
        border-radius: 18px;
        padding: 18px;
        background: #fbfdff;
    }

    .entitlement-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 18px 10px;
    }

    .entitlement {
        text-align: center;
        color: #17365f;
        font-size: 11px;
        font-weight: 700;
    }

    .entitlement-icon {
        width: 48px;
        height: 48px;
        margin: auto auto 8px;
        border-radius: 50%;
        border: 5px solid #6bad3f;
        background: #102f59;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .award-intro {
        font-size: 12px;
        color: #17365f;
        margin-bottom: 10px;
    }

    .award-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 5px;
        font-size: 11px;
    }

    .award-table th {
        background: #102f59;
        color: white;
        padding: 8px 5px;
        border-radius: 7px;
    }

    .award-table th:first-child {
        background: #6bad3f;
    }

    .award-table td {
        background: #eef6fc;
        padding: 7px 5px;
        text-align: center;
        color: #17365f;
        font-weight: 700;
    }

    .notes {
        margin-top: 10px;
        background: #fff0f6;
        border-radius: 10px;
        padding: 10px;
        font-size: 10px;
        line-height: 1.5;
        color: #17365f;
    }

    .bottom-grid {
        display: grid;
        grid-template-columns: .8fr 1.2fr;
        gap: 22px;
        margin-top: 22px;
    }

    .schedule {
        min-height: 160px;
        background:
            linear-gradient(rgba(238,248,255,.94), rgba(238,248,255,.94)),
            linear-gradient(120deg,#8fc4e5,#fff);
        border-radius: 18px;
        padding: 20px;
        border: 1px solid #d6e8f4;
    }

    .tba {
        text-align: center;
        font-size: 42px;
        color: #17365f;
        font-weight: 900;
        margin-top: 20px;
    }

    .rules {
        background: #fbfdff;
        border: 1px solid #dbe7f1;
        border-radius: 18px;
        padding: 20px;
    }

    .rules ul {
        list-style: none;
    }

    .rules li {
        position: relative;
        padding-left: 24px;
        margin-bottom: 9px;
        color: #334d69;
        font-size: 11px;
        line-height: 1.45;
    }

    .rules li::before {
        content: "✓";
        position: absolute;
        left: 0;
        top: 0;
        width: 17px;
        height: 17px;
        border-radius: 50%;
        background: #6bad3f;
        color: white;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .event-footer {
        margin-top: 28px;
        padding: 28px 35px;
        background: #102f59;
        color: white;
        border-radius: 18px;
        position: relative;
        overflow: hidden;
        text-align: right;
    }

    .event-footer::before,
    .event-footer::after {
        content: "";
        position: absolute;
        height: 4px;
        width: 45%;
        bottom: 15px;
        border-radius: 100%;
        background: #6bad3f;
        left: -5%;
        transform: rotate(-5deg);
    }

    .event-footer::after {
        left: auto;
        right: -5%;
        background: #0878d1;
        transform: rotate(5deg);
    }

    .footer-main {
        font-size: 24px;
        font-weight: 800;
        font-style: italic;
    }

    .footer-main span {
        color: #6bad3f;
    }

    .footer-brand {
        margin-top: 12px;
        font-size: 15px;
        letter-spacing: 5px;
        font-weight: 900;
    }

    .footer-small {
        margin-top: 5px;
        font-size: 9px;
        letter-spacing: 3px;
        opacity: .8;
    }

    .open-event-btn {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);

        border: 0;
        background: #6bad3f;
        color: white;
        padding: 15px 28px;
        border-radius: 30px;
        font-size: 15px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 10px 30px rgba(242,11,112,.3);
    }


    /* =========================
       RESPONSIVE
    ========================== */

    @media(max-width: 1000px) {

        .event-hero {
            padding: 25px;
        }

        .hero-content {
            width: 75%;
        }

        .hero-tagline {
            display: none;
        }

        .intro-grid,
        .lower-grid,
        .bottom-grid {
            grid-template-columns: 1fr;
        }

        .race-grid {
            grid-template-columns: 1fr;
        }

        .overview-list {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 650px) {

        .event-modal {
            padding: 8px;
        }

        .event-modal-box {
            width: 100%;
            border-radius: 15px;
        }

        .event-content {
            padding: 20px 15px 25px;
        }

        .event-hero {
            min-height: 280px;
        }

        .hero-content {
            width: 100%;
        }

        .brand-text strong {
            font-size: 22px;
        }

        .hero-title {
            font-size: 36px;
        }

        .hero-year {
            font-size: 30px;
        }

        .runners {
            opacity: .25;
        }

        .entitlement-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .lower-grid {
            grid-template-columns: 1fr;
        }

        .bottom-grid {
            grid-template-columns: 1fr;
        }

        .section-title {
            font-size: 15px;
        }
    }
</style>
</head>

<body>


<!-- =========================
     OPEN BUTTON
========================== -->




<!-- =========================
     MODAL
========================== -->

<div class="event-modal" id="eventModal">

    <div class="event-modal-box">

        <button class="modal-close" onclick="closeEventModal()">
            ×
        </button>

        <div class="event-scroll">
            <section class="event-hero">
                <div class="hero-content">
                    <div class="brand">
                        
                        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="" style="height: 100px;">

                        
                    </div>
                    <div class="event-label">
                        EVENT DETAILS
                    </div>
                    <div class="presented">
                        Run BURJOWAN Proudly Presents
                    </div>
                    <div class="hero-title">
                        WINTER <span>HALF MARATHON</span>
                    </div>
                    <div class="hero-year">
                        2026
                    </div>
                </div>
                <div class="hero-tagline">
                    Same Roads<br>
                    New Dreams<br>
                    <span>Bigger Together</span>
                </div>
                <div class="runners">
                    <img src="<?php echo e(asset('img/event2.png')); ?>" alt="">
                </div>
            </section>
            <div class="event-content">
                <div class="intro-grid">
                    <div class="intro-text">
                        <p>
                            After a remarkable inaugural edition,
                            <strong>Run BURJOWAN</strong> returns for its
                            Second Edition, bringing together the passion,
                            energy, and determination of runners from
                            Sirajganj and beyond.
                        </p>
                        <p>
                            Set against the iconic backdrop of
                            <strong>Jamuna bridge</strong>, Winter Half Marathon
                            is more than a road race. It is a celebration of
                            <strong>endurance, ambition, community</strong>,
                            and the unbreakable connection between runners
                            and the natural environment of Jamuna.
                        </p>
                        <p>
                            From the ultimate
                            <span class="pink">21.5K</span> endurance challenge
                            to the <span class="pink">15K</span>,
                            <span class="pink">7.5K</span> Run, there is a
                            distance for every runner, every goal,
                            and every generation.
                        </p>

                    </div>
                    <div>
                        <div class="section-title">
                            <span class="section-icon">📅</span>
                            EVENT OVERVIEW
                        </div>
                        <div class="overview">
                            <div class="overview-list">

                                <div class="overview-item">
                                    <span class="icon">🏃</span>
                                    <b>Event</b>
                                    <span>:</span>
                                    <span>Winter Half Marathon 2026</span>
                                </div>

                                <div class="overview-item">
                                    <span class="icon">🏆</span>
                                    <b>Edition</b>
                                    <span>:</span>
                                    <span>December</span>
                                </div>

                                <div class="overview-item">
                                    <span class="icon">📅</span>
                                    <b>Date</b>
                                    <span>:</span>
                                    <span>18th December 2026</span>
                                </div>

                                <div class="overview-item">
                                    <span class="icon">📍</span>
                                    <b>Location</b>
                                    <span>  :</span>
                                    <span>T-Badh, Sirajganj</span>
                                </div>

                                <div class="overview-item">
                                    <span class="icon">🏁</span>
                                    <b>Event Type</b>
                                    <span>  :</span>
                                    <span>Live Road Race</span>
                                </div>

                                <div class="overview-item">
                                    <span class="icon">👥</span>
                                    <b>Organizer</b>
                                    <span>  :</span>
                                    <span>Run BURJOWAN</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- RACE CATEGORIES -->

                <section class="race-section">

                    <div class="section-title">
                        <span class="section-icon">🏃</span>
                        RACE CATEGORIES
                    </div>

                    <div class="race-grid">


                        <!-- 21.5K -->

                        <div class="race-card">

                            <div class="race-header">

                                <div>
                                    <div class="race-distance">21.5K</div>
                                    <div class="race-name">CHALLENGE</div>
                                </div>

                                <div class="race-runner-icon">
                                    🏃
                                </div>

                            </div>

                            <div class="race-body">

                                <h4>
                                    Where Grit Meets Glory.
                                </h4>

                                <p>
                                    Practice the half marathon and take on
                                    the next level of endurance. Designed for
                                    runners ready to push their limits,
                                    test their resilience, and earn every
                                    kilometre.
                                </p>

                                <div class="cutoff">
                                    Cut-Off Time:
                                    <strong>3 Hours 30 Minutes</strong>
                                </div>

                            </div>

                        </div>


                        <!-- 15K -->

                        <div class="race-card">

                            <div class="race-header">

                                <div>
                                    <div class="race-distance">15K</div>
                                    <div class="race-name">DASH</div>
                                </div>

                                <div class="race-runner-icon">
                                    🏃
                                </div>

                            </div>

                            <div class="race-body">

                                <h4>
                                    Where Speed Meets Stamina.
                                </h4>

                                <p>
                                    A perfect balance of distance, pace,
                                    and performance — ideal for runners
                                    looking for a focused and rewarding
                                    challenge.
                                </p>

                                <div class="cutoff">
                                    Cut-Off Time:
                                    <strong>2 Hours 30 Minutes</strong>
                                </div>

                            </div>

                        </div>


                        <!-- 7.5K -->

                        <div class="race-card">

                            <div class="race-header">

                                <div>
                                    <div class="race-distance">7.5K</div>
                                    <div class="race-name">RUN</div>
                                </div>

                                <div class="race-runner-icon">
                                    🏃
                                </div>

                            </div>

                            <div class="race-body">

                                <h4>
                                    Chase It. Conquer It.
                                </h4>

                                <p>
                                    A welcoming distance for new runners
                                    and experienced participants alike.
                                    Run, jog, or walk — this is your
                                    opportunity to be part of the race.
                                </p>

                                <div class="cutoff">
                                    Cut-Off Time:
                                    <strong>90 Minutes</strong>
                                </div>

                            </div>

                        </div>

                    </div>

                </section>


                <!-- LOWER SECTION -->

                <div class="lower-grid">


                    <!-- RUNNER ENTITLEMENTS -->

                    <div class="panel">

                        <div class="section-title">
                            <span class="section-icon">🎁</span>
                            RUNNER ENTITLEMENTS
                        </div>

                        <div class="entitlement-grid">

                            <div class="entitlement">
                                <div class="entitlement-icon">🎪</div>
                                Race Expo<br>Access
                            </div>

                            <div class="entitlement">
                                <div class="entitlement-icon">👕</div>
                                Run BURJOWAN<br>Race T-Shirt
                            </div>

                            <div class="entitlement">
                                <div class="entitlement-icon">🎟️</div>
                                Race Bib
                            </div>

                            <div class="entitlement">
                                <div class="entitlement-icon">🏅</div>
                                Imported<br>Finisher Medal
                            </div>

                            <div class="entitlement">
                                <div class="entitlement-icon">🙏</div>
                                Dedicated<br>Prayer Zone
                            </div>

                            <div class="entitlement">
                                <div class="entitlement-icon">💧</div>
                                On-Course Hydration
                                & Support
                            </div>

                            <div class="entitlement">
                                <div class="entitlement-icon">✚</div>
                                Medical & First
                                Aid Support
                            </div>

                            <div class="entitlement">
                                <div class="entitlement-icon">🥤</div>
                                Post-Race
                                Refreshment Pack
                            </div>

                            <div class="entitlement">
                                <div class="entitlement-icon">📜</div>
                                Digital Finisher
                                Certificate
                            </div>

                        </div>

                    </div>


                    <!-- AWARDS -->

                    <div class="panel">

                        <div class="section-title">
                            <span class="section-icon">🏆</span>
                            AWARDS & RECOGNITION
                        </div>

                        <div class="award-intro">
                            <strong>
                                <span class="pink">21.5K, 15K & 7.5K</span>
                            </strong>
                            <br>
                            Top three finishers will be awarded prize money
                            and commemorative crests.
                        </div>

                        <table class="award-table">

                            <thead>

                                <tr>
                                    <th>21.5K</th>
                                    <th>15K</th>
                                    <th>7.5K</th>
                                </tr>

                            </thead>

                            <tbody>

                                <tr>
                                    <td>Champion<br>10,000 BDT</td>
                                    <td>Champion<br>8,000 BDT</td>
                                    <td>Champion<br>5,000 BDT</td>
                                </tr>

                                <tr>
                                    <td>1st Runner Up<br>7,000 BDT</td>
                                    <td>1st Runner Up<br>5,000 BDT</td>
                                    <td>1st Runner Up<br>4,000 BDT</td>
                                </tr>

                                <tr>
                                    <td>2nd Runner Up<br>5,000 BDT</td>
                                    <td>2nd Runner Up<br>4,000 BDT</td>
                                    <td>2nd Runner Up<br>3,000 BDT</td>
                                </tr>

                            </tbody>

                        </table>

                        <div class="notes">

                            <strong>Important Notes:</strong>

                            <br>• Podium positions will be determined
                            based on Gun Time.

                            <br>• This event is exclusively for amateur
                            runners. Professional athletes are not eligible
                            for awards.

                        </div>

                    </div>

                </div>


                <!-- SCHEDULE + RULES -->

                <div class="bottom-grid">


                    <!-- SCHEDULE -->

                    <div class="schedule">

                        <div class="section-title">
                            <span class="section-icon">📅</span>
                            RACE DAY SCHEDULE
                        </div>

                        <div class="tba">
                            🕐 TBA
                        </div>

                    </div>


                    <!-- RULES -->

                    <div class="rules">

                        <div class="section-title">
                            <span class="section-icon">📋</span>
                            RULES & GUIDELINES
                        </div>

                        <ul>

                            <li>
                                Pre-registration is mandatory.
                                No on-spot registration will be permitted.
                            </li>

                            <li>
                                Bibs are strictly non-transferable.
                                Running under another participant's Bib
                                will result in disqualification.
                            </li>

                            <li>
                                Finisher medals will be awarded only to
                                participants who complete their respective
                                races within the official cut-off time.
                            </li>

                            <li>
                                No refunds or category changes will be
                                permitted once registration is confirmed.
                            </li>

                            <li>
                                Organizers reserve the right to modify
                                the race schedule, course, or event logistics
                                in case of adverse weather conditions or
                                safety concerns.
                            </li>

                        </ul>

                    </div>

                </div>


                <!-- FOOTER -->

                <div class="event-footer">

                    <div class="footer-main">
                        More Than a Race,
                        <span>It's a Movement.</span>
                    </div>

                    <div class="footer-brand">
                        RUN BURJOWAN
                    </div>

                    <div class="footer-small">
                        MORE THAN A RACE • A COMMUNITY
                    </div>

                </div>


            </div>

        </div>

    </div>

</div>
<script>
    document.querySelectorAll('.ev-category-grid .ev-cat-btn:not([disabled])').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.ev-category-grid .ev-cat-btn').forEach(btn => {
                btn.classList.remove('ev-cat-active');
            });
            this.classList.add('ev-cat-active');
        });
    });
</script>
<script>
    const pastTrack = document.querySelector('.unique-past-grid');

    function runContinuousSlide() {
        const firstCard = pastTrack.querySelector('.unique-past-card');
        if (!firstCard) return;

        const cardWidth = firstCard.getBoundingClientRect().width;
        const gap = 20;

        pastTrack.style.transition = 'transform 0.5s ease-in-out';
        pastTrack.style.transform = `translateX(-${cardWidth + gap}px)`;

        setTimeout(() => {
            pastTrack.style.transition = 'none';
            pastTrack.appendChild(firstCard);
            pastTrack.style.transform = 'translateX(0px)';
        }, 500);
    }

    let continuousTimer = setInterval(runContinuousSlide, 3000);
</script>
<script>

    const eventModal = document.getElementById("eventModal");

    function openEventModal() {
        eventModal.classList.add("active");
        document.body.style.overflow = "hidden";
    }

    function closeEventModal() {
        eventModal.classList.remove("active");
        document.body.style.overflow = "";
    }


    /* Close when clicking outside */

    eventModal.addEventListener("click", function(e) {

        if (e.target === eventModal) {
            closeEventModal();
        }

    });


    /* ESC key */

    document.addEventListener("keydown", function(e) {

        if (e.key === "Escape") {
            closeEventModal();
        }

    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\run-event\resources\views/event.blade.php ENDPATH**/ ?>