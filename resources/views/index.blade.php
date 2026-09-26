@extends('master')
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
     .action-buttons {
        flex-direction: column;
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


.action-buttons {
    display: flex;
    gap: 10px;
    margin-top: 12px;
}

.action-buttons .btn-primary {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 5px 14px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    color: #fff;
    white-space: nowrap;
    transition: 0.2s ease;
    border: none;
    cursor: pointer;
}

.action-buttons .shareBtn {
    background: #1877f2;
}

.action-buttons .shareBtn:hover {
    background: #0f5ecb;
}

.action-buttons .proceedRegistrationBtn {
    background: #6bad3f;
}

.action-buttons .proceedRegistrationBtn:hover {
    background: #58d803;
}
</style>
@section('body')
    <section class="hero">
        <div class="container hero-content">
            <div class="hero-subtitle">RUNNING <span> COMMUNITY</span> and EVENTS</div>
            <h1 class="hero-title">RUN. RISE.<span class="highlight">REPEAT.</span></h1>
            <p class="hero-description">
                Discover running events, register online,<br>
                track your journey and be part of the community.
            </p>
            <div class="hero-btns">
                <a href="#" class="btn-primary btn-arrow">Explore Events <i class="fa-solid fa-arrow-right"></i></a>
                @if ($active_event)
                    <a href="#" class="btn-outline proceedRegistrationBtn"
                    data-title="{{ $active_event->title }}"
                    data-price="{{ $active_event->fee }}"
                    data-event_id="{{ $active_event->id }}">Register Now <i class="fa-solid fa-arrow-right"></i></a>
                @endif

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
                    <h3>1+</h3>
                    <p>Races this year</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                <div class="stat-info">
                    <span class="stat-title">Registered Runners</span>
                    <h3>12+</h3>
                    <p>Be part of our community</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-trophy"></i></div>
                <div class="stat-info">
                    <span class="stat-title">Successful Races</span>
                    <h3>1+</h3>
                    <p>Memorable events</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-user-group"></i></div>
                <div class="stat-info">
                    <span class="stat-title">Community Members</span>
                    <h3>52+</h3>
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
                @if ($active_event)
                    <div class="unique-card" style="flex-shrink: 0;">
                        <div class="event-img" style="padding-top: 3px; position: relative;">
                            {{-- Active Event Image Click --}}
                            <img src="{{ asset($active_event->image) }}" alt="Event" onclick="openIndexModal()" style="cursor: pointer; height: 197px; width: 100%; object-fit: cover;">

                            {{-- Image er dane niche "Event Details" Button --}}
                            <button type="button" onclick="openIndexModal()" style="position: absolute; bottom: 12px; right: 12px; background: #4f9770bf; color: #ffffff; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 5px; backdrop-filter: blur(4px);">
                                <i class="fa-solid fa-circle-info"></i> Event Details
                            </button>

                            <div class="date-badge">
                                <span class="day">{{ date('d', strtotime($active_event->event_date)) }}</span>
                                <span class="month">{{ date('M', strtotime($active_event->event_date)) }}</span>
                                <span class="year">{{ date('Y', strtotime($active_event->event_date)) }}</span>
                            </div>
                        </div>
                        <div class="event-content">
                            <h3 onclick="openIndexModal()" style="cursor: pointer;">{{ $active_event->title }}</h3>
                            <p class="location"><i class="fa-solid fa-location-dot"></i> {{ $active_event->location }}</p>
                            <div class="tags">
                                <span>{{ $active_event->category }}</span>
                            </div>
                            <p class="price"><i class="fa-solid fa-ticket"></i> Registration Fee: TK {{ $active_event->fee }}</p>
                            @if($active_event->status == 'active')
                                <div class="action-buttons" style="display: flex; gap: 10px; width: 100%;">
                                    {{-- Share Button --}}
                                    <a href="javascript:void(0)" class="btn-primary shareBtn" style="flex: 1; flex-basis: 0; text-align: center; justify-content: center; box-sizing: border-box; white-space: nowrap;" data-url="{{ route('form', $active_event->id) }}" data-title="{{ $active_event->title }}">
                                        Share <i class="fa-solid fa-share-nodes"></i>
                                    </a>

                                    {{-- Register Button --}}
                                    <a href="#" class="btn-primary proceedRegistrationBtn" style="flex: 1; flex-basis: 0; text-align: center; justify-content: center; box-sizing: border-box; white-space: nowrap;" data-title="{{ $active_event->title }}" data-price="{{ $active_event->fee }}" data-event_id="{{ $active_event->id }}">
                                        Register Now <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <div style="overflow: hidden; width: 100%;">
                    <div class="unique-track" style="display: flex; gap: 20px; width: max-content;">
                        @foreach ($events as $event)
                        <div class="unique-card" style="flex-shrink: 0;">
                            <div class="event-img">
                                {{-- Loop Event Image Click (Optional: openIndexModal add kora holo) --}}
                                <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" onclick="openIndexModal()" style="cursor: pointer;">
                                <div class="date-badge">
                                    <span class="day">{{ date('d', strtotime($event->event_date)) }}</span>
                                    <span class="month">{{ date('M', strtotime($event->event_date)) }}</span>
                                    <span class="year">{{ date('Y', strtotime($event->event_date)) }}</span>
                                </div>
                            </div>
                            <div class="event-content">
                                <h3 onclick="openIndexModal()" style="cursor: pointer;">{{ $event->title }}</h3>
                                <p class="location"><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</p>
                                <div class="tags">
                                    <span>{{ $event->category }}</span>
                                </div>
                                <p class="price"><i class="fa-solid fa-ticket"></i> Registration Fee: TK {{ $event->fee }}</p>
                                <p></p>
                                <br>
                            </div>
                        </div>
                        @endforeach
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
                    <h4>Results and Runner Tracking</h4>
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

    <section class="banner-section" style="background-image: url('{{ asset('img/home2.jpg') }}');">
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
            <span class="sub-heading center">OUR PARTNERS and SPONSORS</span>
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
            <div class="flex items-end gap-5 w-full mb-6">
                <div class="flex flex-col">
                    <span class="text-[15px] font-bold text-[#7bb526] tracking-wider uppercase mb-1">RUNNING MOMENTS</span>
                    <h2 class="section-title">Gallery</h2>
                </div>
                <a href="#" class="text-xs font-bold text-[#031b33] whitespace-nowrap flex items-center gap-1.5 pb-2">
                    View All Photos <i class="fa-solid fa-arrow-right"></i>
                </a>
                <div class="flex-grow h-[1px] bg-[#e2e8f0] mb-3"></div>
            </div>

            <div class="gallery-grid">
                <img src="{{asset('img/ur1.jpeg')}}" alt="Gallery Image 1">
                <img src="{{asset('img/ur2.jpeg')}}" alt="Gallery Image 2">
                <img src="{{asset('img/ur3.jpeg')}}" alt="Gallery Image 3">
                <img src="{{asset('img/ur4.jpeg')}}" alt="Gallery Image 4">
                <img src="{{asset('img/ur5.jpeg')}}" alt="Gallery Image 5">
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
    {{-- ==========================Event details================== --}}
    <style>
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
            min-height: auto !important;
            padding: 22px 40px !important;
            position: relative;
            overflow: hidden;
            background: linear-gradient(90deg, rgba(255,255,255,.98) 0%, rgba(255,255,255,.88) 34%, rgba(255,255,255,.10) 72%, rgba(255,255,255,0) 100%), linear-gradient(180deg, #a9dcff 0%, #f9d49c 62%, #b5d6d7 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            width: 100% !important;
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

        #indexEventModal .hero-title {
            display: inline-block;
            background: #102f59;
            color: white;
            padding: 6px 18px;
            font-size: clamp(20px, 2.5vw, 42px) !important;
            line-height: 1.1;
            font-weight: 950;
            letter-spacing: -1px;
        }

        #indexEventModal .hero-title span {
            color: #6bad3f;
            display: inline;
        }

        #indexEventModal .hero-tagline {
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

        #indexEventModal .hero-tagline span {
            color: #6bad3f;
        }

        /* RUNNERS */
        #indexEventModal .runners {
            position: absolute;
            right: 50px;
            bottom: 0 !important;
            display: flex;
            align-items: flex-end;
            z-index: 3;
        }

        .runners img {
            max-height: 240px;
            width: auto;
            display: block;
            margin-bottom: 0;
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

        #indexEventModal .section-title {
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

        #indexEventModal .section-icon {
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

        #indexEventModal .overview {
            background: linear-gradient(135deg, #eef8ff, #e5f2fc);
            border: 1px solid #d4e7f5;
            border-radius: 18px;
            padding: 18px 22px;
            position: relative;
        }

        #indexEventModal .overview-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 25px;
        }

        #indexEventModal .overview-item {
            display: grid;
            grid-template-columns: 28px 75px 10px 1fr;
            align-items: center;
            font-size: 13px;
            color: #17365f;
        }

        #indexEventModal .overview-item .icon {
            font-size: 17px;
        }

        #indexEventModal .overview-item b {
            font-weight: 800;
        }

        #indexEventModal .race-section {
            margin-bottom: 28px;
        }

        #indexEventModal .race-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        #indexEventModal .race-card {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #d8e4ef;
            background: white;
            box-shadow: 0 5px 18px rgba(18,50,90,.08);
        }

        #indexEventModal .race-header {
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
            background: linear-gradient(rgba(238,248,255,.94), rgba(238,248,255,.94)), linear-gradient(120deg,#8fc4e5,#fff);
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

        /* ================= RESPONSIVE MEDIA QUERIES ================= */

        /* ================= RESPONSIVE ================= */

        /* TABLET */
        @media (max-width: 1100px) {

            .event-modal {
                padding: 15px;
            }

            .event-modal-box {
                width: 98vw;
                max-height: 96vh;
            }

            .event-hero {
                padding: 25px 30px !important;
            }

            .hero-tagline {
                right: 30px;
                width: 150px;
                font-size: 17px;
            }

            .runners {
                right: 20px;
            }

            .runners img {
                max-height: 210px;
            }

            .intro-grid {
                grid-template-columns: 1fr;
            }

            .lower-grid {
                grid-template-columns: 1fr;
            }

            .bottom-grid {
                grid-template-columns: 1fr;
            }

            .race-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .entitlement-grid {
                grid-template-columns: repeat(5, 1fr);
            }
        }


        /* ================= TABLET / SMALL LAPTOP ================= */
        @media (max-width: 800px) {

            .event-modal {
                padding: 10px;
            }

            .event-modal-box {
                width: 100%;
                max-height: 97vh;
                border-radius: 18px;
            }

            .event-scroll {
                max-height: 97vh;
            }

            /* HERO */
            .event-hero {
                min-height: 230px !important;
                padding: 22px 22px !important;
                display: block;
            }

            .brand {
                margin-bottom: 18px;
            }

            .brand-runner {
                font-size: 38px;
            }

            .brand-text strong {
                font-size: 23px;
            }

            .brand-text span {
                font-size: 9px;
                letter-spacing: 2px;
            }

            .event-label {
                font-size: 11px;
                padding: 7px 15px;
            }

            .presented {
                font-size: 14px;
            }

            .hero-title {
                font-size: 27px !important;
                line-height: 1.15;
                max-width: 75%;
            }

            .hero-tagline {
                display: none;
            }

            .runners {
                right: 10px;
                bottom: 0 !important;
            }

            .runners img {
                max-height: 190px;
            }

            /* CONTENT */
            .event-content {
                padding: 25px 22px 30px;
            }

            .intro-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .overview-list {
                grid-template-columns: 1fr 1fr;
            }

            /* RACE */
            .race-grid {
                grid-template-columns: 1fr 1fr;
                gap: 14px;
            }

            .race-header {
                min-height: 70px;
                padding: 10px 14px;
            }

            .race-distance {
                font-size: 29px;
            }

            .race-name {
                font-size: 13px;
            }

            .race-runner-icon {
                font-size: 38px;
            }

            /* LOWER */
            .lower-grid,
            .bottom-grid {
                grid-template-columns: 1fr;
            }

            .entitlement-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .event-footer {
                padding: 25px 20px;
                text-align: center;
            }

            .footer-main {
                font-size: 20px;
            }
        }


        /* ================= MOBILE ================= */
        @media (max-width: 600px) {

            html,
            body {
                overflow-x: hidden;
            }

            .event-modal {
                padding: 6px;
                align-items: center;
            }

            .event-modal-box {
                width: 100%;
                max-height: 98vh;
                border-radius: 14px;
            }

            .event-scroll {
                max-height: 98vh;
            }

            /* CLOSE BUTTON */
            .modal-close {
                top: 10px;
                right: 10px;
                width: 36px;
                height: 36px;
                font-size: 21px;
            }


            /* ================= HERO ================= */

            .event-hero {
                min-height: 245px !important;
                padding: 18px 15px !important;

                background:
                    linear-gradient(
                        90deg,
                        rgba(255,255,255,.98) 0%,
                        rgba(255,255,255,.93) 55%,
                        rgba(255,255,255,.25) 100%
                    ),
                    linear-gradient(
                        180deg,
                        #a9dcff 0%,
                        #f9d49c 62%,
                        #b5d6d7 100%
                    );
            }

            .hero-content {
                position: relative;
                z-index: 5;
            }

            .brand {
                gap: 7px;
                margin-bottom: 15px;
            }

            .brand-runner {
                font-size: 31px;
            }

            .brand-text strong {
                font-size: 20px;
                letter-spacing: -.5px;
            }

            .brand-text span {
                margin-top: 5px;
                font-size: 7px;
                letter-spacing: 1.5px;
            }

            .event-label {
                font-size: 9px;
                padding: 6px 12px;
                margin-bottom: 7px;
            }

            .presented {
                font-size: 12px;
                margin-bottom: 5px;
            }

            .hero-title {
                display: inline-block;
                max-width: 82%;
                padding: 6px 11px;
                font-size: 21px !important;
                line-height: 1.12;
                letter-spacing: -.5px;
            }

            .hero-title span {
                display: inline;
            }

            /* RUNNERS */
            .runners {
                right: -5px;
                bottom: 0 !important;
                z-index: 2;
                opacity: .20;
            }

            .runners img {
                max-height: 175px;
                width: auto;
            }


            /* ================= CONTENT ================= */

            .event-content {
                padding: 20px 12px 25px;
            }

            .intro-grid {
                display: block;
                margin-bottom: 20px;
            }

            .intro-text {
                padding: 5px 4px;
            }

            .intro-text p {
                font-size: 12px;
                line-height: 1.55;
                margin-bottom: 12px;
            }

            /* SECTION TITLE */
            .section-title {
                font-size: 14px;
                padding: 3px 15px 3px 8px;
                margin-bottom: 12px;
            }

            .section-icon {
                width: 31px;
                height: 31px;
                font-size: 15px;
                margin-left: -5px;
            }


            /* ================= OVERVIEW ================= */

            .overview {
                padding: 14px 12px;
                border-radius: 14px;
            }

            .overview-list {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .overview-item {
                grid-template-columns: 25px 65px 8px 1fr;
                font-size: 11px;
            }

            .overview-item .icon {
                font-size: 15px;
            }


            /* ================= RACE ================= */

            .race-section {
                margin-bottom: 20px;
            }

            .race-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .race-card {
                border-radius: 14px;
            }

            .race-header {
                min-height: 65px;
                padding: 10px 14px;
            }

            .race-distance {
                font-size: 28px;
            }

            .race-name {
                font-size: 12px;
                margin-top: 3px;
            }

            .race-runner-icon {
                font-size: 35px;
            }

            .race-body {
                padding: 13px;
                min-height: auto;
            }

            .race-body h4 {
                font-size: 13px;
                margin-bottom: 6px;
            }

            .race-body p {
                font-size: 11px;
                line-height: 1.45;
            }

            .cutoff {
                margin-top: 10px;
                padding: 8px;
                font-size: 10px;
            }

            .cutoff strong {
                font-size: 12px;
            }


            /* ================= LOWER PANELS ================= */

            .lower-grid {
                display: block;
                margin-top: 18px;
            }

            .bottom-grid {
                display: block;
                margin-top: 18px;
            }

            .panel,
            .rules,
            .schedule {
                padding: 14px;
                border-radius: 14px;
                margin-bottom: 14px;
            }


            /* ================= ENTITLEMENTS ================= */

            .entitlement-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 14px 5px;
            }

            .entitlement {
                font-size: 9px;
                line-height: 1.3;
            }

            .entitlement-icon {
                width: 42px;
                height: 42px;
                border-width: 4px;
                font-size: 17px;
                margin-bottom: 6px;
            }


            /* ================= AWARDS ================= */

            .award-intro {
                font-size: 10px;
                line-height: 1.45;
            }

            .award-table {
                width: 100%;
                border-spacing: 3px;
                font-size: 9px;
            }

            .award-table th {
                padding: 7px 3px;
                font-size: 9px;
            }

            .award-table td {
                padding: 6px 2px;
                font-size: 9px;
            }

            .notes {
                font-size: 9px;
                line-height: 1.45;
                padding: 8px;
            }


            /* ================= SCHEDULE ================= */

            .schedule {
                min-height: 120px;
                padding: 15px;
            }

            .tba {
                font-size: 32px;
                margin-top: 18px;
            }


            /* ================= RULES ================= */

            .rules {
                padding: 15px;
            }

            .rules li {
                font-size: 10px;
                padding-left: 22px;
                margin-bottom: 8px;
                line-height: 1.4;
            }

            .rules li::before {
                width: 15px;
                height: 15px;
                font-size: 9px;
            }


            /* ================= FOOTER ================= */

            .event-footer {
                margin-top: 18px;
                padding: 22px 14px 28px;
                border-radius: 14px;
                text-align: center;
            }

            .footer-main {
                font-size: 17px;
                line-height: 1.3;
            }

            .footer-brand {
                margin-top: 10px;
                font-size: 12px;
                letter-spacing: 3px;
            }

            .footer-small {
                font-size: 7px;
                letter-spacing: 1.5px;
            }
        }


        /* ================= VERY SMALL MOBILE ================= */

        @media (max-width: 380px) {

            .event-modal {
                padding: 3px;
            }

            .event-modal-box {
                border-radius: 11px;
            }

            .event-hero {
                min-height: 225px !important;
                padding: 15px 12px !important;
            }

            .brand-text strong {
                font-size: 18px;
            }

            .brand-text span {
                font-size: 6px;
            }

            .hero-title {
                max-width: 88%;
                font-size: 18px !important;
                padding: 5px 9px;
            }

            .runners img {
                max-height: 145px;
            }

            .event-content {
                padding: 17px 10px 20px;
            }

            .overview-item {
                grid-template-columns: 22px 60px 7px 1fr;
                font-size: 10px;
            }

            .entitlement-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .entitlement-icon {
                width: 38px;
                height: 38px;
                font-size: 15px;
            }

            .award-table {
                border-spacing: 2px;
            }

            .award-table th,
            .award-table td {
                font-size: 8px;
                padding: 5px 1px;
            }

            .footer-main {
                font-size: 15px;
            }
        }
    </style>

    <div class="event-modal" id="indexEventModal">
        <div class="event-modal-box">
            <button class="modal-close" onclick="closeEventModal()">&times;</button>
            <div class="event-scroll">
                <section class="event-hero">
                    <div class="hero-content">
                        <div class="brand">
                            <img src="{{asset('img/logo.png')}}" alt="" style="height: 70px;">
                        </div>
                        <div class="event-label">
                            EVENT DETAILS
                        </div>
                        <div class="presented">
                            Run BURJOWAN Proudly Presents
                        </div>
                        <div style="display: flex; align-items: center; flex-wrap: nowrap; gap: 10px;">
                            <div class="hero-title">
                                WINTER <span>HALF MARATHON</span> 2026
                            </div>
                        </div>
                    </div>
                    <div class="runners">
                        <img src="{{asset('img/event2.png')}}" alt="">
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
                                <span class="pink">21.1K</span> endurance challenge
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
                                        <span>Hard Point, Sirajganj</span>
                                    </div>

                                    <div class="overview-item">
                                        <span class="icon">🏁</span>
                                        <b>Event </b>
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


                            <!-- 21.1K -->

                            <div class="race-card">

                                <div class="race-header">

                                    <div>
                                        <div class="race-distance">BEYOND</div>
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
                                        <div class="race-distance">BLAST</div>
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
                                        <div class="race-distance">BOLT</div>
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
                                    Race BIB
                                </div>

                                <div class="entitlement">
                                    <div class="entitlement-icon">🏅</div>
                                    Imported<br> Medal
                                </div>

                                <div class="entitlement">
                                    <div class="entitlement-icon">🙏</div>
                                    Dedicated<br>Prayer Zone
                                </div>

                                <div class="entitlement">
                                    <div class="entitlement-icon">💧</div>
                                    On-Course Hydration
                                    and Support
                                </div>

                                <div class="entitlement">
                                    <div class="entitlement-icon">✚</div>
                                    Medical and First
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
                                AWARDS AND RECOGNITION
                            </div>

                            <div class="award-intro">
                                <strong>
                                    <span class="pink">BEYOND, BLAST and BOLT</span>
                                </strong>
                                <br>
                                Top three finishers will be awarded prize money
                                and commemorative crests.
                            </div>

                            <table class="award-table">

                                <thead>

                                    <tr>
                                        <th>BEYOND</th>
                                        <th>BLAST</th>
                                        <th>BOLT</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>
                                        <td>Champion<br>4,000 BDT</td>
                                        <td>Champion<br>3,000 BDT</td>
                                        <td>Champion<br>2,000 BDT</td>
                                    </tr>

                                    <tr>
                                        <td>1st Runner Up<br>3,000 BDT</td>
                                        <td>1st Runner Up<br>2,000 BDT</td>
                                        <td>1st Runner Up<br>1,000 BDT</td>
                                    </tr>

                                    <tr>
                                        <td>2nd Runner Up<br>2,000 BDT</td>
                                        <td>2nd Runner Up<br>1,000 BDT</td>
                                        <td>2nd Runner Up<br>500 BDT</td>
                                    </tr>

                            </tbody>

                            </table>

                            <div class="notes">

                                <strong>Important Notes:</strong>

                                <br>• Podium positions will be determined
                                based on Gun Time.

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
                                RULES AND GUIDELINES
                            </div>

                            <ul>

                                <li>
                                    Pre-registration is mandatory.
                                    No on-spot registration will be permitted.
                                </li>

                                <li>
                                    BIBs are strictly non-transferable.
                                    Running under another participant's BIB
                                    will result in disqualification.
                                </li>

                                <li>
                                    Medals will be awarded only to
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
        function openIndexModal() {
            const modal = document.getElementById('indexEventModal');
            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }
        function closeEventModal() {
            const modal = document.getElementById('indexEventModal');
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
    </script>
@endsection
