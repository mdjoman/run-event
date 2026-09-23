<?php $__env->startSection('body'); ?>
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">FIND YOUR<br>PERFECT <span>TYRES</span></h1>
                    <p class="hero-subtitle">Premium tyres, professional services and 24/7 roadside assistance across UAE.</p>

                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button class="btn btn-red"><i class="fa-solid fa-magnifying-glass me-1"></i> FIND YOUR PERFECT TYRES</button>
                        <button class="btn btn-outline-custom"><i class="fa-regular fa-calendar-check me-1"></i> BOOK APPOINTMENT</button>
                    </div>

                    <div class="emergency-bar">
                        <div class="emergency-item text-danger">
                            <i class="fa-solid fa-truck-medical"></i> EMERGENCY ROADSIDE ASSISTANCE
                        </div>
                        <a href="tel:+971501234567" class="btn btn-sm btn-dark text-white border-secondary"><i class="fa-solid fa-phone me-1"></i> CALL NOW</a>
                        <a href="#" class="btn btn-sm btn-success"><i class="fa-brands fa-whatsapp me-1"></i> WHATSAPP</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-end position-relative hero-img-wrapper">
                    <img src="<?php echo e(asset('img/car.png')); ?>" alt="Car" class="hero-car-img">
                    <img src="<?php echo e(asset('img/wheel.png')); ?>" alt="Wheel Stack" class="hero-wheel-img">
                </div>
            </div>
        </div>
    </section>

    <section class="quick-search-section">
        <div class="container">
            <div class="quick-search-wrapper">
                <div class="section-title-wrap text-center mb-4">
                    <span class="section-title">QUICK SEARCH</span>
                </div>

                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-4 d-flex">
                        <div class="search-card w-100 d-flex flex-column justify-content-between p-3 bg-white rounded shadow-sm">
                            <div>
                                <div class="search-card-header fw-bold text-dark mb-3">
                                    <i class="fa-solid fa-car text-danger me-2"></i> SEARCH BY VEHICLE
                                </div>
                                <form id="vehicleSearchForm">
                                    <div class="mb-2">
                                        <select class="form-select form-select-sm" id="vehicleBrand">
                                            <option value="">Select Brand</option>
                                            <option value="toyota">Toyota</option>
                                            <option value="nissan">Nissan</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <select class="form-select form-select-sm" id="vehicleModel">
                                            <option value="">Select Model</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select form-select-sm" id="vehicleYear">
                                            <option value="">Select Year</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <button type="submit" form="vehicleSearchForm" class="btn btn-red w-100 py-2 mt-auto">SEARCH VEHICLE <i class="fa-solid fa-chevron-right ms-1"></i></button>
                        </div>
                    </div>

                    <div class="col-lg-4 d-flex">
                        <div class="search-card w-100 d-flex flex-column justify-content-between p-3 bg-white rounded shadow-sm">
                            <div>
                                <div class="search-card-header fw-bold text-dark mb-3">
                                    <i class="fa-solid fa-compact-disc text-danger me-2"></i> SEARCH BY TYRE SIZE
                                </div>
                                <form id="tyreSizeForm">
                                    <div class="row g-2 mb-3 align-items-center text-center">
                                        <div class="col-3">
                                            <label class="small text-muted mb-1 d-block">Width</label>
                                            <input type="text" class="form-control form-control-sm text-center fw-bold" value="205">
                                        </div>
                                        <div class="col-1 pt-3 fw-bold text-muted">/</div>
                                        <div class="col-3">
                                            <label class="small text-muted mb-1 d-block">Profile</label>
                                            <input type="text" class="form-control form-control-sm text-center fw-bold" value="55">
                                        </div>
                                        <div class="col-1 pt-3 fw-bold text-muted">R</div>
                                        <div class="col-4">
                                            <label class="small text-muted mb-1 d-block">Rim Size</label>
                                            <input type="text" class="form-control form-control-sm text-center fw-bold" value="16">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <button type="submit" form="tyreSizeForm" class="btn btn-red w-100 py-2 mt-auto">SEARCH TYRE SIZE <i class="fa-solid fa-chevron-right ms-1"></i></button>
                        </div>
                    </div>

                    <div class="col-lg-4 d-flex">
                        <div class="search-card w-100 d-flex flex-column justify-content-between p-3 bg-white rounded shadow-sm">
                            <div>
                                <div class="search-card-header fw-bold text-dark mb-3">
                                    <i class="fa-solid fa-tags text-danger me-2"></i> SEARCH BY BRAND
                                </div>
                                <div class="brand-grid mb-3">
                                    <div class="brand-box">
                                        <img src="<?php echo e(asset('img/brands/michelin.png')); ?>" alt="Michelin">
                                    </div>
                                    <div class="brand-box">
                                        <img src="<?php echo e(asset('img/brands/bridgestone.png')); ?>" alt="Bridgestone">
                                    </div>
                                    <div class="brand-box">
                                        <img src="<?php echo e(asset('img/brands/pirelli.webp')); ?>" alt="Pirelli">
                                    </div>
                                    <div class="brand-box">
                                        <img src="<?php echo e(asset('img/brands/dunlop.png')); ?>" alt="Dunlop">
                                    </div>
                                    <div class="brand-box">
                                        <img src="<?php echo e(asset('img/brands/continental.png')); ?>" alt="Continental">
                                    </div>
                                    <div class="brand-box">
                                        <img src="<?php echo e(asset('img/brands/yokohama.png')); ?>" alt="Yokohama">
                                    </div>
                                    <div class="brand-box">
                                        <img src="<?php echo e(asset('img/brands/hankook.png')); ?>" alt="Hankook">
                                    </div>
                                    <div class="brand-box">
                                        <img src="<?php echo e(asset('img/brands/goodyear.png')); ?>" alt="Goodyear">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-red w-100 py-2 mt-auto">VIEW ALL BRANDS <i class="fa-solid fa-chevron-right ms-1"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="section-title-wrap">
                <span class="section-title">FEATURED SERVICES</span>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-compact-disc"></i></div>
                        <div class="feature-title">TYRE REPLACEMENT</div>
                        <div class="feature-desc">High quality tyres for all vehicle types.</div>
                        <a href="#" class="btn btn-red btn-sm w-100">BOOK NOW <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-dharmachakra"></i></div>
                        <div class="feature-title">WHEEL ALIGNMENT</div>
                        <div class="feature-desc">3D wheel alignment for smooth & safe driving.</div>
                        <a href="#" class="btn btn-red btn-sm w-100">BOOK NOW <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-arrows-spin"></i></div>
                        <div class="feature-title">WHEEL BALANCING</div>
                        <div class="feature-desc">Eliminate vibration and ensure even tyre wear.</div>
                        <a href="#" class="btn btn-red btn-sm w-100">BOOK NOW <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-wrench"></i></div>
                        <div class="feature-title">PUNCTURE REPAIR</div>
                        <div class="feature-desc">Fast and reliable puncture repair services.</div>
                        <a href="#" class="btn btn-red btn-sm w-100">BOOK NOW <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-car-battery"></i></div>
                        <div class="feature-title">BATTERY SERVICE</div>
                        <div class="feature-desc">Battery replacement, testing & jump start.</div>
                        <a href="#" class="btn btn-red btn-sm w-100">BOOK NOW <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-oil-can"></i></div>
                        <div class="feature-title">OIL CHANGE</div>
                        <div class="feature-desc">Engine oil & filter change with premium quality.</div>
                        <a href="#" class="btn btn-red btn-sm w-100">BOOK NOW <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-products-section py-5 bg-light">
        <div class="container">
            <!-- Main Section Title -->
            <div class="section-title-wrap text-center mb-4">
                <span class="section-title">FEATURED PRODUCTS</span>
            </div>

            <div class="row g-4">
                <!-- 1. POPULAR TYRES CARD -->
                <div class="col-lg-4 d-flex">
                    <div class="featured-card w-100 bg-white p-3 rounded-4 shadow-sm d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0 text-dark">POPULAR TYRES</h6>
                                <a href="#" class="btn-view-all text-danger small fw-bold text-decoration-none px-2 py-1 rounded-pill">VIEW ALL</a>
                            </div>
                            <div class="featured-grid">
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/tyre1.png')); ?>" alt="Michelin" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">MICHELIN</div>
                                    <div class="model-name text-muted extra-small">Primacy 4</div>
                                    <div class="stars text-danger mt-1">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/tyre2.png')); ?>" alt="Bridgestone" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">BRIDGESTONE</div>
                                    <div class="model-name text-muted extra-small">Potenza S001</div>
                                    <div class="stars text-danger mt-1">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/tyre3.png')); ?>" alt="Goodyear" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">GOODYEAR</div>
                                    <div class="model-name text-muted extra-small">Eagle F1</div>
                                    <div class="stars text-danger mt-1">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/tyre4.png')); ?>" alt="Continental" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">CONTINENTAL</div>
                                    <div class="model-name text-muted extra-small">PremiumContact 6</div>
                                    <div class="stars text-danger mt-1">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. ALLOY WHEELS CARD -->
                <div class="col-lg-4 d-flex">
                    <div class="featured-card w-100 bg-white p-3 rounded-4 shadow-sm d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0 text-dark">ALLOY WHEELS</h6>
                                <a href="#" class="btn-view-all text-danger small fw-bold text-decoration-none px-2 py-1 rounded-pill">VIEW ALL</a>
                            </div>
                            <div class="featured-grid">
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/alloy1.png')); ?>" alt="Rays" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">RAYS</div>
                                    <div class="model-name text-muted extra-small">G25</div>
                                    <div class="price fw-bold text-dark mt-1">AED 920</div>
                                </div>
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/alloy2.png')); ?>" alt="OZ Racing" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">OZ Racing</div>
                                    <div class="model-name text-muted extra-small">Leggera HLT</div>
                                    <div class="price fw-bold text-dark mt-1">AED 850</div>
                                </div>
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/alloy3.png')); ?>" alt="TSW" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">TSW</div>
                                    <div class="model-name text-muted extra-small">Brooklands</div>
                                    <div class="price fw-bold text-dark mt-1">AED 780</div>
                                </div>
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/alloy4.png')); ?>" alt="Enkei" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">ENKEI</div>
                                    <div class="model-name text-muted extra-small">RPF1</div>
                                    <div class="price fw-bold text-dark mt-1">AED 800</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. BATTERIES CARD -->
                <div class="col-lg-4 d-flex">
                    <div class="featured-card w-100 bg-white p-3 rounded-4 shadow-sm d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0 text-dark">BATTERIES</h6>
                                <a href="#" class="btn-view-all text-danger small fw-bold text-decoration-none px-2 py-1 rounded-pill">VIEW ALL</a>
                            </div>
                            <div class="featured-grid">
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/bettery1.png')); ?>" alt="Amaron" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">AMARON</div>
                                    <div class="model-name text-muted extra-small">Hi-Life</div>
                                    <div class="price fw-bold text-dark mt-1">AED 320</div>
                                </div>
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/bettery2.png')); ?>" alt="Bosch" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">BOSCH</div>
                                    <div class="model-name text-muted extra-small">S4</div>
                                    <div class="price fw-bold text-dark mt-1">AED 350</div>
                                </div>
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/bettery3.png')); ?>" alt="Varta" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">VARTA</div>
                                    <div class="model-name text-muted extra-small">Blue Dynamic</div>
                                    <div class="price fw-bold text-dark mt-1">AED 340</div>
                                </div>
                                <div class="product-item text-center">
                                    <div class="img-box mb-2">
                                        <img src="<?php echo e(asset('img/tyres/bettery4.png')); ?>" alt="AC Delco" class="img-fluid">
                                    </div>
                                    <div class="brand-name fw-bold">AC DELCO</div>
                                    <div class="model-name text-muted extra-small">Maintenance Free</div>
                                    <div class="price fw-bold text-dark mt-1">AED 310</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="why-choose-section py-3">
        <div class="container">
            <div class="section-title-wrap">
                <span class="section-title">WHY CHOOSE US</span>
            </div>

            <div class="why-choose-wrapper bg-white rounded-3 shadow-sm p-3">
            <div class="row g-0 align-items-center">

                <!-- Item 1 -->
                <div class="col-lg col-md-4 col-sm-6 why-item">
                    <div class="d-flex align-items-center p-2">
                        <div class="why-icon me-3 text-danger fs-1">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                        <div class="why-content">
                            <h6 class="why-title fw-bold text-dark mb-1">CERTIFIED TECHNICIANS</h6>
                            <p class="why-desc text-muted mb-0">Trained & experienced professionals.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="col-lg col-md-4 col-sm-6 why-item">
                    <div class="d-flex align-items-center p-2">
                        <div class="why-icon me-3 text-danger fs-1">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="why-content">
                            <h6 class="why-title fw-bold text-dark mb-1">GENUINE PRODUCTS</h6>
                            <p class="why-desc text-muted mb-0">100% genuine tyres and spare parts.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="col-lg col-md-4 col-sm-6 why-item">
                    <div class="d-flex align-items-center p-2">
                        <div class="why-icon me-3 text-danger fs-1">
                            <i class="fa-solid fa-tag"></i>
                        </div>
                        <div class="why-content">
                            <h6 class="why-title fw-bold text-dark mb-1">BEST PRICE</h6>
                            <p class="why-desc text-muted mb-0">Competitive pricing with best deals.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="col-lg col-md-4 col-sm-6 why-item">
                    <div class="d-flex align-items-center p-2">
                        <div class="why-icon me-3 text-danger fs-1">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="why-content">
                            <h6 class="why-title fw-bold text-dark mb-1">SAME DAY SERVICE</h6>
                            <p class="why-desc text-muted mb-0">Quick service & same day installation.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="col-lg col-md-4 col-sm-6 why-item">
                    <div class="d-flex align-items-center p-2">
                        <div class="why-icon me-3 text-danger fs-1">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div class="why-content">
                            <h6 class="why-title fw-bold text-dark mb-1">24/7 MOBILE SERVICE</h6>
                            <p class="why-desc text-muted mb-0">Round the clock roadside assistance across UAE.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title-wrap text-center mb-4 d-none">
                <span class="section-title">CUSTOMER REVIEWS</span>
            </div>

            <div class="row g-3">
                <!-- Review Card 1 -->
                <div class="col-md-4">
                    <div class="review-card bg-white p-3 rounded-3 shadow-sm border position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark small">Ahmed Al Mansoori</h6>
                                    <div class="stars text-danger extra-small">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- User Avatar -->
                            <img src="<?php echo e(asset('img/review/person1.png')); ?>" class="review-avatar rounded-circle border" width="45" height="45" alt="Ahmed Al Mansoori">
                        </div>
                        <p class="review-text small text-muted mb-0 mt-2">
                            Excellent service! Quick tyre replacement and very professional staff.
                        </p>
                    </div>
                </div>

                <!-- Review Card 2 -->
                <div class="col-md-4">
                    <div class="review-card bg-white p-3 rounded-3 shadow-sm border position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark small">Fatima Al Zaabi</h6>
                                    <div class="stars text-danger extra-small">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- User Avatar -->
                            <img src="<?php echo e(asset('img/review/person2.png')); ?>" class="review-avatar rounded-circle border" width="45" height="45" alt="Fatima Al Zaabi">
                        </div>
                        <p class="review-text small text-muted mb-0 mt-2">
                            Best tyre shop in UAE. Genuine products and best customer support.
                        </p>
                    </div>
                </div>

                <!-- Review Card 3 -->
                <div class="col-md-4">
                    <div class="review-card bg-white p-3 rounded-3 shadow-sm border position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark small">Rashid Khan</h6>
                                    <div class="stars text-danger extra-small">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- User Avatar -->
                            <img src="<?php echo e(asset('img/review/person3.png')); ?>" class="review-avatar rounded-circle border" width="45" height="45" alt="Rashid Khan">
                        </div>
                        <p class="review-text small text-muted mb-0 mt-2">
                            24/7 roadside assistance saved me in the middle of the road. Highly recommended!
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pagination Dots -->
            <div class="review-pagination d-flex justify-content-center align-items-center gap-2 mt-4">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\hayat-tyers\resources\views/index.blade.php ENDPATH**/ ?>