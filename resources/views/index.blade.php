@extends('master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
                    @php
                        $activeEventJson = [
                            'title'           => $active_event->title,
                            'subtitle'        => $active_event->subtitle,
                            'presented_by'    => $active_event->presented_by,
                            'description'     => $active_event->description,
                            'location'        => $active_event->location,
                            'event_date'      => $active_event->event_date?->toIso8601String(),
                            'race_type'       => $active_event->race_type,
                            'organizer'       => $active_event->organizer,
                            'hero_image_url'  => $active_event->hero_image
                                ? (\Illuminate\Support\Str::startsWith($active_event->hero_image, ['http://','https://'])
                                    ? $active_event->hero_image
                                    : (\Illuminate\Support\Str::startsWith($active_event->hero_image, 'events/')
                                        ? asset('storage/' . $active_event->hero_image)
                                        : asset($active_event->hero_image)))
                                : asset('img/event2.png'),
                            'categories'      => $active_event->categories   ?? [],
                            'entitlements'    => $active_event->entitlements ?? [],
                            'awards'          => $active_event->awards       ?? [],
                            'schedules'       => $active_event->schedules    ?? [],
                            'rules'           => $active_event->rules        ?? [],
                        ];

                        // Image URL (main card image)
                        $activeImageUrl = $active_event->image
                            ? (\Illuminate\Support\Str::startsWith($active_event->image, ['http://','https://'])
                                ? $active_event->image
                                : (\Illuminate\Support\Str::startsWith($active_event->image, 'events/')
                                    ? asset('storage/' . $active_event->image)
                                    : asset($active_event->image)))
                            : asset('img/placeholder.png');
                    @endphp

                    <div class="unique-card" style="flex-shrink: 0;">
                        <div class="event-img" style="padding-top: 3px; position: relative;">

                            <img src="{{ $activeImageUrl }}"
                                alt="{{ $active_event->title }}"
                                onclick='openIndexModal(@json($activeEventJson))'
                                style="cursor: pointer; height: 197px; width: 100%; object-fit: cover;">

                            <button type="button"
                                    onclick='openIndexModal(@json($activeEventJson))'
                                    style="position: absolute; bottom: 12px; right: 12px; background: #4f9770bf; color: #ffffff; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 5px; backdrop-filter: blur(4px);">
                                <i class="fa-solid fa-circle-info"></i> Event Details
                            </button>

                            <div class="date-badge">
                                <span class="day">{{ date('d', strtotime($active_event->event_date)) }}</span>
                                <span class="month">{{ date('M', strtotime($active_event->event_date)) }}</span>
                                <span class="year">{{ date('Y', strtotime($active_event->event_date)) }}</span>
                            </div>
                        </div>

                        <div class="event-content">
                            <h3 onclick='openIndexModal(@json($activeEventJson))' style="cursor: pointer;">
                                {{ $active_event->title }}
                            </h3>
                            <p class="location"><i class="fa-solid fa-location-dot"></i> {{ $active_event->location }}</p>
                            <div class="tags">
                                <span>{{ $active_event->category }}</span>
                            </div>
                            <p class="price"><i class="fa-solid fa-ticket"></i> Registration Fee: TK {{ $active_event->fee }}</p>
                            @if($active_event->status == 'active')
                                <div class="action-buttons" style="display: flex; gap: 10px; width: 100%;">
                                    <a href="javascript:void(0)" class="btn-primary shareBtn"
                                    style="flex: 1; flex-basis: 0; text-align: center; justify-content: center; box-sizing: border-box; white-space: nowrap;"
                                    data-url="{{ route('form', $active_event->id) }}"
                                    data-title="{{ $active_event->title }}">
                                        Share <i class="fa-solid fa-share-nodes"></i>
                                    </a>

                                    <a href="#" class="btn-primary proceedRegistrationBtn"
                                    style="flex: 1; flex-basis: 0; text-align: center; justify-content: center; box-sizing: border-box; white-space: nowrap;"
                                    data-title="{{ $active_event->title }}"
                                    data-price="{{ $active_event->fee }}"
                                    data-event_id="{{ $active_event->id }}">
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
                            @php
                                $eventJson = [
                                    'title'           => $event->title,
                                    'subtitle'        => $event->subtitle,
                                    'presented_by'    => $event->presented_by,
                                    'description'     => $event->description,
                                    'location'        => $event->location,
                                    'event_date'      => $event->event_date?->toIso8601String(),
                                    'race_type'       => $event->race_type,
                                    'organizer'       => $event->organizer,
                                    'hero_image_url'  => $event->hero_image
                                        ? (\Illuminate\Support\Str::startsWith($event->hero_image, ['http://','https://'])
                                            ? $event->hero_image
                                            : (\Illuminate\Support\Str::startsWith($event->hero_image, 'events/')
                                                ? asset('storage/' . $event->hero_image)
                                                : asset($event->hero_image)))
                                        : asset('img/event2.png'),
                                    'categories'      => $event->categories   ?? [],
                                    'entitlements'    => $event->entitlements ?? [],
                                    'awards'          => $event->awards       ?? [],
                                    'schedules'       => $event->schedules    ?? [],
                                    'rules'           => $event->rules        ?? [],
                                ];

                                $imageUrl = $event->image
                                    ? (\Illuminate\Support\Str::startsWith($event->image, ['http://','https://'])
                                        ? $event->image
                                        : (\Illuminate\Support\Str::startsWith($event->image, 'events/')
                                            ? asset('storage/' . $event->image)
                                            : asset($event->image)))
                                    : asset('img/placeholder.png');
                            @endphp

                            <div class="unique-card" style="flex-shrink: 0;">
                                <div class="event-img">
                                    <img src="{{ $imageUrl }}"
                                        alt="{{ $event->title }}"
                                        onclick='openIndexModal(@json($eventJson))'
                                        style="cursor: pointer;">

                                    <div class="date-badge">
                                        <span class="day">{{ date('d', strtotime($event->event_date)) }}</span>
                                        <span class="month">{{ date('M', strtotime($event->event_date)) }}</span>
                                        <span class="year">{{ date('Y', strtotime($event->event_date)) }}</span>
                                    </div>
                                </div>

                                <div class="event-content">
                                    <h3 onclick='openIndexModal(@json($eventJson))' style="cursor: pointer;">
                                        {{ $event->title }}
                                    </h3>
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

@endsection
