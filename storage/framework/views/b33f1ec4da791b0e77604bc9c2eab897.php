<?php $__env->startSection('body'); ?>
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center bg-white p-3 rounded shadow-sm mb-4 g-3">
                <div class="col-lg-4 col-md-12">
                    <h2 class="fw-bold text-danger mb-1 page-main-title">PRODUCTS</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>" class="text-secondary text-decoration-none small">Home</a></li>
                            <li class="breadcrumb-item active small text-secondary" aria-current="page">Products</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="row g-2 align-items-center">
                        <!-- Item 1 -->
                        <div class="col-md-3 col-6 feature-box border-end-md">
                            <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                                <i class="fa-solid fa-truck-fast text-danger fs-3"></i>
                                <div>
                                    <strong class="d-block text-dark feature-title">FREE DELIVERY</strong>
                                    <span class="text-muted feature-sub">Across UAE</span>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="col-md-3 col-6 feature-box border-end-md">
                            <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start ps-md-2">
                                <i class="fa-solid fa-shield-halved text-danger fs-3"></i>
                                <div>
                                    <strong class="d-block text-dark feature-title">BEST PRICE GUARANTEE</strong>
                                    <span class="text-muted feature-sub">We match the price</span>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="col-md-3 col-6 feature-box border-end-md">
                            <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start ps-md-2">
                                <i class="fa-solid fa-check-double text-danger fs-3"></i>
                                <div>
                                    <strong class="d-block text-dark feature-title">GENUINE PRODUCTS</strong>
                                    <span class="text-muted feature-sub">100% Authentic</span>
                                </div>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="col-md-3 col-6 feature-box">
                            <div class="d-flex align-items-center gap-2 justify-content-center justify-content-md-start ps-md-2">
                                <i class="fa-rotate-left fa-solid text-danger fs-3"></i>
                                <div>
                                    <strong class="d-block text-dark feature-title">EASY RETURNS</strong>
                                    <span class="text-muted feature-sub">7 Days Return Policy</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-2 col-md-3">
                    <div class="bg-white p-3 rounded shadow-sm mb-3">
                        <h6 class="fw-bold text-uppercase border-bottom pb-2 mb-2">Categories</h6>
                        <ul class="list-unstyled category-list m-0">
                            <li class="active"><i class="fa-solid fa-compact-disc me-2"></i> Tyres</li>
                            <li><i class="fa-solid fa-circle me-2"></i> Alloy Wheels</li>
                            <li><i class="fa-solid fa-car-battery me-2"></i> Batteries</li>
                            <li><i class="fa-solid fa-puzzle-piece me-2"></i> Accessories</li>
                            <li><i class="fa-solid fa-gauge-high me-2"></i> TPMS Sensors</li>
                            <li><i class="fa-solid fa-pump-soap me-2"></i> Car Care Products</li>
                        </ul>
                    </div>

                    <!-- Filters -->
                    <div class="bg-white p-3 rounded shadow-sm">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <h6 class="fw-bold text-uppercase m-0">Filters</h6>
                            <a href="#" class="text-danger small text-decoration-none fw-semibold">Clear All</a>
                        </div>

                        <!-- Brand Filter -->
                        <div class="filter-group mb-3">
                            <h6 class="filter-title">Brand</h6>
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="michelin"><label class="form-check-label" for="michelin">Michelin (23)</label></div>
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="bridgestone"><label class="form-check-label" for="bridgestone">Bridgestone (18)</label></div>
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="continental"><label class="form-check-label" for="continental">Continental (15)</label></div>
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="goodyear"><label class="form-check-label" for="goodyear">Goodyear (20)</label></div>
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="pirelli"><label class="form-check-label" for="pirelli">Pirelli (17)</label></div>
                            <a href="#" class="text-danger small text-decoration-none d-block mt-1">+ View More</a>
                        </div>

                        <!-- Vehicle Type Filter -->
                        <div class="filter-group mb-3 border-top pt-2">
                            <h6 class="filter-title">Vehicle Type</h6>
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="car"><label class="form-check-label" for="car">Car (52)</label></div>
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="suv"><label class="form-check-label" for="suv">SUV (34)</label></div>
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="van"><label class="form-check-label" for="van">Van (12)</label></div>
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="4x4"><label class="form-check-label" for="4x4">4x4 (18)</label></div>
                        </div>

                        <button class="btn btn-danger w-100 fw-bold mt-2">APPLY FILTERS</button>
                    </div>
                </div>

                <div class="col-lg-10 col-md-9">
                    <div class="bg-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                        <span class="text-muted small fw-medium">Showing 1 – 12 of 120 products</span>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="small text-muted fw-medium">Sort By:</span>
                                <select class="form-select form-select-sm border-secondary-subtle" style="width: auto;">
                                    <option>Popularity</option>
                                    <option>Price: Low to High</option>
                                    <option>Price: High to Low</option>
                                </select>
                            </div>
                            <!-- Removed 'mb-3' class to align buttons with sort dropdown -->
                            <div class="btn-group btn-group-sm view-switcher" role="group" aria-label="View switch">
                                <button class="btn btn-danger" id="gridViewBtn" type="button" aria-label="Grid View">
                                    <i class="fa-solid fa-border-all"></i>
                                </button>
                                <button class="btn btn-outline-secondary" id="listViewBtn" type="button" aria-label="List View">
                                    <i class="fa-solid fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 grid-view" id="productContainer">
                        <!-- Item 1: Michelin -->
                        <div class="col-xl-2-4 col-lg-3 col-md-4 col-6">
                            <a href="<?php echo e(url('/productdetail')); ?>">
                                <div class="product-card bg-white p-3 rounded shadow-sm text-center position-relative h-100 d-flex flex-column justify-content-between">
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-2">SALE</span>
                                    <button class="wishlist-btn position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart"></i></button>

                                    <div class="product-img-box my-2">
                                        <img src="<?php echo e(asset('img/tyres/tyre5.png')); ?>" alt="Michelin Primacy 4" class="img-fluid">
                                    </div>

                                    <div class="brand-logo mb-1">
                                        <img src="<?php echo e(asset('img/brands/michelin.png')); ?>" alt="Michelin" height="20">
                                    </div>

                                    <h6 class="product-title fw-bold text-dark mb-0">Michelin Primacy 4</h6>
                                    <span class="product-spec text-muted">205/55 R16 91V</span>

                                    <div class="rating my-1 text-warning small-text">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        <span class="text-muted ms-1">(128)</span>
                                    </div>

                                    <div class="price-box mb-1">
                                        <span class="fw-bold text-danger me-1">AED 295.00</span>
                                        <span class="text-muted text-decoration-line-through small-text">AED 330.00</span>
                                    </div>

                                    <span class="stock-status text-success mb-2"><i class="fa-regular fa-circle-check"></i> In Stock</span>

                                    <button class="btn btn-danger btn-sm w-100 fw-bold"><i class="fa-solid fa-cart-shopping me-1"></i> ADD TO CART</button>
                                </div>
                            </a>
                        </div>

                        <!-- Item 2: Bridgestone -->
                        <div class="col-xl-2-4 col-lg-3 col-md-4 col-6">
                            <div class="product-card bg-white p-3 rounded shadow-sm text-center position-relative h-100 d-flex flex-column justify-content-between">
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">SALE</span>
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart"></i></button>

                                <div class="product-img-box my-2">
                                    <img src="<?php echo e(asset('img/tyres/tyre6.png')); ?>" alt="Bridgestone Turanza T005" class="img-fluid">
                                </div>

                                <div class="brand-logo mb-1">
                                    <img src="<?php echo e(asset('img/brands/bridgestone.png')); ?>" alt="Bridgestone" height="20">
                                </div>

                                <h6 class="product-title fw-bold text-dark mb-0">Bridgestone Turanza T005</h6>
                                <span class="product-spec text-muted">205/55 R16 91V</span>

                                <div class="rating my-1 text-warning small-text">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    <span class="text-muted ms-1">(96)</span>
                                </div>

                                <div class="price-box mb-1">
                                    <span class="fw-bold text-danger me-1">AED 265.00</span>
                                    <span class="text-muted text-decoration-line-through small-text">AED 310.00</span>
                                </div>

                                <span class="stock-status text-success mb-2"><i class="fa-regular fa-circle-check"></i> In Stock</span>

                                <button class="btn btn-danger btn-sm w-100 fw-bold"><i class="fa-solid fa-cart-shopping me-1"></i> ADD TO CART</button>
                            </div>
                        </div>

                        <!-- Item 3: Goodyear -->
                        <div class="col-xl-2-4 col-lg-3 col-md-4 col-6">
                            <div class="product-card bg-white p-3 rounded shadow-sm text-center position-relative h-100 d-flex flex-column justify-content-between">
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart"></i></button>

                                <div class="product-img-box my-2">
                                    <img src="<?php echo e(asset('img/tyres/tyre7.png')); ?>" alt="Goodyear EfficientGrip" class="img-fluid">
                                </div>

                                <div class="brand-logo mb-1">
                                    <img src="<?php echo e(asset('img/brands/goodyear.png')); ?>" alt="Goodyear" height="20">
                                </div>

                                <h6 class="product-title fw-bold text-dark mb-0">Goodyear EfficientGrip</h6>
                                <span class="product-spec text-muted">205/55 R16 91V</span>

                                <div class="rating my-1 text-warning small-text">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    <span class="text-muted ms-1">(74)</span>
                                </div>

                                <div class="price-box mb-1">
                                    <span class="fw-bold text-danger me-1">AED 275.00</span>
                                </div>

                                <span class="stock-status text-success mb-2"><i class="fa-regular fa-circle-check"></i> In Stock</span>

                                <button class="btn btn-danger btn-sm w-100 fw-bold"><i class="fa-solid fa-cart-shopping me-1"></i> ADD TO CART</button>
                            </div>
                        </div>

                        <!-- Item 4: Continental -->
                        <div class="col-xl-2-4 col-lg-3 col-md-4 col-6">
                            <div class="product-card bg-white p-3 rounded shadow-sm text-center position-relative h-100 d-flex flex-column justify-content-between">
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">SALE</span>
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart"></i></button>

                                <div class="product-img-box my-2">
                                    <img src="<?php echo e(asset('img/tyres/tyre8.png')); ?>" alt="Continental UC6" class="img-fluid">
                                </div>

                                <div class="brand-logo mb-1">
                                    <img src="<?php echo e(asset('img/brands/continental.png')); ?>" alt="Continental" height="20">
                                </div>

                                <h6 class="product-title fw-bold text-dark mb-0">Continental UC6</h6>
                                <span class="product-spec text-muted">205/55 R16 91V</span>

                                <div class="rating my-1 text-warning small-text">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    <span class="text-muted ms-1">(65)</span>
                                </div>

                                <div class="price-box mb-1">
                                    <span class="fw-bold text-danger me-1">AED 270.00</span>
                                    <span class="text-muted text-decoration-line-through small-text">AED 320.00</span>
                                </div>

                                <span class="stock-status text-success mb-2"><i class="fa-regular fa-circle-check"></i> In Stock</span>

                                <button class="btn btn-danger btn-sm w-100 fw-bold"><i class="fa-solid fa-cart-shopping me-1"></i> ADD TO CART</button>
                            </div>
                        </div>

                        <!-- Item 5: Pirelli -->
                        <div class="col-xl-2-4 col-lg-3 col-md-4 col-6">
                            <div class="product-card bg-white p-3 rounded shadow-sm text-center position-relative h-100 d-flex flex-column justify-content-between">
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart"></i></button>

                                <div class="product-img-box my-2">
                                    <img src="<?php echo e(asset('img/tyres/tyre9.png')); ?>" alt="Pirelli Powergy" class="img-fluid">
                                </div>

                                <div class="brand-logo mb-1">
                                    <img src="<?php echo e(asset('img/brands/pirelli.webp')); ?>" alt="Pirelli" height="20">
                                </div>

                                <h6 class="product-title fw-bold text-dark mb-0">Pirelli Powergy</h6>
                                <span class="product-spec text-muted">205/55 R16 91V</span>

                                <div class="rating my-1 text-warning small-text">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    <span class="text-muted ms-1">(59)</span>
                                </div>

                                <div class="price-box mb-1">
                                    <span class="fw-bold text-danger me-1">AED 290.00</span>
                                </div>

                                <span class="stock-status text-success mb-2"><i class="fa-regular fa-circle-check"></i> In Stock</span>

                                <button class="btn btn-danger btn-sm w-100 fw-bold"><i class="fa-solid fa-cart-shopping me-1"></i> ADD TO CART</button>
                            </div>
                        </div>

                        <!-- Item 6: Dunlop -->
                        <div class="col-xl-2-4 col-lg-3 col-md-4 col-6">
                            <div class="product-card bg-white p-3 rounded shadow-sm text-center position-relative h-100 d-flex flex-column justify-content-between">
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">SALE</span>
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart"></i></button>

                                <div class="product-img-box my-2">
                                    <img src="<?php echo e(asset('img/tyres/tyre10.png')); ?>" alt="Dunlop SP Sport LM705" class="img-fluid">
                                </div>

                                <div class="brand-logo mb-1">
                                    <img src="<?php echo e(asset('img/brands/dunlop2.png')); ?>" alt="Dunlop" height="20">
                                </div>

                                <h6 class="product-title fw-bold text-dark mb-0">Dunlop SP Sport LM705</h6>
                                <span class="product-spec text-muted">205/55 R16 91V</span>

                                <div class="rating my-1 text-warning small-text">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    <span class="text-muted ms-1">(44)</span>
                                </div>

                                <div class="price-box mb-1">
                                    <span class="fw-bold text-danger me-1">AED 240.00</span>
                                    <span class="text-muted text-decoration-line-through small-text">AED 275.00</span>
                                </div>

                                <span class="stock-status text-success mb-2"><i class="fa-regular fa-circle-check"></i> In Stock</span>

                                <button class="btn btn-danger btn-sm w-100 fw-bold"><i class="fa-solid fa-cart-shopping me-1"></i> ADD TO CART</button>
                            </div>
                        </div>

                        <!-- Item 7: Yokohama -->
                        <div class="col-xl-2-4 col-lg-3 col-md-4 col-6">
                            <div class="product-card bg-white p-3 rounded shadow-sm text-center position-relative h-100 d-flex flex-column justify-content-between">
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart"></i></button>

                                <div class="product-img-box my-2">
                                    <img src="<?php echo e(asset('img/tyres/tyre11.png')); ?>" alt="Yokohama BluEarth AE50" class="img-fluid">
                                </div>

                                <div class="brand-logo mb-1">
                                    <img src="<?php echo e(asset('img/brands/yokohama.png')); ?>" alt="Yokohama" height="20">
                                </div>

                                <h6 class="product-title fw-bold text-dark mb-0">Yokohama BluEarth AE50</h6>
                                <span class="product-spec text-muted">205/55 R16 91V</span>

                                <div class="rating my-1 text-warning small-text">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    <span class="text-muted ms-1">(38)</span>
                                </div>

                                <div class="price-box mb-1">
                                    <span class="fw-bold text-danger me-1">AED 260.00</span>
                                </div>

                                <span class="stock-status text-success mb-2"><i class="fa-regular fa-circle-check"></i> In Stock</span>

                                <button class="btn btn-danger btn-sm w-100 fw-bold"><i class="fa-solid fa-cart-shopping me-1"></i> ADD TO CART</button>
                            </div>
                        </div>

                        <!-- Item 8: Hankook -->
                        <div class="col-xl-2-4 col-lg-3 col-md-4 col-6">
                            <div class="product-card bg-white p-3 rounded shadow-sm text-center position-relative h-100 d-flex flex-column justify-content-between">
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">SALE</span>
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart"></i></button>

                                <div class="product-img-box my-2">
                                    <img src="<?php echo e(asset('img/tyres/tyre12.png')); ?>" alt="Hankook Ventus Prime 3" class="img-fluid">
                                </div>

                                <div class="brand-logo mb-1">
                                    <img src="<?php echo e(asset('img/brands/hankook.png')); ?>" alt="Hankook" height="20">
                                </div>

                                <h6 class="product-title fw-bold text-dark mb-0">Hankook Ventus Prime 3</h6>
                                <span class="product-spec text-muted">205/55 R16 91V</span>

                                <div class="rating my-1 text-warning small-text">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    <span class="text-muted ms-1">(52)</span>
                                </div>

                                <div class="price-box mb-1">
                                    <span class="fw-bold text-danger me-1">AED 245.00</span>
                                    <span class="text-muted text-decoration-line-through small-text">AED 290.00</span>
                                </div>

                                <span class="stock-status text-success mb-2"><i class="fa-regular fa-circle-check"></i> In Stock</span>

                                <button class="btn btn-danger btn-sm w-100 fw-bold"><i class="fa-solid fa-cart-shopping me-1"></i> ADD TO CART</button>
                            </div>
                        </div>

                        <!-- Item 9: Falken -->
                        <div class="col-xl-2-4 col-lg-3 col-md-4 col-6">
                            <div class="product-card bg-white p-3 rounded shadow-sm text-center position-relative h-100 d-flex flex-column justify-content-between">
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart"></i></button>

                                <div class="product-img-box my-2">
                                    <img src="<?php echo e(asset('img/tyres/tyre13.png')); ?>" alt="Falken Ziex ZE310 Ecorun" class="img-fluid">
                                </div>

                                <div class="brand-logo mb-1">
                                    <img src="<?php echo e(asset('img/brands/falken.png')); ?>" alt="Falken" height="50">
                                </div>

                                <h6 class="product-title fw-bold text-dark mb-0">Falken Ziex ZE310 Ecorun</h6>
                                <span class="product-spec text-muted">205/55 R16 91V</span>

                                <div class="rating my-1 text-warning small-text">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    <span class="text-muted ms-1">(33)</span>
                                </div>

                                <div class="price-box mb-1">
                                    <span class="fw-bold text-danger me-1">AED 255.00</span>
                                </div>

                                <span class="stock-status text-success mb-2"><i class="fa-regular fa-circle-check"></i> In Stock</span>

                                <button class="btn btn-danger btn-sm w-100 fw-bold"><i class="fa-solid fa-cart-shopping me-1"></i> ADD TO CART</button>
                            </div>
                        </div>

                        <!-- Item 10: Toyo Tires -->
                        <div class="col-xl-2-4 col-lg-3 col-md-4 col-6">
                            <div class="product-card bg-white p-3 rounded shadow-sm text-center position-relative h-100 d-flex flex-column justify-content-between">
                                <button class="wishlist-btn position-absolute top-0 end-0 m-2"><i class="fa-regular fa-heart"></i></button>

                                <div class="product-img-box my-2">
                                    <img src="<?php echo e(asset('img/tyres/tyre14.png')); ?>" alt="Toyo Proxes CF2" class="img-fluid">
                                </div>

                                <div class="brand-logo mb-1">
                                    <img src="<?php echo e(asset('img/brands/toyo.png')); ?>" alt="Toyo Tires" height="15">
                                </div>

                                <h6 class="product-title fw-bold text-dark mb-0">Toyo Proxes CF2</h6>
                                <span class="product-spec text-muted">205/55 R16 91V</span>

                                <div class="rating my-1 text-warning small-text">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                    <span class="text-muted ms-1">(27)</span>
                                </div>

                                <div class="price-box mb-1">
                                    <span class="fw-bold text-danger me-1">AED 250.00</span>
                                </div>

                                <span class="stock-status text-success mb-2"><i class="fa-regular fa-circle-check"></i> In Stock</span>

                                <button class="btn btn-danger btn-sm w-100 fw-bold"><i class="fa-solid fa-cart-shopping me-1"></i> ADD TO CART</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const gridBtn = document.getElementById("gridViewBtn");
            const listBtn = document.getElementById("listViewBtn");
            const container = document.getElementById("productContainer");

            // Grid View Click Event
            gridBtn.addEventListener("click", function () {
                container.classList.remove("list-view");
                container.classList.add("grid-view");

                gridBtn.className = "btn btn-danger";
                listBtn.className = "btn btn-outline-secondary";
            });

            // List View Click Event
            listBtn.addEventListener("click", function () {
                container.classList.remove("grid-view");
                container.classList.add("list-view");

                listBtn.className = "btn btn-danger";
                gridBtn.className = "btn btn-outline-secondary";
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\hayat-tyers\resources\views/product.blade.php ENDPATH**/ ?>