@extends('master')
<style>
    .hero {
        background: linear-gradient(135deg, #0b1c3f 0%, #152c5b 100%);
        color: #fff;
        padding: 60px 0 100px;
        position: relative;
        overflow: hidden;
    }

    .hero-content {
        max-width: 600px;
    }

    .subtitle {
        color: #7cb342;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 2px;
        margin-bottom: 10px;
        display: block;
    }

    .hero h1 {
        font-size: 48px;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 15px;
    }

    .hero h1 span {
        color: #7cb342;
    }

    .hero p {
        font-size: 15px;
        color: #ddd;
    }

    .hero-quote {
        position: absolute;
        right: 50px;
        top: 40px;
        font-size: 28px;
        font-weight: 800;
        font-style: italic;
        color: rgba(255, 255, 255, 0.1);
        text-align: right;
    }

    /* Gallery Section */
    .gallery-section {
        margin-top: -50px;
        position: relative;
        z-index: 10;
        margin-bottom: 80px;
    }

    .filter-buttons {
        display: flex;
        justify-content: flex-start;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 40px;
    }

    .filter-btn {
        background: #fff;
        border: 1px solid #ddd;
        padding: 10px 24px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }

    .filter-btn:hover, .filter-btn.active {
        background-color: #558b2f;
        color: #fff;
        border-color: #558b2f;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }

    .gallery-item {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
    }

    .gallery-item img {
        width: 100%;
        height: 220px !important;
        object-fit: contain;
        display: block;
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .gallery-caption {
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .gallery-caption i {
        font-size: 18px;
        color: #558b2f;
        background: #e8f5e9;
        padding: 10px;
        border-radius: 8px;
    }

    .gallery-caption h4 {
        font-size: 14px;
        font-weight: 700;
        color: #222;
    }

    .gallery-caption p {
        font-size: 12px;
        color: #777;
    }

    /* CTA Banner */
    .cta-banner {
        background: linear-gradient(135deg, #0b1c3f 0%, #152c5b 100%);
        border-radius: 16px;
        padding: 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #fff;
        margin-bottom: -40px;
        position: relative;
        z-index: 20;
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .cta-content h2 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .cta-content p {
        font-size: 14px;
        color: #ccc;
    }

    .btn-yellow {
        background-color: #ffb300;
        color: #000;
        padding: 14px 28px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background 0.3s;
    }

    .btn-yellow:hover {
        background-color: #ffa000;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .nav-links, .nav-right .search-icon {
            display: none;
        }
        .gallery-grid {
            grid-template-columns: 1fr;
        }
        .cta-banner {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }
    }
</style>
@section('body')
    <section class="hero">
        <div class="container hero-content">
            <span class="subtitle">OUR GALLERY</span>
            <h1>Moments<br><span>That Inspire.</span></h1>
            <p>Relive the energy, smiles and unforgettable moments from our running events.</p>
        </div>
    </section>

    <section class="gallery-section container">
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="marathon">Marathon</button>
            <button class="filter-btn" data-filter="fun-run">Fun Run</button>
            <button class="filter-btn" data-filter="community">Community Run</button>
            <button class="filter-btn" data-filter="awards">Awards</button>
            <button class="filter-btn" data-filter="behind-scenes">Behind The Scenes</button>
        </div>

        <div class="gallery-grid">
            <!-- Item 1 -->
            <div class="gallery-item" data-category="marathon">
                <img src="{{asset('img/ur1.jpeg')}}" alt="Marathon">
                <div class="gallery-caption">
                    <i class="fa-regular fa-calendar"></i>
                    <div>
                        <h4>Sirajganj Marathon 2026</h4>
                        <p>16 Jul 2026</p>
                    </div>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="gallery-item" data-category="community">
                <img src="{{asset('img/ur2.jpeg')}}" alt="Marathon">
                <div class="gallery-caption">
                    <i class="fa-regular fa-calendar"></i>
                    <div>
                        <h4>Sirajganj Marathon 2026</h4>
                        <p>16 Jul 2026</p>
                    </div>
                </div>
            </div>
            <!-- Item 3 -->
            <div class="gallery-item" data-category="marathon">
                <img src="{{asset('img/ur3.jpeg')}}" alt="Marathon">
                <div class="gallery-caption">
                    <i class="fa-regular fa-calendar"></i>
                    <div>
                        <h4>Sirajganj Marathon 2026</h4>
                        <p>16 Jul 2026</p>
                    </div>
                </div>
            </div>
            <!-- Item 4 -->
            <div class="gallery-item" data-category="awards">
                <img src="{{asset('img/ur4.jpeg')}}" alt="Marathon">
                <div class="gallery-caption">
                    <i class="fa-regular fa-calendar"></i>
                    <div>
                        <h4>Sirajganj Marathon 2026</h4>
                        <p>16 Jul 2026</p>
                    </div>
                </div>
            </div>
            <!-- Item 5 -->
            <div class="gallery-item" data-category="marathon">
                <img src="{{asset('img/ur5.jpeg')}}" alt="Marathon">
                <div class="gallery-caption">
                    <i class="fa-regular fa-calendar"></i>
                    <div>
                        <h4>Sirajganj Marathon 2026</h4>
                        <p>16 Jul 2026</p>
                    </div>
                </div>
            </div>
            <div class="gallery-item" data-category="marathon">
                <img src="{{asset('img/ur6.jpeg')}}" alt="Marathon">
                <div class="gallery-caption">
                    <i class="fa-regular fa-calendar"></i>
                    <div>
                        <h4>Sirajganj Marathon 2026</h4>
                        <p>16 Jul 2026</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-banner container">
        <div class="cta-content">
            <h2>Be Part of<br>Our Next Event!</h2>
            <p>Join us for the next running event and be part of a growing community of passionate runners.</p>
        </div>
        <div class="cta-button">
            <a href="#" class="btn-yellow">View Upcoming Events <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </section>
<script>
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            button.classList.add('active');

            const filterValue = button.getAttribute('data-filter');

            galleryItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
