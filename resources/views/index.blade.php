@extends('master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
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

    @media (max-width: 768px) {
        .mobile-overview-grid {
            grid-template-columns: 1fr !important;
        }
        .mobile-race-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

@section('body')

@php
    /* ============================================================
       ACTIVE EVENT — CATEGORIES FOR JS
    ============================================================ */
    $categoriesForJs = collect($active_event->categories ?? [])->map(function ($cat) use ($active_event) {
        return [
            'distance' => $cat['distance'] ?? '',
            'name'     => $cat['name'] ?? '',
            'fee'      => (float) ($cat['fee'] ?? $active_event->fee),
        ];
    })->values()->toArray();

    if (empty($categoriesForJs)) {
        $categoriesForJs = [[
            'distance' => $active_event->category ?? '',
            'name'     => $active_event->category ?? 'General',
            'fee'      => (float) ($active_event->fee ?? 0),
        ]];
    }

    /* ============================================================
       HELPER — IMAGE URL
    ============================================================ */
    $imageUrl = function ($path, $fallback = 'img/placeholder.png') {
        if (empty($path)) {
            return asset($fallback);
        }
        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }
        if (\Illuminate\Support\Str::startsWith($path, 'events/')) {
            return asset('storage/' . $path);
        }
        return asset($path);
    };
@endphp

{{-- ==================== HERO ==================== --}}
<section class="hero">
    <div class="container hero-content">
        <div class="hero-subtitle">RUNNING <span> COMMUNITY</span> and EVENTS</div>
        <h1 class="hero-title">RUN. RISE.<span class="highlight">REPEAT.</span></h1>
        <p class="hero-description">
            Discover running events, register online,<br>
            track your journey and be part of the community.
        </p>
        <div class="hero-btns">
            <a href="{{ route('event') }}" class="btn-primary btn-arrow">
                Explore Events <i class="fa-solid fa-arrow-right"></i>
            </a>
            @if ($active_event)
                <a href="#" class="btn-outline proceedRegistrationBtn"
                   data-title="{{ $active_event->title }}"
                   data-price="{{ $active_event->fee }}"
                   data-event_id="{{ $active_event->id }}"
                   data-categories='@json($categoriesForJs)'>
                    Register Now <i class="fa-solid fa-arrow-right"></i>
                </a>
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
                        @if($active_event)
                            <option>{{ $active_event->title }}</option>
                        @endif
                        @if(isset($events) && $events->count())
                            @foreach ($events as $event)
                                <option>{{ $event->title }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="filter-item">
                <i class="fa-solid fa-location-dot filter-icon"></i>
                <div>
                    <label>Location</label>
                    <select>
                        <option>Select location</option>
                        @if($active_event && $active_event->location)
                            <option>{{ $active_event->location }}</option>
                        @endif
                        @if(isset($events) && $events->count())
                            @foreach ($events->pluck('location')->filter()->unique() as $loc)
                                <option>{{ $loc }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="filter-item">
                <i class="fa-regular fa-calendar filter-icon"></i>
                <div>
                    <label for="event-date">Date</label>
                    <input type="text" id="event-date" name="event_date"
                           placeholder="DD/MM/YYYY" class="custom-date-input">
                </div>
            </div>
            <button class="btn-search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        </div>
    </div>
</section>

{{-- ==================== STATS ==================== --}}
<section class="stats-section">
    <div class="container stats-grid">
        @php
            $totalEvents        = \App\Models\Event::count();
            $totalRegistrations = \App\Models\Registration::where('status', 'approved')->count();
            $completedEvents    = \App\Models\Event::where('status', 'completed')->count();
            $communityMembers   = \App\Models\Registration::distinct('phone')->count('phone');
        @endphp

        <div class="stat-card">
            <div class="stat-icon"><i class="fa-regular fa-calendar-alt"></i></div>
            <div class="stat-info">
                <span class="stat-title">Upcoming Events</span>
                <h3>{{ max(1, $totalEvents) }}+</h3>
                <p>Races this year</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
            <div class="stat-info">
                <span class="stat-title">Registered Runners</span>
                <h3>{{ number_format(max(12, $totalRegistrations)) }}+</h3>
                <p>Be part of our community</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-trophy"></i></div>
            <div class="stat-info">
                <span class="stat-title">Successful Races</span>
                <h3>{{ max(1, $completedEvents) }}+</h3>
                <p>Memorable events</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-user-group"></i></div>
            <div class="stat-info">
                <span class="stat-title">Community Members</span>
                <h3>{{ number_format(max(52, $communityMembers)) }}+</h3>
                <p>Run. Connect. Grow.</p>
            </div>
        </div>
    </div>
</section>

{{-- ==================== UPCOMING EVENTS ==================== --}}
<section class="events-section">
    <div class="container">
        <div class="flex items-end gap-5 w-full mb-6">
            <div class="flex flex-col">
                <span class="text-[15px] font-bold text-[#7bb526] tracking-wider uppercase mb-1">FEATURED EVENTS</span>
                <h2 class="section-title">Upcoming Running Events</h2>
            </div>
            <a href="{{ route('event') }}" class="text-xs font-bold text-[#031b33] whitespace-nowrap flex items-center gap-1.5 pb-2">
                View All Events <i class="fa-solid fa-arrow-right"></i>
            </a>
            <div class="flex-grow h-[1px] bg-[#e2e8f0] mb-3"></div>
        </div>

        <div class="unique-slider-wrap" style="display: flex; gap: 20px; align-items: center; overflow: hidden;">

            {{-- Active Event Card --}}
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
                        'hero_image_url'  => $imageUrl($active_event->hero_image, 'img/event2.png'),
                        'categories'      => $active_event->categories   ?? [],
                        'entitlements'    => $active_event->entitlements ?? [],
                        'awards'          => $active_event->awards       ?? [],
                        'schedules'       => $active_event->schedules    ?? [],
                        'rules'           => $active_event->rules        ?? [],
                    ];

                    $activeImageUrl = $imageUrl($active_event->image, 'img/placeholder.png');
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
                        <!--<p class="price"><i class="fa-solid fa-ticket"></i> Registration Fee: TK {{ $active_event->fee }}</p>-->
                        <p></p>
                        @if($active_event->status == 'active')
                            <div class="action-buttons" style="display: flex; gap: 10px; width: 100%;">
                                <a href="javascript:void(0)" class="btn-primary shareBtn" style="flex: 1; flex-basis: 0; text-align: center; justify-content: center; box-sizing: border-box; white-space: nowrap;" data-url="{{ route('form', $active_event->id) }}" data-title="{{ $active_event->title }}">
                                    Share <i class="fa-solid fa-share-nodes"></i>
                                </a>

                                <a href="#" class="btn-primary proceedRegistrationBtn"
                                   style="flex: 1; flex-basis: 0; text-align: center; justify-content: center; box-sizing: border-box; white-space: nowrap;"
                                   data-title="{{ $active_event->title }}"
                                   data-price="{{ $active_event->fee }}"
                                   data-event_id="{{ $active_event->id }}"
                                   data-categories='@json($categoriesForJs)'>
                                    Register Now <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Slider Track --}}
            <div style="overflow: hidden; width: 100%;">
                <div class="unique-track" style="display: flex; gap: 20px; width: max-content;">
                    @if(isset($events) && $events->count())
                        @foreach ($events as $event)
                            @php
                                $eventJson = [
                                    'title'          => strtoupper($event->title),
                                    'subtitle'       => $event->subtitle,
                                    'presented_by'   => $event->presented_by,
                                    'description'    => $event->description,
                                    'location'       => $event->location,
                                    'event_date'     => $event->event_date?->toIso8601String(),
                                    'race_type'      => $event->race_type,
                                    'organizer'      => $event->organizer,
                                    'hero_image_url' => $imageUrl($event->hero_image, 'img/event2.png'),
                                    'categories'     => $event->categories   ?? [],
                                    'entitlements'   => $event->entitlements ?? [],
                                    'awards'         => $event->awards       ?? [],
                                    'schedules'      => $event->schedules    ?? [],
                                    'rules'          => $event->rules        ?? [],
                                ];

                                $imgUrl = $imageUrl($event->image, 'img/placeholder.png');
                            @endphp

                            <div class="unique-card" style="flex-shrink: 0;">
                                <div class="event-img">
                                    <img src="{{ $imgUrl }}" alt="{{ $event->title }}" onclick='openIndexModal(@json($eventJson))' style="cursor: pointer; width: 300px; height: 200px; object-fit: cover; display: block;">

                                    <div class="date-badge">
                                        <span class="day">{{ date('d', strtotime($event->event_date)) }}</span>
                                        <span class="month">{{ date('M', strtotime($event->event_date)) }}</span>
                                        <span class="year">{{ date('Y', strtotime($event->event_date)) }}</span>
                                    </div>
                                </div>

                                <div class="event-content">
                                    <h3 onclick='openIndexModal(@json($eventJson))' style="cursor: pointer; text-transform: uppercase;">
                                        {{ $event->title }}
                                    </h3>
                                    <p class="location"><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</p>
                                    <div class="tags">
                                        <span>{{ $event->category }}</span>
                                    </div>
                                    <!--<p class="price"><i class="fa-solid fa-ticket"></i> Registration Fee: TK {{ $active_event->fee }}</p>-->
                                    <p></p>
                                    <br>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==================== FEATURES ==================== --}}
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

