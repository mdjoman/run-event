@extends('master')
@section('body')
    <section class="hero">
        <div class="hero-badge slide-up">
            <i class="fa-solid fa-play" style="font-size: 10px;"></i> Your All-In-One Event Platform
        </div>
        <h1 class="hero-title slide-up">
            Discover Amazing <br>
            <span class="pink">Events</span> & <span class="blue">Activities</span>
        </h1>
        <p class="hero-subtitle slide-up">
            Find, register and pay for your favorite events — from conferences and workshops to concerts, sports and more. All in one place!
        </p>

        <div class="search-box slide-up">
            <div class="search-input-group">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search for events, activities, or categories...">
            </div>
            <div class="divider"></div>
            <div class="search-input-group" style="flex: 0.6;">
                <i class="fa-solid fa-location-dot"></i>
                <select>
                    <option>All Locations</option>
                    <option>Dubai</option>
                    <option>Abu Dhabi</option>
                    <option>RAK</option>
                </select>
            </div>
            <button class="btn-search">Search</button>
        </div>

        <div class="hero-features slide-up">
            <div class="feature-item">
                <i class="fa-regular fa-calendar"></i>
                <div class="feature-text">
                    <h4>Easy Registration</h4>
                    <p>Just a few clicks</p>
                </div>
            </div>
            <div class="feature-item">
                <i class="fa-regular fa-credit-card"></i>
                <div class="feature-text">
                    <h4>Secure Payment</h4>
                    <p>Multiple payment options</p>
                </div>
            </div>
            <div class="feature-item">
                <i class="fa-solid fa-users"></i>
                <div class="feature-text">
                    <h4>Join Activities</h4>
                    <p>Learn, Network, Grow</p>
                </div>
            </div>
            <div class="feature-item">
                <i class="fa-solid fa-shield-halved"></i>
                <div class="feature-text">
                    <h4>Trusted & Safe</h4>
                    <p>Your data is protected</p>
                </div>
            </div>
        </div>

        <div class="floating-tag">
            <img src="{{asset('img/run.png')}}" alt="Event Running">
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <div>
                <div class="section-subtitle">Explore By Category</div>
                <h2 class="section-title">Find Events That Match Your Interest</h2>
            </div>
            <a href="#" class="view-all">View All Categories <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="categories-grid">
            <div class="cat-card cat-1">
                <div class="cat-icon"><i class="fa-solid fa-music"></i></div>
                <h3>Concerts</h3>
                <p>Music • Shows • Festivals</p>
            </div>
            <div class="cat-card cat-2">
                <div class="cat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                <h3>Workshops</h3>
                <p>Learn • Build • Grow</p>
            </div>
            <div class="cat-card cat-3">
                <div class="cat-icon"><i class="fa-solid fa-users-gear"></i></div>
                <h3>Conferences</h3>
                <p>Business • Tech • Education</p>
            </div>
            <div class="cat-card cat-4">
                <div class="cat-icon"><i class="fa-solid fa-basketball"></i></div>
                <h3>Sports</h3>
                <p>Games • Fitness • Tournaments</p>
            </div>
            <div class="cat-card cat-5">
                <div class="cat-icon"><i class="fa-solid fa-user-group"></i></div>
                <h3>Networking</h3>
                <p>Meet • Connect • Collaborate</p>
            </div>
            <div class="cat-card cat-6">
                <div class="cat-icon"><i class="fa-solid fa-star"></i></div>
                <h3>Cultural</h3>
                <p>Art • Food • Lifestyle</p>
            </div>
        </div>
    </section>

    <section class="section" style="background: #f1f5f9;">
        <div class="section-header">
            <div>
                <div class="section-subtitle">Upcoming Events</div>
                <h2 class="section-title">Don't Miss Out – Be Part of Something Great</h2>
            </div>
            <a href="#" class="view-all">View All Events <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="events-container">
            <button class="nav-btn prev"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="nav-btn next"><i class="fa-solid fa-chevron-right"></i></button>
            <div class="events-grid">
                <div class="event-card card-1">
                    <img src="{{asset('img/music.avif')}}" class="event-img" alt="Event">
                    <div class="date-badge">
                        <div class="day">22</div>
                        <div class="month">Jun</div>
                        <div class="year">2026</div>
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">Music Festival 2026</h3>
                        <div class="event-info"><i class="fa-solid fa-location-dot"></i> Hilton Garden Inn, RAK</div>
                        <div class="event-info"><i class="fa-regular fa-clock"></i> 7:30 PM – 11:00 PM</div>
                        <div class="event-bottom">
                            <span class="price">AED 150</span>
                            <span class="tag tag-pink">Live Music</span>
                        </div>
                        <button class="btn-register">Register Now <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>

                <div class="event-card card-2">
                    <img src="{{asset('img/cycle.jpg')}}" class="event-img" alt="Event">
                    <div class="date-badge">
                        <div class="day">28</div>
                        <div class="month">Jun</div>
                        <div class="year">2026</div>
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">Cycle Trekking</h3>
                        <div class="event-info"><i class="fa-solid fa-location-dot"></i> Dubai World Trade Centre</div>
                        <div class="event-info"><i class="fa-regular fa-clock"></i> 9:00 AM – 5:00 PM</div>
                        <div class="event-bottom">
                            <span class="price">AED 299</span>
                            <span class="tag tag-blue">Cycling</span>
                        </div>
                        <button class="btn-register">Register Now <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>

                <div class="event-card card-3">
                    <img src="{{asset('img/tracking.jpg')}}" class="event-img" alt="Event">
                    <div class="date-badge">
                        <div class="day">05</div>
                        <div class="month">Jul</div>
                        <div class="year">2026</div>
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">Trekking & Hiking</h3>
                        <div class="event-info"><i class="fa-solid fa-video"></i> Online Event</div>
                        <div class="event-info"><i class="fa-regular fa-clock"></i> 4:00 PM – 6:00 PM</div>
                        <div class="event-bottom">
                            <span class="price">AED 99</span>
                            <span class="tag tag-green">Trekking</span>
                        </div>
                        <button class="btn-register">Register Now <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>

                <div class="event-card card-4">
                    <img src="{{asset('img/merathon.jpeg')}}" class="event-img" alt="Event">
                    <div class="date-badge">
                        <div class="day">12</div>
                        <div class="month">Jul</div>
                        <div class="year">2026</div>
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">Marathon Run</h3>
                        <div class="event-info"><i class="fa-solid fa-location-dot"></i> Al Mamzar Beach, Dubai</div>
                        <div class="event-info"><i class="fa-regular fa-clock"></i> 6:00 AM – 9:00 AM</div>
                        <div class="event-bottom">
                            <span class="price">AED 50</span>
                            <span class="tag tag-orange">Sports</span>
                        </div>
                        <button class="btn-register">Register Now <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>

                <div class="event-card card-5">
                    <img src="{{asset('img/cm.avif')}}" class="event-img" alt="Event">
                    <div class="date-badge">
                        <div class="day">12</div>
                        <div class="month">Jul</div>
                        <div class="year">2026</div>
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">Community Fun Run</h3>
                        <div class="event-info"><i class="fa-solid fa-location-dot"></i> Al Mamzar Beach, Dubai</div>
                        <div class="event-info"><i class="fa-regular fa-clock"></i> 6:00 AM – 9:00 AM</div>
                        <div class="event-bottom">
                            <span class="price">AED 50</span>
                            <span class="tag tag-orange">Sports</span>
                        </div>
                        <button class="btn-register">Register Now <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="dots">
                <div class="dot active"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </section>

    <section class="features-section">
        <div class="section-subtitle">WHY CHOOSE US</div>
        <h2 class="section-title">Everything You Need in One Place</h2>

        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><i class="fa-regular fa-id-card"></i></div>
                <h4>Simple Registration</h4>
                <p>Sign up and get started in minutes.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-regular fa-credit-card"></i></div>
                <h4>Multiple Payment Options</h4>
                <p>Cards, wallets, and more for your convenience.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-regular fa-calendar-days"></i></div>
                <h4>Manage Your Events</h4>
                <p>View, edit, and track your registrations.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h4>Secure & Reliable</h4>
                <p>Your information and payments are always safe.</p>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const grid = document.querySelector('.events-grid');
            const cards = document.querySelectorAll('.event-card');
            const prevBtn = document.querySelector('.nav-btn.prev');
            const nextBtn = document.querySelector('.nav-btn.next');
            const dots = document.querySelectorAll('.dot');

            let currentIndex = 0;
            const totalCards = cards.length;

            function getVisibleCards() {
                if (window.innerWidth <= 480) return 1;
                if (window.innerWidth <= 768) return 2;
                if (window.innerWidth <= 1024) return 3;
                if (window.innerWidth <= 1400) return 4;
                return 5;
            }

            function updateSlider() {
                if (cards.length === 0) return;
                const visibleCards = getVisibleCards();
                const maxIndex = totalCards - visibleCards;

                if (maxIndex <= 0) {
                    grid.style.transform = `translateX(0px)`;
                    return;
                }

                const cardWidth = cards[0].offsetWidth + 20;
                grid.style.transform = `translateX(-${currentIndex * cardWidth}px)`;

                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentIndex);
                });
            }

            function nextSlide() {
                const visibleCards = getVisibleCards();
                const maxIndex = totalCards - visibleCards;

                if (maxIndex > 0) {
                    if (currentIndex < maxIndex) {
                        currentIndex++;
                    } else {
                        currentIndex = 0;
                    }
                } else {
                    currentIndex = 0;
                }
                updateSlider();
            }

            function prevSlide() {
                const visibleCards = getVisibleCards();
                const maxIndex = totalCards - visibleCards;

                if (maxIndex > 0) {
                    if (currentIndex > 0) {
                        currentIndex--;
                    } else {
                        currentIndex = maxIndex;
                    }
                } else {
                    currentIndex = 0;
                }
                updateSlider();
            }

            let autoSlideInterval = setInterval(nextSlide, 2500);

            const container = document.querySelector('.events-container');
            if (container) {
                container.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
                container.addEventListener('mouseleave', () => {
                    clearInterval(autoSlideInterval);
                    autoSlideInterval = setInterval(nextSlide, 2500);
                });
            }

            if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); });
            if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentIndex = index;
                    updateSlider();
                });
            });

            window.addEventListener('resize', updateSlider);
            updateSlider();
        });
    </script>
@endsection
