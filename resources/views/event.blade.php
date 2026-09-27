@extends('master')
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
    // Prepare active event JSON for modal
    $activeEventJson = null;
    if ($active_event) {
        $activeEventJson = [
            'id'              => $active_event->id,
            'title'           => $active_event->title,
            'subtitle'        => $active_event->subtitle,
            'presented_by'    => $active_event->presented_by,
            'description'     => $active_event->description,
            'location'        => $active_event->location,
            'event_date'      => $active_event->event_date?->toIso8601String(),
            'start_time'      => $active_event->start_time,
            'race_type'       => $active_event->race_type,
            'organizer'       => $active_event->organizer,
            'fee'             => $active_event->fee,
            'category'        => $active_event->category,
            'image_url'       => $active_event->image_url,
            'hero_image_url'  => $active_event->hero_image_url,
            'categories'      => $active_event->categories   ?? [],
            'entitlements'    => $active_event->entitlements ?? [],
            'awards'          => $active_event->awards       ?? [],
            'schedules'       => $active_event->schedules    ?? [],
            'rules'           => $active_event->rules        ?? [],
        ];
    }
@endphp

<section class="ev-hero-section" style="background-image: url('{{ asset('img/event.jpg') }}');">
    <div class="ev-hero-overlay"></div>
    <div class="container ev-hero-content">
        <span class="ev-sub-tag">• RUN • CONNECT • EXPLORE</span>
        <h1 class="ev-hero-title">OUR <span class="ev-green-text">EVENTS</span></h1>
        <p class="ev-hero-desc">Join our running community and be part of exciting events, from local runs to major Marathons.</p>
    </div>
</section>