{{-- ==================== STEPS ==================== --}}
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

{{-- ==================== COMMUNITY BANNER ==================== --}}
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

{{-- ==================== PARTNERS ==================== --}}
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

{{-- ==================== GALLERY ==================== --}}
<section class="gallery-section">
    <div class="container">
        <div class="flex items-end gap-5 w-full mb-6">
            <div class="flex flex-col">
                <span class="text-[15px] font-bold text-[#7bb526] tracking-wider uppercase mb-1">RUNNING MOMENTS</span>
                <h2 class="section-title">Gallery</h2>
            </div>
            <a href="{{ route('gallery') }}" class="text-xs font-bold text-[#031b33] whitespace-nowrap flex items-center gap-1.5 pb-2">
                View All Photos <i class="fa-solid fa-arrow-right"></i>
            </a>
            <div class="flex-grow h-[1px] bg-[#e2e8f0] mb-3"></div>
        </div>

        <div class="gallery-grid">
            <img src="{{ asset('img/ur1.jpeg') }}" alt="Gallery Image 1">
            <img src="{{ asset('img/ur2.jpeg') }}" alt="Gallery Image 2">
            <img src="{{ asset('img/ur3.jpeg') }}" alt="Gallery Image 3">
            <img src="{{ asset('img/ur4.jpeg') }}" alt="Gallery Image 4">
            <img src="{{ asset('img/ur5.jpeg') }}" alt="Gallery Image 5">
        </div>
    </div>
