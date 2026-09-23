<?php $__env->startSection('body'); ?>
    <section class="py-5 bg-white">
        <div class="container my-4">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small text-muted">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Products</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Tyres</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Michelin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Michelin Primacy 4</li>
                </ol>
            </nav>

            <div class="row g-4 mb-4">
                <div class="col-lg-5 col-md-6 d-flex gap-3">
                    <div class="d-flex flex-column gap-2">
                        <img src="<?php echo e(asset('img/tyres/tyre5.png')); ?>" class="thumb-img active" alt="Thumb 1">
                        <img src="<?php echo e(asset('img/tyres/thumb1.png')); ?>" class="thumb-img" alt="Thumb 2">
                        <img src="<?php echo e(asset('img/tyres/thumb2.png')); ?>" class="thumb-img" alt="Thumb 3">
                        
                    </div>

                    <div class="flex-grow-1 bg-white rounded p-3 d-flex align-items-center justify-content-center shadow-sm">
                        <img src="<?php echo e(asset('img/tyres/tyre5.png')); ?>" class="img-fluid main-product-img" alt="Michelin Primacy 4">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="mb-2">
                        <img src="<?php echo e(asset('img/brands/michelin.png')); ?>" alt="Michelin Logo" height="28">
                    </div>

                    <h3 class="fw-bold mb-1">Michelin Primacy 4</h3>
                    <h4 class="fw-bold text-dark mb-2">205/55 R16 91V</h4>

                    <div class="d-flex align-items-center gap-1 mb-3 text-warning small">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span class="text-muted ms-1">(128 Reviews)</span>
                    </div>

                    <p class="text-secondary small mb-4">
                        Experience maximum safety and long-lasting performance with Michelin Primacy 4. Excellent wet braking, enhanced comfort and low rolling resistance.
                    </p>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="spec-item">
                                <div class="spec-icon"><i class="fa-solid fa-arrows-up-down-left-right"></i></div>
                                <div>
                                    <div class="text-muted small" style="font-size: 11px;">Size</div>
                                    <div class="fw-bold small">205/55 R16</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="spec-item">
                                <div class="spec-icon"><i class="fa-solid fa-weight-hanging"></i></div>
                                <div>
                                    <div class="text-muted small" style="font-size: 11px;">Load Index</div>
                                    <div class="fw-bold small">91 (615 kg)</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="spec-item">
                                <div class="spec-icon"><i class="fa-solid fa-gauge-high"></i></div>
                                <div>
                                    <div class="text-muted small" style="font-size: 11px;">Speed Rating</div>
                                    <div class="fw-bold small">V (240 km/h)</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="spec-item">
                                <div class="spec-icon"><i class="fa-regular fa-clock"></i></div>
                                <div>
                                    <div class="text-muted small" style="font-size: 11px;">DOT Year</div>
                                    <div class="fw-bold small">2024 (Latest)</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="spec-item">
                                <div class="spec-icon"><i class="fa-solid fa-globe"></i></div>
                                <div>
                                    <div class="text-muted small" style="font-size: 11px;">Country of Origin</div>
                                    <div class="fw-bold small">Thailand</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="spec-item">
                                <div class="spec-icon"><i class="fa-solid fa-shield-halved"></i></div>
                                <div>
                                    <div class="text-muted small" style="font-size: 11px;">Warranty</div>
                                    <div class="fw-bold small">5 Years</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2 text-success fw-bold small">
                        <i class="fa-regular fa-circle-check"></i> In Stock
                        <span class="text-muted fw-normal">30+ Pieces Available</span>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="bg-white p-3 rounded shadow-sm">
                        <div class="text-muted small">Price (Per Piece)</div>
                        <div class="fs-3 fw-bold text-danger">AED 285.00</div>
                        <div class="text-muted small mb-3">(Inclusive of VAT)</div>

                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <button class="qty-btn rounded-start">-</button>
                            <input type="text" class="form-text text-center border-top border-bottom border-0 m-0 fw-bold" value="4" style="width: 60px; height: 38px;">
                            <button class="qty-btn rounded-end">+</button>
                        </div>

                        <button class="btn btn-danger w-100 fw-bold mb-2 py-2"><i class="fa-solid fa-cart-shopping me-2"></i> ADD TO CART</button>
                        <button class="btn btn-outline-danger w-100 fw-bold mb-3 py-2">BUY NOW</button>

                        <div class="p-2 rounded bg-light d-flex align-items-center gap-2 mb-3">
                            <i class="fa-solid fa-truck-fast fs-4 text-secondary ms-1"></i>
                            <div>
                                <div class="fw-bold small mb-0">FREE Delivery & Fitting</div>
                                <div class="text-muted" style="font-size: 11px;">Across UAE</div>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="#" class="text-decoration-none text-muted small"><i class="fa-regular fa-heart me-1"></i> Add to Wishlist</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="feature-bar mb-4">
                <div class="row text-center text-md-start g-3">
                    <div class="col-md">
                        <div class="feature-item justify-content-center justify-content-md-start">
                            <i class="fa-solid fa-dharmachakra feature-icon"></i>
                            <div>
                                <div class="fw-bold small">Free Fitting & Balancing</div>
                                <div class="text-muted small" style="font-size: 11px;">At all our branches</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="feature-item justify-content-center justify-content-md-start">
                            <i class="fa-solid fa-headset feature-icon"></i>
                            <div>
                                <div class="fw-bold small">24/7 Roadside Assistance</div>
                                <div class="text-muted small" style="font-size: 11px;">We are always here</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="feature-item justify-content-center justify-content-md-start">
                            <i class="fa-solid fa-shield-cat feature-icon"></i>
                            <div>
                                <div class="fw-bold small">Best Price Guarantee</div>
                                <div class="text-muted small" style="font-size: 11px;">Found it cheaper? We'll match it</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="feature-item justify-content-center justify-content-md-start">
                            <i class="fa-solid fa-box-open feature-icon"></i>
                            <div>
                                <div class="fw-bold small">Genuine Products</div>
                                <div class="text-muted small" style="font-size: 11px;">100% authentic tyres</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="feature-item justify-content-center justify-content-md-start">
                            <i class="fa-solid fa-rotate-left feature-icon"></i>
                            <div>
                                <div class="fw-bold small">Easy Returns</div>
                                <div class="text-muted small" style="font-size: 11px;">7 days return policy</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-5">
                    <ul class="nav nav-tabs custom-tabs border-bottom-0 mb-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc">DESCRIPTION</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="spec-tab" data-bs-toggle="tab" data-bs-target="#spec">SPECIFICATIONS</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="rev-tab" data-bs-toggle="tab" data-bs-target="#rev">REVIEWS (128)</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="ship-tab" data-bs-toggle="tab" data-bs-target="#ship">SHIPPING & RETURNS</button>
                        </li>
                    </ul>
                    <div class="tab-content bg-white p-3 rounded shadow-sm" id="myTabContent">
                        <div class="tab-pane fade show active" id="desc">
                            <p class="small text-muted mb-3">
                                The Michelin Primacy 4 is designed for premium cars and delivers excellent safety, even when worn. It provides outstanding wet braking performance, long tyre life and superior comfort.
                            </p>
                            <ul class="list-unstyled small text-secondary">
                                <li class="mb-1"><i class="fa-solid fa-check text-danger me-2"></i> Excellent wet braking - even when worn</li>
                                <li class="mb-1"><i class="fa-solid fa-check text-danger me-2"></i> Long lasting performance</li>
                                <li class="mb-1"><i class="fa-solid fa-check text-danger me-2"></i> Fuel efficient with low rolling resistance</li>
                                <li class="mb-1"><i class="fa-solid fa-check text-danger me-2"></i> Enhanced driving comfort and quiet ride</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="bg-white p-3 rounded shadow-sm h-100">
                        <h6 class="fw-bold mb-3 text-uppercase">Customer Reviews</h6>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="display-5 fw-bold">4.8</div>
                            <div>
                                <div class="text-warning small">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                                <div class="text-muted style-11" style="font-size: 11px;">Based on 128 reviews</div>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-1 mb-3 small text-muted">
                            <div class="d-flex align-items-center gap-2">
                                <span>5 <i class="fa-solid fa-star text-warning"></i></span>
                                <div class="rating-bar-bg flex-grow-1"><div class="rating-bar-fill" style="width: 80%;"></div></div>
                                <span>102</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span>4 <i class="fa-solid fa-star text-warning"></i></span>
                                <div class="rating-bar-bg flex-grow-1"><div class="rating-bar-fill" style="width: 15%;"></div></div>
                                <span>18</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span>3 <i class="fa-solid fa-star text-warning"></i></span>
                                <div class="rating-bar-bg flex-grow-1"><div class="rating-bar-fill" style="width: 5%;"></div></div>
                                <span>6</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span>2 <i class="fa-solid fa-star text-warning"></i></span>
                                <div class="rating-bar-bg flex-grow-1"><div class="rating-bar-fill" style="width: 1%;"></div></div>
                                <span>1</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span>1 <i class="fa-solid fa-star text-warning"></i></span>
                                <div class="rating-bar-bg flex-grow-1"><div class="rating-bar-fill" style="width: 1%;"></div></div>
                                <span>1</span>
                            </div>
                        </div>

                        <button class="btn btn-outline-danger w-100 btn-sm fw-bold">WRITE A REVIEW</button>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-white p-3 rounded shadow-sm h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold mb-0 text-uppercase">Related Products</h6>
                            <div>
                                <button class="btn btn-sm btn-light border p-1 px-2"><i class="fa-solid fa-chevron-left"></i></button>
                                <button class="btn btn-sm btn-light border p-1 px-2"><i class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>

                        <div class="row g-2">
                            <!-- Related Item 1 -->
                            <div class="col-4 text-center related-card">
                                <img src="<?php echo e(asset('img/tyres/m1.png')); ?>" class="img-fluid mb-2" alt="Product">
                                <div class="fw-bold style-11 text-truncate" style="font-size: 11px;">Michelin Pilot Sport 5</div>
                                <div class="text-muted style-10" style="font-size: 10px;">205/55 R16 91V</div>
                                <div class="fw-bold text-danger style-11 mt-1" style="font-size: 11px;">AED 315.00</div>
                                <div class="text-warning style-10" style="font-size: 9px;">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                            <!-- Related Item 2 -->
                            <div class="col-4 text-center related-card">
                                <img src="<?php echo e(asset('img/tyres/m2.png')); ?>" class="img-fluid mb-2" alt="Product">
                                <div class="fw-bold style-11 text-truncate" style="font-size: 11px;">Continental UC6</div>
                                <div class="text-muted style-10" style="font-size: 10px;">205/55 R16 91V</div>
                                <div class="fw-bold text-danger style-11 mt-1" style="font-size: 11px;">AED 275.00</div>
                                <div class="text-warning style-10" style="font-size: 9px;">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                            <!-- Related Item 3 -->
                            <div class="col-4 text-center related-card">
                                <img src="<?php echo e(asset('img/tyres/m3.png')); ?>" class="img-fluid mb-2" alt="Product">
                                <div class="fw-bold style-11 text-truncate" style="font-size: 11px;">Bridgestone T005</div>
                                <div class="text-muted style-10" style="font-size: 10px;">205/55 R16 91V</div>
                                <div class="fw-bold text-danger style-11 mt-1" style="font-size: 11px;">AED 265.00</div>
                                <div class="text-warning style-10" style="font-size: 9px;">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\hayat-tyers\resources\views/productdetail.blade.php ENDPATH**/ ?>