<div class="container ev-main-wrapper">
    <div class="ev-tabs-bar">
        <button class="ev-tab-btn ev-active-tab" onclick="switchTab('upcoming', this)">
            <i class="fa-regular fa-calendar-check"></i> Upcoming Events
        </button>
        <button class="ev-tab-btn" onclick="switchTab('previous', this)">
            <i class="fa-regular fa-clock"></i> Previous Events
        </button>
    </div>

    @if ($active_event)
        <div id="upcoming-section">
            <div class="ev-section-header">
                <div>
                    <span class="ev-section-tag">UPCOMING EVENT</span>
                    <h2 class="ev-section-title">{{ $active_event->title }}</h2>
                    <p class="ev-sub-text">
                        {{ $active_event->tagline ?? 'Run through the city of dreams!' }}
                    </p>
                </div>
                <a href="#" class="ev-view-all-link">
                    View All Upcoming <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="ev-main-event-card">
                <div class="ev-event-left-box">
                    <div class="ev-event-img-wrap">
                        <img src="{{ $active_event->image_url }}"
                             alt="{{ $active_event->title }}"
                             onclick='openIndexModal(@json($activeEventJson))'
                             style="cursor: pointer;">

                        <button type="button"
                                onclick='openIndexModal(@json($activeEventJson))'
                                style="position: absolute; top: 12px; right: 12px;
                                       background: #4f9770bf; color: #ffffff;
                                       border: none; padding: 6px 12px; border-radius: 4px;
                                       font-size: 12px; font-weight: 500; cursor: pointer;
                                       display: flex; align-items: center; gap: 5px;
                                       backdrop-filter: blur(4px); z-index: 2;">
                            <i class="fa-solid fa-circle-info"></i> Event Details
                        </button>

                        <div class="ev-date-badge">
                            <span class="day">{{ date('d', strtotime($active_event->event_date)) }}</span>
                            <span class="month">{{ date('M', strtotime($active_event->event_date)) }}</span>
                            <span class="year">{{ date('Y', strtotime($active_event->event_date)) }}</span>
                        </div>
                    </div>

                    <div class="ev-meta-grid">
                        <div class="ev-meta-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <div>
                                <strong>Location</strong><br>
                                <small>{{ $active_event->location }}</small>
                            </div>
                        </div>
                        <div class="ev-meta-item">
                            <i class="fa-solid fa-route"></i>
                            <div>
                                <strong>Distance</strong><br>
                                <small>{{ $active_event->category }}</small>
                            </div>
                        </div>
                        <div class="ev-meta-item">
                            <i class="fa-solid fa-clock"></i>
                            <div>
                                <strong>Start Time</strong><br>
                                <small>{{ $active_event->start_time ?? '6:00 AM' }}</small>
                            </div>
                        </div>
                    </div>

                    {{-- Dynamic Entitlements/Features --}}
                    @php
                        $features = $active_event->entitlements ?? [];
                        $featureIcons = [
                            '👕' => 'fa-shirt',
                            '🎟️' => 'fa-ticket',
                            '🏅' => 'fa-award',
                            '🙏' => 'fa-hands-praying',
                            '💧' => 'fa-glass-water',
                            '✚'  => 'fa-user-nurse',
                            '🥤' => 'fa-mug-hot',
                            '📜' => 'fa-certificate',
                        ];
                    @endphp

                    @if(count($features) > 0)
                        <div class="ev-features-list" style="font-size: 14px !important;">
                            @foreach($features as $feature)
                                @php
                                    $iconKey = $feature['icon'] ?? '🏅';
                                    $faIcon  = $featureIcons[$iconKey] ?? 'fa-award';
                                    $text    = trim(str_replace("\n", ' ', $feature['text'] ?? ''));
                                @endphp
                                <span>
                                    <i class="fa-solid {{ $faIcon }}"></i>
                                    {{ \Illuminate\Support\Str::limit($text, 30) }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="ev-widget-right-box">
                    <div class="ev-offer-banner">
                        <p>
                            Register before
                            {{ $active_event->event_date->subDays(30)->format('d M Y') }}
                        </p>
                    </div>

                    <div class="ev-widget-group">
                        <label class="ev-label">Select Your Category</label>
                        <div class="ev-category-grid">
                            @php
                                $categories = $active_event->categories ?? [];
                            @endphp

                            @forelse($categories as $index => $cat)
                                @php
                                    $isDisabled = $index > 2;
                                    $isActive   = ($index === 1); // Second category active by default (mimics design)
                                @endphp
                                <button class="ev-cat-btn {{ $isDisabled ? 'ev-cat-disabled' : '' }} {{ $isActive ? 'ev-cat-active' : '' }}"
                                        {{ $isDisabled ? 'disabled' : '' }}
                                        data-distance="{{ $cat['distance'] ?? '' }}"
                                        data-fee="{{ $cat['fee'] ?? $active_event->fee }}">
                                    {{ $cat['distance'] ?? '' }}
                                    <br>
                                    <span>BDT {{ number_format((float)($cat['fee'] ?? $active_event->fee)) }}</span>
                                </button>
                            @empty
                                <button class="ev-cat-btn ev-cat-active"
                                        data-fee="{{ $active_event->fee }}">
                                    {{ $active_event->category }}
                                    <br>
                                    <span>BDT {{ number_format($active_event->fee) }}</span>
                                </button>
                            @endforelse
                        </div>
                    </div>

                    <div class="ev-widget-group">
                        <label class="ev-label">Participant</label>
                        <div class="ev-qty-picker">
                            <button class="ev-qty-btn" type="button" onclick="decrementQty()">-</button>
                            <input type="text" value="1" readonly class="ev-qty-input" id="participantQty">
                            <button class="ev-qty-btn" type="button" onclick="incrementQty()">+</button>
                        </div>
                    </div>

                    <div class="ev-total-box">
                        <span>Total Amount</span>
                        <h3 class="ev-total-price" id="totalPrice">
                            BDT {{ number_format($active_event->fee) }}
                        </h3>
                    </div>

                    @if($active_event->status == 'active')
                        <div class="action-buttons" style="display: flex; gap: 10px;">
                            <a href="javascript:void(0)"
                               class="btn-primary shareBtn"
                               style="flex: 1; text-align: center; justify-content: center;"
                               data-url="{{ route('form', $active_event->id) }}"
                               data-title="{{ $active_event->title }}">
                                Share <i class="fa-solid fa-share-nodes"></i>
                            </a>

                            <a href="#"
                               class="btn-primary proceedRegistrationBtn"
                               style="flex: 1; text-align: center; justify-content: center;"
                               data-title="{{ $active_event->title }}"
                               data-price="{{ $active_event->fee }}"
                               data-event_id="{{ $active_event->id }}">
                                Register <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif

                    <div class="ev-payment-brands">
                        <!--<span><img src="{{asset('img/visa.webp')}}" alt="Visa"></span>-->
                        {{-- <span><img src="{{asset('img/bkash.png')}}" alt="bKash" style="width:60px;"></span> --}}
                        <!--<span><img src="{{asset('img/nagod.png')}}" alt="Nagad"></span>-->
                    </div>
                </div>
            </div>
        </div>
    @else

        {{-- ============ NO EVENT FALLBACK ============ --}}
        <div id="previous-section" style="display: none;">
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
        </div>
    @endif

    {{-- ============ PREVIOUS EVENTS SECTION ============ --}}
    <div class="ev-section-header ev-mt-50">
        <div>
            <span class="ev-section-tag">EVENT HIGHLIGHTS</span>
            <h2 class="ev-section-title">Our Previous Events</h2>
        </div>
    </div>

    <div class="unique-past-wrapper">
        <div class="unique-past-grid">
            @forelse($past_events as $pastEvent)
                @php
                    $pastJson = [
                        'id'              => $pastEvent->id,
                        'title'           => $pastEvent->title,
                        'subtitle'        => $pastEvent->subtitle,
                        'presented_by'    => $pastEvent->presented_by,
                        'description'     => $pastEvent->description,
                        'location'        => $pastEvent->location,
                        'event_date'      => $pastEvent->event_date?->toIso8601String(),
                        'start_time'      => $pastEvent->start_time,
                        'race_type'       => $pastEvent->race_type,
                        'organizer'       => $pastEvent->organizer,
                        'fee'             => $pastEvent->fee,
                        'category'        => $pastEvent->category,
                        'image_url'       => $pastEvent->image_url,
                        'hero_image_url'  => $pastEvent->hero_image_url,
                        'categories'      => $pastEvent->categories   ?? [],
                        'entitlements'    => $pastEvent->entitlements ?? [],
                        'awards'          => $pastEvent->awards       ?? [],
                        'schedules'       => $pastEvent->schedules    ?? [],
                        'rules'           => $pastEvent->rules        ?? [],
                    ];
                @endphp

                <div class="unique-past-card">
                    <div class="ev-past-img-box">
                        <img src="{{ $pastEvent->image_url }}"
                             alt="{{ $pastEvent->title }}"
                             onclick='openIndexModal(@json($pastJson))'
                             style="cursor: pointer;">

                        <span class="ev-past-date">
                            {{ $pastEvent->event_date ? strtoupper($pastEvent->event_date->format('d M Y')) : 'N/A' }}
                        </span>
                    </div>

                    <div class="ev-past-card-body">
                        <h3 class="ev-past-title"
                            onclick='openIndexModal(@json($pastJson))'
                            style="cursor: pointer;">
                            {{ $pastEvent->title }}
                        </h3>
                        <p class="ev-past-info">
                            <i class="fa-solid fa-location-dot"></i> {{ $pastEvent->location }}
                        </p>
                        <p class="ev-past-info">
                            <i class="fa-solid fa-route"></i>
                            {{ collect($pastEvent->categories ?? [])->pluck('distance')->filter()->implode(' | ') ?: $pastEvent->category }}
                        </p>
                        <a href="javascript:void(0)"
                           onclick='openIndexModal(@json($pastJson))'
                           class="ev-btn-view-more">
                            View More <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="unique-past-card" style="min-width: 100% !important; flex: 0 0 100% !important;">
                    <div style="text-align: center; padding: 40px 20px;">
                        <i class="fa-regular fa-folder-open" style="font-size: 40px; color: #cbd5e1; margin-bottom: 12px;"></i>
                        <h3 style="font-size: 16px; color: #64748b; margin-bottom: 6px;">No Previous Events Yet</h3>
                        <p style="font-size: 13px; color: #94a3b8;">Our first event is yet to happen — stay tuned!</p>
                    </div>
                </div>
            @endforelse
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
    function switchTab(type, btn) {
        const buttons = document.querySelectorAll('.ev-tab-btn');
        buttons.forEach(b => b.classList.remove('ev-active-tab'));
        btn.classList.add('ev-active-tab');

        const upcomingSec = document.getElementById('upcoming-section');
        const previousSec = document.getElementById('previous-section');

        if (type === 'upcoming') {
            if (upcomingSec) upcomingSec.style.display = 'block';
            if (previousSec) previousSec.style.display = 'none';
        } else {
            if (upcomingSec) upcomingSec.style.display = 'none';
            if (previousSec) previousSec.style.display = 'block';
        }
    }
</script>

<script>
    /* ============ CATEGORY SELECTION ============ */
    document.querySelectorAll('.ev-category-grid .ev-cat-btn:not([disabled])').forEach(button => {
        button.addEventListener('click', function () {
            document.querySelectorAll('.ev-category-grid .ev-cat-btn').forEach(btn => {
                btn.classList.remove('ev-cat-active');
            });
            this.classList.add('ev-cat-active');
            updateTotalPrice();
        });
    });

    /* ============ QUANTITY PICKER ============ */
    let qty = 1;

    function incrementQty() {
        qty++;
        document.getElementById('participantQty').value = qty;
        updateTotalPrice();
    }

    function decrementQty() {
        if (qty > 1) {
            qty--;
            document.getElementById('participantQty').value = qty;
            updateTotalPrice();
        }
    }

    function updateTotalPrice() {
        const activeBtn = document.querySelector('.ev-cat-btn.ev-cat-active');
        let unitPrice = 0;

        if (activeBtn && activeBtn.dataset.fee) {
            unitPrice = parseFloat(activeBtn.dataset.fee);
        }

        const total = unitPrice * qty;
        const totalEl = document.getElementById('totalPrice');
        if (totalEl) {
            totalEl.textContent = 'BDT ' + total.toLocaleString();
        }
    }
</script>

<script>
    /* ============ PAST EVENTS AUTO SLIDE ============ */
    (function () {
        const pastTrack = document.querySelector('.unique-past-grid');
        if (!pastTrack) return;

        const cards = pastTrack.querySelectorAll('.unique-past-card');
        if (cards.length <= 1) return;

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
            }, 600);
        }

        setInterval(runContinuousSlide, 3000);
    })();
</script>

@endsection