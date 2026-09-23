@extends('master')
@section('body')
    <section class="ab-hero-section">
        <div class="ab-hero-content fade-in">
            <span class="ab-tag-line">OUR STORY</span>
            <h1 class="ab-hero-title">Run Sirajganj.<br><span class="ev-green-text">Grow Together.</span></h1>
            <p class="ab-hero-desc">We bring runners together — from your first 5K to your marathon goals. RUN BURJOWAN is more than just running; it's a community, a movement, and a healthier, stronger Sirajganj.</p>
        </div>
        <div class="ab-badge-top-right handwritten">
            Healthy People<br>Stronger<br><span style="color:red;">Sirajganj</span>
        </div>
    </section>

    <!-- SECTION 2: OUR JOURNEY -->
    <section class="ab-journey-section">
        <div class="ab-journey-text fade-in">
            <span class="ab-tag-line">OUR JOURNEY</span>
            <h2 class="ab-hero-title" style="font-size: 36px;">From One Run to a<br><span class="ev-green-text">Growing Community</span></h2>
            <p>RUN BURJOWAN started with a simple idea — to bring together passionate runners in Sirajganj and create a space where everyone can run, connect and grow. What began as a small group of friends has now become a growing community, organizing running events, supporting healthier lifestyles and inspiring people of all ages to stay active.</p>
            <div class="ab-journey-quote handwritten">Same Roads. Bigger Dreams.</div>
        </div>
        <div class="ab-journey-img-container fade-in">
            <img src="{{ asset('img/journey.jpg') }}" alt="Sirajganj Running Community" class="ab-brush-img">
        </div>
    </section>

    <!-- SECTION 3: CORE PRINCIPLES -->
    <section class="ab-principles-section">
        <div class="ab-principles-grid">
            <div class="ab-section-header fade-in">
                <span class="ab-tag-line">OUR CORE PRINCIPLES</span>
                <h2 style="font-size: 32px; font-weight: 800; color: var(--dark-blue);">What Drives <span class="ev-green-text">Us</span></h2>
                <p style="font-size: 13px; color: var(--text-gray); margin-top: 10px;">These values guide every step we take — in our community, in our events, and in our journey together.</p>
            </div>

            <div class="ab-principle-card fade-in">
                <div class="ab-p-icon"><i class="fa-solid fa-users"></i></div>
                <h4>Every Runner Matters</h4>
                <p>No matter your pace, experience or age — you belong here.</p>
            </div>

            <div class="ab-principle-card fade-in">
                <div class="ab-p-icon"><i class="fa-solid fa-person-running"></i></div>
                <h4>Discipline & Consistency</h4>
                <p>Small steps every day lead to big goals.</p>
            </div>

            <div class="ab-principle-card fade-in">
                <div class="ab-p-icon"><i class="fa-solid fa-handshake"></i></div>
                <h4>Community & Connection</h4>
                <p>We run, support and grow together.</p>
            </div>

            <div class="ab-principle-card fade-in">
                <div class="ab-p-icon"><i class="fa-solid fa-heart-pulse"></i></div>
                <h4>Run for a Better Life</h4>
                <p>Healthier minds, stronger bodies, brighter futures.</p>
            </div>
        </div>
    </section>

    <!-- SECTION 4: CTA BANNER -->
    <section class="ab-cta-section">
        <div class="ab-cta-box fade-in">
            <h2 class="ab-cta-title handwritten">We run<br>Sirajganj<br>together.</h2>
            <span class="ab-tag-line" style="color: #cbd5e1;">MORE THAN A RACE</span>
            <p style="font-size: 14px; color: #cbd5e1; margin-bottom: 15px;">We are a community of runners, dreamers and doers. Together we organize running events, encourage an active lifestyle and make Sirajganj a healthier, happier place — one step at a time.</p>
            <a href="#" class="ab-btn-cta">Lace Up. Join the Community. <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- SECTION 5: IMPACT & STATS -->
    <section class="ab-impact-section">
        <div class="ab-stats-grid">
            <div class="ab-section-header fade-in" style="margin-bottom:0;">
                <span class="ab-tag-line">OUR IMPACT</span>
                <h2 style="font-size: 28px; font-weight: 800; color: var(--dark-blue);">Together We Make<br><span class="ev-green-text">A Difference</span></h2>
            </div>

            <div class="ab-stat-item fade-in">
                <div class="ab-stat-icon"><i class="fa-regular fa-calendar-check"></i></div>
                <div class="ab-stat-number" data-target="25">25+</div>
                <div class="ab-stat-label">Events Organized</div>
            </div>

            <div class="ab-stat-item fade-in">
                <div class="ab-stat-icon"><i class="fa-solid fa-people-group"></i></div>
                <div class="ab-stat-number" data-target="500">500+</div>
                <div class="ab-stat-label">Active Runners</div>
            </div>

            <div class="ab-stat-item fade-in">
                <div class="ab-stat-icon"><i class="fa-solid fa-road"></i></div>
                <div class="ab-stat-number" data-target="10">10K+</div>
                <div class="ab-stat-label">Kilometers Run</div>
            </div>

            <div class="ab-stat-item fade-in">
                <div class="ab-stat-icon"><i class="fa-solid fa-chart-line"></i></div>
                <div class="ab-stat-number">Growing</div>
                <div class="ab-stat-label">Community Members</div>
            </div>
        </div>
    </section>

    <!-- SECTION 6: BOTTOM BANNER STRIP -->
    <section class="ab-bottom-banner">
        <div class="handwritten fade-in">
            Run Sirajganj.<br>Grow Together.
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fadeElements = document.querySelectorAll('.fade-in');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.2 });

            fadeElements.forEach(el => observer.observe(el));
        });
    </script>
@endsection
