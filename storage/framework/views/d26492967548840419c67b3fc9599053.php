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

    <div class="ev-section-header">
        <div>
            <span class="ev-section-tag">UPCOMING EVENT</span>
            <h2 class="ev-section-title">Winter Half Marathon 2026</h2>
            <p class="ev-sub-text">Run through the city of dreams!</p>
        </div>
        <a href="#" class="ev-view-all-link">View All Upcoming <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <div class="ev-main-event-card">
        <div class="ev-event-left-box">
            <div class="ev-event-img-wrap">
                <img src="<?php echo e(asset('img/dhakarun.jpeg')); ?>" alt="Sirajganj City Marathon">
                <div class="ev-date-badge">
                    <span class="ev-day">18</span>
                    <span class="ev-month">DEC</span>
                    <span class="ev-year">2026</span>
                </div>
            </div>

            <div class="ev-meta-grid">
                <div class="ev-meta-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <div><strong>Location</strong><br><small>Hard Point, Sirajgang</small></div>
                </div>
                <div class="ev-meta-item">
                    <i class="fa-solid fa-route"></i>
                    <div><strong>Distance</strong><br><small>7.5K / 15K / 21.5K </small></div>
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
                <h3 class="ev-total-price">BDT 500</h3>
            </div>

            <a href="#" class="ev-btn-proceed  proceedRegistrationBtn">Proceed to Registration <i class="fa-solid fa-arrow-right"></i></a>

            <div class="ev-payment-brands">
                <!--<span><img src="<?php echo e(asset('img/visa.webp')); ?>" alt="Visa"></span>-->
                
                <!--<span><img src="<?php echo e(asset('img/nagod.png')); ?>" alt="Nagad"></span>-->
            </div>
        </div>
    </div>

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
                    <p class="ev-past-info"><i class="fa-solid fa-route"></i> 7.5K | 15K | 21.5K</p>
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
                    <p class="ev-past-info"><i class="fa-solid fa-route"></i> 7.5K | 15K | 21.5K</p>
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
                    <p class="ev-past-info"><i class="fa-solid fa-route"></i> 7.5K | 15K | 21.5K</p>
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
                    <p class="ev-past-info"><i class="fa-solid fa-route"></i> 7.5K | 15K | 21.5K</p>
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
                    <p class="ev-past-info"><i class="fa-solid fa-route"></i> 7.5K | 15K | 21.5K</p>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\run-event\resources\views/event.blade.php ENDPATH**/ ?>