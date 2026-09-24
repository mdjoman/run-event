<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<style>
.unique-slider-wrap {
    width: 100% !important;
    overflow: hidden !important;
    box-sizing: border-box !important;
}

.unique-track {
    display: flex !important;
    gap: 20px !important;
    width: max-content !important;
}

.unique-card {
    width: 300px !important;
    min-width: 300px !important;
    flex: 0 0 300px !important;
    box-sizing: border-box !important;
}

@media (max-width: 768px) {
    .unique-slider-wrap {
        padding: 0 15px !important;
    }
    .unique-track {
        gap: 15px !important;
    }
    .unique-card {
        width: calc(100vw - 50px) !important;
        min-width: calc(100vw - 50px) !important;
        flex: 0 0 calc(100vw - 50px) !important;
    }
}
    /* ====================Number========================= */
    .stats-section {
    width: 100%;
    overflow: hidden;
}

.stats-grid {
    display: flex !important;
    gap: 20px;
    transition: transform 0.5s ease-in-out;
    width: 100%;
}

.stat-card {
    min-width: 100% !important;
    flex: 0 0 100% !important;
    box-sizing: border-box;
}

@media (min-width: 769px) {
    .stats-grid {
        display: grid !important;
        grid-template-columns: repeat(4, 1fr) !important;
        transform: none !important;
    }
    .stat-card {
        min-width: auto !important;
        flex: unset !important;
    }
}
</style>
<?php $__env->startSection('body'); ?>
    <section class="hero">
        <div class="container hero-content">
            <div class="hero-subtitle">RUNNING <span> COMMUNITY</span> & EVENTS</div>
            <h1 class="hero-title">RUN. RISE.<span class="highlight">REPEAT.</span></h1>
            <p class="hero-description">
                Discover running events, register online,<br>
                track your journey and be part of the community.
            </p>
            <div class="hero-btns">
                <a href="#" class="btn-primary btn-arrow">Explore Events <i class="fa-solid fa-arrow-right"></i></a>
                <a href="#" class="btn-outline proceedRegistrationBtn">Register Now <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="container filter-container">
            <div class="filter-box">
                <div class="filter-item">
                    <i class="fa-regular fa-calendar-check filter-icon"></i>
                    <div>
                        <label>Event</label>
                        <select>
                            <option>Select event</option>
                            <option>Winter Half Marathon 2026</option>
                            <option>Winter Half Marathon 2026</option>
                        </select>
                    </div>
                </div>
                <div class="filter-item">
                    <i class="fa-solid fa-location-dot filter-icon"></i>
                    <div>
                        <label>Location</label>
                        <select>
                            <option>Select location</option>
                            <option>Hard Point, Sirajgang</option>
                        </select>
                    </div>
                </div>
                <div class="filter-item">
                    <i class="fa-regular fa-calendar filter-icon"></i>
                    <div>
                        <label for="event-date">Date</label>
                        <input type="text" id="event-date" name="event_date" placeholder="DD/MM/YYYY" class="custom-date-input">
                    </div>
                </div>
                <button class="btn-search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-regular fa-calendar-alt"></i></div>
                <div class="stat-info">
                    <span class="stat-title">Upcoming Events</span>
                    <h3>12+</h3>
                    <p>Races this year</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                <div class="stat-info">
                    <span class="stat-title">Registered Runners</span>
                    <h3>8,500+</h3>
                    <p>Be part of our community</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-trophy"></i></div>
                <div class="stat-info">
                    <span class="stat-title">Successful Races</span>
                    <h3>30+</h3>
                    <p>Memorable events</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-user-group"></i></div>
                <div class="stat-info">
                    <span class="stat-title">Community Members</span>
                    <h3>5,000+</h3>
                    <p>Run. Connect. Grow.</p>
                </div>
            </div>
        </div>
    </section>