</section>

@endsection

{{-- ==================== SCRIPTS ==================== --}}
@push('scripts')
<script>
    $(function () {

        /* ============================================================
        EVENTS SLIDER — AUTO SLIDE + SWIPE
        ============================================================ */
        const $track = $('.unique-track');
        let uniqueTimer;
        let touchStartX = 0;
        let touchEndX = 0;
        let isTouching = false;

        function getCardStep() {
            const $firstCard = $track.find('.unique-card').first();
            if (!$firstCard.length) return 0;

            const cardWidth = $firstCard.outerWidth();
            const gap       = parseFloat($track.css('gap')) || 20;

            return cardWidth + gap;
        }

        function slideNext() {
            const $cards = $track.find('.unique-card');
            if ($cards.length <= 1) return;

            const step = getCardStep();
            if (!step) return;

            $track.css({
                transition: 'transform 0.5s ease-in-out',
                transform: `translateX(-${step}px)`
            });

            setTimeout(function () {
                $track.css({ transition: 'none', transform: 'translateX(0px)' });
                $track.find('.unique-card').first().appendTo($track);
            }, 500);
        }

        function slidePrev() {
            const $cards = $track.find('.unique-card');
            if ($cards.length <= 1) return;

            const step = getCardStep();
            if (!step) return;

            const $lastCard = $cards.last();
            $lastCard.prependTo($track);

            $track.css({ transition: 'none', transform: `translateX(-${step}px)` });
            $track[0].offsetHeight;
            $track.css({
                transition: 'transform 0.5s ease-in-out',
                transform: 'translateX(0px)'
            });
        }

        function startUniqueTimer() {
            clearInterval(uniqueTimer);
            uniqueTimer = setInterval(slideNext, 3000);
        }

        function stopUniqueTimer() {
            clearInterval(uniqueTimer);
        }

        if ($track.length && $track.find('.unique-card').length > 1) {

            startUniqueTimer();

            $track.on('mouseenter', stopUniqueTimer);
            $track.on('mouseleave', startUniqueTimer);

            $track.on('touchstart', function (e) {
                isTouching = true;
                touchStartX = e.originalEvent.touches[0].clientX;
                stopUniqueTimer();
            }, { passive: true });

            $track.on('touchmove', function (e) {
                if (!isTouching) return;
                touchEndX = e.originalEvent.touches[0].clientX;
            }, { passive: true });

            $track.on('touchend', function () {
                if (!isTouching) return;
                isTouching = false;

                const swipeDistance = touchStartX - touchEndX;
                const minSwipe = 50;

                if (swipeDistance > minSwipe) {
                    slideNext();
                } else if (swipeDistance < -minSwipe) {
                    slidePrev();
                }

                startUniqueTimer();
            });

            let isDragging = false;
            let dragStartX = 0;
            let dragEndX = 0;

            $track.on('mousedown', function (e) {
                isDragging = true;
                dragStartX = e.clientX;
                stopUniqueTimer();
                $track.css('cursor', 'grabbing');
            });

            $(document).on('mousemove', function (e) {
                if (!isDragging) return;
                dragEndX = e.clientX;
            });

            $(document).on('mouseup', function () {
                if (!isDragging) return;
                isDragging = false;
                $track.css('cursor', '');

                const swipeDistance = dragStartX - dragEndX;
                const minSwipe = 60;

                if (swipeDistance > minSwipe) {
                    slideNext();
                } else if (swipeDistance < -minSwipe) {
                    slidePrev();
                }

                startUniqueTimer();
            });
        }


        /* ============================================================
        STATS SLIDER — MOBILE ONLY
        ============================================================ */
        const $statsGrid = $('.stats-grid');
        const $statCards = $('.stat-card');
        let statIndex = 0;
        let statTimer;

        function runStatsSlide() {
            if (window.innerWidth <= 991) {
                statIndex++;
                if (statIndex >= $statCards.length) statIndex = 0;

                const cardWidth = $statCards.first().outerWidth();
                const gap = 20;
                const moveAmount = statIndex * (cardWidth + gap);

                $statsGrid.css('transform', `translateX(-${moveAmount}px)`);
            } else {
                $statsGrid.css('transform', 'translateX(0px)');
            }
        }

        function startStatsTimer() {
            clearInterval(statTimer);
            statTimer = setInterval(runStatsSlide, 3000);
        }

        if ($statsGrid.length) {
            startStatsTimer();
        }

        let statsTouchStart = 0;
        let statsTouchEnd = 0;

        $statsGrid.on('touchstart', function (e) {
            statsTouchStart = e.originalEvent.touches[0].clientX;
            clearInterval(statTimer);
        }, { passive: true });

        $statsGrid.on('touchend', function (e) {
            statsTouchEnd = e.originalEvent.changedTouches[0].clientX;
            const diff = statsTouchStart - statsTouchEnd;

            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    statIndex = Math.min(statIndex + 1, $statCards.length - 1);
                } else {
                    statIndex = Math.max(statIndex - 1, 0);
                }

                const cardWidth = $statCards.first().outerWidth();
                $statsGrid.css({
                    transition: 'transform 0.3s ease',
                    transform: `translateX(-${statIndex * (cardWidth + 20)}px)`
                });
            }

            startStatsTimer();
        }, { passive: true });


        /* ============================================================
        RESIZE HANDLER
        ============================================================ */
        let resizeTimer;
        $(window).on('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                if ($track.length) {
                    stopUniqueTimer();
                    $track.css({ transition: 'none', transform: 'translateX(0px)' });
                    if ($track.find('.unique-card').length > 1) {
                        startUniqueTimer();
                    }
                }

                if ($statsGrid.length) {
                    clearInterval(statTimer);
                    statIndex = 0;
                    $statsGrid.css({ transition: 'none', transform: 'translateX(0px)' });
                    startStatsTimer();
                }
            }, 200);
        });


        /* ============================================================
        COUNTER ANIMATION
        ============================================================ */
        $('.stat-card h3').each(function () {
            const $counter = $(this);
            const targetText = $counter.text().trim();
            const hasPlus  = targetText.includes('+');
            const hasComma = targetText.includes(',');
            const target   = parseInt(targetText.replace(/[^0-9]/g, '')) || 0;

            let current = 0;
            const increment = target / 40;

            function updateCounter() {
                current += increment;
                if (current < target) {
                    let displayed = Math.ceil(current);
                    if (hasComma) displayed = displayed.toLocaleString();
                    $counter.text(displayed + (hasPlus ? '+' : ''));
                    setTimeout(updateCounter, 30);
                } else {
                    $counter.text(targetText);
                }
            }
            updateCounter();
        });

    });
</script>
@endpush