<section class="events-section">
    <div class="container">
        <div class="flex items-end gap-5 w-full mb-6">
            <div class="flex flex-col">
                <span class="text-[15px] font-bold text-[#7bb526] tracking-wider uppercase mb-1">FEATURED EVENTS</span>
                <h2 class="section-title">Upcoming Running Events</h2>
            </div>
            <a href="#" class="text-xs font-bold text-[#031b33] whitespace-nowrap flex items-center gap-1.5 pb-2">
                View All Events <i class="fa-solid fa-arrow-right"></i>
            </a>
            <div class="flex-grow h-[1px] bg-[#e2e8f0] mb-3"></div>
        </div>

        <div class="unique-slider-wrap" style="display: flex; gap: 20px; align-items: center; overflow: hidden;">
            <div class="unique-card" style="flex-shrink: 0;">
                <div class="event-img">
                    <img src="<?php echo e(asset('img/ur1.jpeg')); ?>" alt="Event">
                    <div class="date-badge">
                        <span class="day">18</span>
                        <span class="month">Dec</span>
                        <span class="year">2026</span>
                    </div>
                </div>
                <div class="event-content">
                    <h3>Winter Half Marathon 2026</h3>
                    <p class="location"><i class="fa-solid fa-location-dot"></i> Hard Point, Sirajganj</p>
                    <div class="tags">
                        <span>7.5K</span>
                        <span>15K</span>
                        <span>21.5K</span>
                        <span>30K</span>
                    </div>
                    <p class="price"><i class="fa-solid fa-ticket"></i> Registration Fee: TK 500</p>
                    <a href="#" class="btn-primary full-width proceedRegistrationBtn">Register Now <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div style="overflow: hidden; width: 100%;">
                <div class="unique-track" style="display: flex; gap: 20px; width: max-content;">
                    <div class="unique-card" style="flex-shrink: 0;">
                        <div class="event-img">
                            <img src="<?php echo e(asset('img/ur2.jpeg')); ?>" alt="Event">
                            <div class="date-badge">
                                <span class="day">18</span>
                                <span class="month">Dec</span>
                                <span class="year">2026</span>
                            </div>
                        </div>
                        <div class="event-content">
                            <h3>Winter Half Marathon 2026</h3>
                            <p class="location"><i class="fa-solid fa-location-dot"></i> Hard Point, Sirajganj</p>
                            <div class="tags">
                                <span>7.5K</span>
                                <span>15K</span>
                                <span>21.5K</span>
                                <span>30K</span>
                            </div>
                            <p class="price"><i class="fa-solid fa-ticket"></i> Registration Fee: TK 500</p>
                            
                        </div>
                    </div>

                    <!-- Event Card 3 -->
                    <div class="unique-card" style="flex-shrink: 0;">
                        <div class="event-img">
                            <img src="<?php echo e(asset('img/ur3.jpeg')); ?>" alt="Event">
                            <div class="date-badge">
                                <span class="day">18</span>
                                <span class="month">Dec</span>
                                <span class="year">2026</span>
                            </div>
                        </div>
                        <div class="event-content">
                            <h3>Winter Half Marathon 2026</h3>
                            <p class="location"><i class="fa-solid fa-location-dot"></i> Hard Point, Sirajganj</p>
                            <div class="tags">
                                <span>7.5K</span>
                                <span>15K</span>
                                <span>21.5K</span>
                                <span>30K</span>
                            </div>
                            <p class="price"><i class="fa-solid fa-ticket"></i> Registration Fee: TK 500</p>
                            
                        </div>
                    </div>

                    <!-- Event Card 4 -->
                    <div class="unique-card" style="flex-shrink: 0;">
                        <div class="event-img">
                            <img src="<?php echo e(asset('img/ur4.jpeg')); ?>" alt="Event">
                            <div class="date-badge">
                                <span class="day">18</span>
                                <span class="month">Dec</span>
                                <span class="year">2026</span>
                            </div>
                        </div>
                        <div class="event-content">
                            <h3>Winter Half Marathon 2026</h3>
                            <p class="location"><i class="fa-solid fa-location-dot"></i> Hard Point, Sirajganj</p>
                            <div class="tags">
                                <span>7.5K</span>
                                <span>15K</span>
                                <span>21.5K</span>
                                <span>30K</span>
                            </div>
                            <p class="price"><i class="fa-solid fa-ticket"></i> Registration Fee: TK 500</p>
                            
                        </div>
                    </div>

                    <!-- Event Card 5 -->
                    <div class="unique-card" style="flex-shrink: 0;">
                        <div class="event-img">
                            <img src="<?php echo e(asset('img/ur5.jpeg')); ?>" alt="Event">
                            <div class="date-badge">
                                <span class="day">18</span>
                                <span class="month">Dec</span>
                                <span class="year">2026</span>
                            </div>
                        </div>
                        <div class="event-content">
                            <h3>Winter Half Marathon 2026</h3>
                            <p class="location"><i class="fa-solid fa-location-dot"></i> Hard Point, Sirajganj</p>
                            <div class="tags">
                                <span>7.5K</span>
                                <span>15K</span>
                                <span>21.5K</span>
                                <span>30K</span>
                            </div>
                            <p class="price"><i class="fa-solid fa-ticket"></i> Registration Fee: TK 500</p>
                            
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

    <section class="features-section">
        <div class="container features-grid">
            <div class="features-header">
                <span class="sub-heading">WHY RUN BURJOWAN?</span>
                <h2>Your Running Journey,<br>Our Commitment</h2>
            </div>
            <div class="features-boxes">
                <div class="feature-box">
                    <div class="f-icon"><i class="fa-regular fa-id-card"></i></div>
                    <h4>Easy Online Registration</h4>
                    <p>Quick and simple in just a few clicks.</p>
                </div>
                <div class="feature-box">
                    <div class="f-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <h4>Secure Payment</h4>
                    <p>Multiple payment options for your convenience.</p>
                </div>
                <div class="feature-box">
                    <div class="f-icon"><i class="fa-solid fa-ticket"></i></div>
                    <h4>Digital Race Confirmation</h4>
                    <p>Get your e-ticket instantly.</p>
                </div>
                <div class="feature-box">
                    <div class="f-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <h4>Results & Runner Tracking</h4>
                    <p>Track your performance and progress.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="steps-section">
        <div class="container">
            <span class="sub-heading">HOW IT WORKS</span>
            <h2 class="section-title">Simple Steps to Get Started</h2>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-icon pink-bg"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <div class="step-text">
                        <span>01</span>
                        <h4>Discover Event</h4>
                        <p>Find the perfect race for you.</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-icon blue-bg"><i class="fa-solid fa-user"></i></div>
                    <div class="step-text">
                        <span>02</span>
                        <h4>Register</h4>
                        <p>Complete your registration and payment.</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-icon purple-bg"><i class="fa-solid fa-person-running"></i></div>
                    <div class="step-text">
                        <span>03</span>
                        <h4>Run</h4>
                        <p>Hit the road and give your best.</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-icon magenta-bg"><i class="fa-solid fa-medal"></i></div>
                    <div class="step-text">
                        <span>04</span>
                        <h4>Get Results/Medal</h4>
                        <p>View your results and earn your medal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="banner-section" style="background-image: url('<?php echo e(asset('img/home2.jpg')); ?>');">
        <div class="brush-overlay-left"></div>
        <div class="banner-overlay-slanted"></div>

        <div class="container">
            <div class="banner-content-wrapper">
                <div class="banner-content-right">
                    <span class="sub-heading-join">JOIN <span class="pink-text">THE MOVEMENT</span></span>
                    <h2 class="banner-title">More Than a Run —<br>It's a Community</h2>
                    <p class="banner-desc">
                        Meet like-minded people, make new friends,<br>
                        share your journey and be part of something bigger.
                    </p>
                    <a href="#" class="btn-join-movement">
                        Join the Community <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="partners-section">
        <div class="container">
            <span class="sub-heading center">OUR PARTNERS & SPONSORS</span>
            <div class="partners-logos">
                <div class="logo-item"><i class="fa-solid fa-mountain"></i> BRAND LOGO</div>
                <div class="logo-item"><i class="fa-solid fa-leaf"></i> YOUR LOGO</div>
                <div class="logo-item"><i class="fa-solid fa-cube"></i> COMPANY</div>
                <div class="logo-item"><i class="fa-solid fa-gem"></i> SPONSOR</div>
                <div class="logo-item"><i class="fa-solid fa-paper-plane"></i> PARTNER</div>
                <div class="logo-item"><i class="fa-solid fa-infinity"></i> LOGO HERE</div>
            </div>
        </div>
    </section>

    <section class="gallery-section">
        <div class="container">
            <div class="section-header">
                <div>
                    <span class="sub-heading">RUNNING MOMENTS</span>
                    <h2 class="section-title">Gallery</h2>
                </div>
                <a href="#" class="view-all">View All Photos <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="gallery-grid">
                <img src="<?php echo e(asset('img/ur1.jpeg')); ?>" alt="Gallery Image 1">
                <img src="<?php echo e(asset('img/ur2.jpeg')); ?>" alt="Gallery Image 2">
                <img src="<?php echo e(asset('img/ur3.jpeg')); ?>" alt="Gallery Image 3">
                <img src="<?php echo e(asset('img/ur4.jpeg')); ?>" alt="Gallery Image 4">
                <img src="<?php echo e(asset('img/ur5.jpeg')); ?>" alt="Gallery Image 5">
            </div>
        </div>
    </section>
<script>
const uniqueTrack = document.querySelector('.unique-track');
let uniqueTimer;

function runUniqueSlide() {
    const uniqueCards = uniqueTrack.querySelectorAll('.unique-card');
    if (uniqueCards.length === 0) return;

    const firstCard = uniqueCards[0];
    const cardWidth = firstCard.getBoundingClientRect().width;
    const style = window.getComputedStyle(uniqueTrack);
    const gap = parseFloat(style.gap) || 20;
    const moveAmount = cardWidth + gap;

    uniqueTrack.style.transition = 'transform 0.5s ease-in-out';
    uniqueTrack.style.transform = `translateX(-${moveAmount}px)`;

    setTimeout(() => {
        uniqueTrack.style.transition = 'none';
        uniqueTrack.appendChild(firstCard);
        uniqueTrack.style.transform = 'translateX(0px)';
    }, 500);
}

function startUniqueTimer() {
    uniqueTimer = setInterval(runUniqueSlide, 3000);
}

startUniqueTimer();

uniqueTrack.addEventListener('mouseenter', () => clearInterval(uniqueTimer));
uniqueTrack.addEventListener('mouseleave', () => startUniqueTimer());

window.addEventListener('resize', () => {
    clearInterval(uniqueTimer);
    uniqueTrack.style.transition = 'none';
    uniqueTrack.style.transform = `translateX(0px)`;
    startUniqueTimer();
});
    /*==================================================================
    =================================================================*/
    const statsGrid = document.querySelector('.stats-grid');
    const statCards = document.querySelectorAll('.stat-card');
    let statIndex = 0;
    let statTimer;

    function runStatsSlide() {
        if (window.innerWidth <= 768) {
            statIndex++;
            if (statIndex >= statCards.length) {
                statIndex = 0;
            }
            const cardWidth = statCards[0].getBoundingClientRect().width;
            const gap = 20;
            const moveAmount = statIndex * (cardWidth + gap);
            statsGrid.style.transform = `translateX(-${moveAmount}px)`;
        } else {
            statsGrid.style.transform = `translateX(0px)`;
        }
    }

    function startStatsTimer() {
        statTimer = setInterval(runStatsSlide, 3000);
    }

    startStatsTimer();

    window.addEventListener('resize', () => {
        clearInterval(statTimer);
        statIndex = 0;
        statsGrid.style.transform = `translateX(0px)`;
        startStatsTimer();
    });

    const counters = document.querySelectorAll('.stat-card h3');
    counters.forEach(counter => {
        const targetText = counter.innerText;
        const hasPlus = targetText.includes('+');
        const hasComma = targetText.includes(',');
        const target = parseInt(targetText.replace(/[^0-9]/g, ''));

        let current = 0;
        const increment = target / 40;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                let displayed = Math.ceil(current);
                if (hasComma) {
                    displayed = displayed.toLocaleString();
                }
                counter.innerText = displayed + (hasPlus ? '+' : '');
                setTimeout(updateCounter, 30);
            } else {
                counter.innerText = targetText;
            }
        };
        updateCounter();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\run-event\resources\views/index.blade.php ENDPATH**/ ?>