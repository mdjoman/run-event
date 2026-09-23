<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AL HAYAT TYRES</title>
    <link rel="icon" type="image/webp" href="<?php echo e(asset('img/ziicon.png')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <style>

    </style>
</head>
<body>
    <header class="top-header">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="<?php echo e(url('/')); ?>" class="text-decoration-none">
                <div class="brand-logo">
                    <img src="<?php echo e(asset('img/logo2.png')); ?>" alt="" id="company-logo">
                </div>
            </a>

            <div class="d-none d-md-flex gap-4">
                <div class="header-info-item">
                    <i class="fa-solid fa-phone"></i>
                    <div class="header-info-text">
                        <span>Call Us</span>
                        <strong>+971 52 978 4757</strong>
                    </div>
                </div>
                <div class="header-info-item">
                    <i class="fa-regular fa-clock"></i>
                    <div class="header-info-text">
                        <span>Working Hours</span>
                        <strong>Sat - Thu: 8:00 AM - 10:00 PM</strong>
                    </div>
                </div>
                <div class="header-info-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <div class="header-info-text">
                        <span>Our Location</span>
                        <strong>United Arab Emirates</strong>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark main-navbar">
        <div class="container">
            <button class="navbar-toggler my-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>" href="<?php echo e(url('/')); ?>">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('about*') ? 'active' : ''); ?>" href="<?php echo e(url('/about')); ?>">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('service*') ? 'active' : ''); ?>" href="<?php echo e(url('/service')); ?>">SERVICES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('product*') ? 'active' : ''); ?>" href="<?php echo e(url('/product')); ?>">PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('brands*') ? 'active' : ''); ?>" href="#">BRANDS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('appointment*') ? 'active' : ''); ?>" href="#">BOOK APPOINTMENT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('track-order*') ? 'active' : ''); ?>" href="#">TRACK ORDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('contact*') ? 'active' : ''); ?>" href="<?php echo e(url('/contact')); ?>">CONTACT US</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <a href="<?php echo e(url('/cart')); ?>" class="nav-cart-btn position-relative text-white me-2">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count">
                            0
                        </span>
                    </a>
                    <a href="#" class="btn-book-top" data-bs-toggle="modal" data-bs-target="#appointmentModal">
                        <i class="fa-regular fa-calendar-check"></i> BOOK APPOINTMENT
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <?php echo $__env->yieldContent('body'); ?>

    <div class="container emergency-banner-container">
        <div class="banner-emergency d-flex flex-column flex-md-row justify-content-between align-items-center position-relative overflow-hidden rounded-3 p-4">
            <!-- Tyre Background Overlay (Left side) -->
            <div class="tyre-bg-overlay"></div>

            <div class="banner-content text-white mb-3 mb-md-0 position-relative z-2">
                <h4 class="fw-bold mb-1">NEED EMERGENCY TYRE ASSISTANCE?</h4>
                <p class="mb-0 small text-white-50">We are just one call away!</p>
            </div>
            <div class="d-flex gap-3 position-relative z-2">
                <a href="tel:+971501234567" class="btn btn-call d-flex align-items-center gap-2 px-3 py-2 text-white text-decoration-none rounded-2">
                    <i class="fa-solid fa-phone-volume fs-4"></i>
                    <div class="text-start leading-tight">
                        <span class="d-block fw-bold small">CALL NOW</span>
                        <small class="extra-small">+971 52 978 4757</small>
                    </div>
                </a>
                <a href="https://wa.me/971529784757" class="btn btn-whatsapp-banner d-flex align-items-center gap-2 px-3 py-2 text-white text-decoration-none rounded-2">
                    <i class="fa-brands fa-whatsapp fs-3 text-success"></i>
                    <div class="text-start leading-tight">
                        <span class="d-block fw-bold small">WHATSAPP</span>
                        <small class="extra-small">CHAT NOW</small>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <footer class="bg-dark-footer text-white">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-3 col-md-6 footer-col">
                    <div class="brand-logo text-white mb-3">
                        <img src="<?php echo e(asset('img/logo3.png')); ?>" alt="Hayat Tyres" id="company-logo2" class="img-fluid" style="max-height: 90px;">
                    </div>
                    <p class="text-secondary extra-small mb-3 pe-lg-2">
                        Your trusted partner for premium tyres, auto care and 24/7 roadside assistance across UAE.
                    </p>
                    <div class="social-icons d-flex gap-2">
                        <a href="#" class="social-btn facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social-btn instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/971529784757" class="social-btn whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#" class="social-btn youtube"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-6 footer-col">
                    <h6 class="footer-title fw-bold text-white mb-3">QUICK LINKS</h6>
                    <ul class="list-unstyled footer-links mb-0">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Brands</a></li>
                        <li><a href="#">Book Appointment</a></li>
                        <li><a href="#">Track Order</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 col-6 footer-col">
                    <h6 class="footer-title fw-bold text-white mb-3">OUR SERVICES</h6>
                    <ul class="list-unstyled footer-links mb-0">
                        <li><a href="#">Tyre Replacement</a></li>
                        <li><a href="#">Wheel Alignment</a></li>
                        <li><a href="#">Wheel Balancing</a></li>
                        <li><a href="#">Tyre Repair</a></li>
                        <li><a href="#">Battery Service</a></li>
                        <li><a href="#">Oil Change</a></li>
                        <li><a href="#">Mobile Tyre Service</a></li>
                        <li><a href="#">TPMS Service</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 col-6 footer-col">
                    <h6 class="footer-title fw-bold text-white mb-3">OUR PRODUCTS</h6>
                    <ul class="list-unstyled footer-links mb-0">
                        <li><a href="#">Tyre Brands</a></li>
                        <li><a href="#">Alloy Wheels</a></li>
                        <li><a href="#">Batteries</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Car Care Products</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-col">
                    <h6 class="footer-title fw-bold text-white mb-3">CONTACT US</h6>
                    <ul class="list-unstyled footer-contact mb-3 extra-small">
                        <li class="mb-2"><i class="fa-solid fa-phone me-2 text-danger"></i> +971 52 978 4757</li>
                        <li class="mb-2"><i class="fa-regular fa-envelope me-2 text-danger"></i> info@hayattyres.ae</li>
                        
                        <li class="mb-2"><i class="fa-solid fa-location-dot me-2 text-danger"></i> United Arab Emirates</li>
                    </ul>
                    <h6 class="footer-title fw-bold text-white mb-1">SUBSCRIBE NEWSLETTER</h6>
                    <p class="text-secondary extra-small mb-2">Get latest offers and updates in your inbox.</p>
                    <form class="newsletter-form">
                        <input type="email" class="form-control form-control-sm mb-2 text-dark bg-white border-0" placeholder="Your email address">
                        <button type="submit" class="btn btn-red btn-sm w-100 fw-bold">SUBSCRIBE</button>
                    </form>
                </div>

            </div>

            <div class="border-top border-secondary pt-3 text-center extra-small text-secondary" style="color: white !important;">
                Web • Cloud • Integrated by <a href="https://zisprink.com/" target="_blank"><img src="<?php echo e(asset('img/logo.png')); ?>" alt="" style="width: 60px; margin-top: -5px;"></a> &copy; <?php echo e(date('Y')); ?> All Rights Reserved
            </div>
        </div>
    </footer>
    <!-- APPOINTMENT MODAL -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content appointment-modal-content">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title font-weight-bold fw-bold text-uppercase" id="appointmentModalLabel">Book An Appointment</h5>
                        
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <form action="#" method="POST" id="appointmentForm">
                        <?php echo csrf_field(); ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-uppercase">Full Name <span style="color: red;">*</span></label>
                                <input type="text" name="name" class="form-control custom-modal-input" placeholder="Name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-uppercase">Phone Number <span style="color: red;">*</span></label>
                                <input type="tel" name="phone" class="form-control custom-modal-input" placeholder="Mobile Number" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-uppercase">Email Address</label>
                                <input type="email" name="email" class="form-control custom-modal-input" placeholder="Email">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-uppercase">Select Service <span style="color: red;">*</span></label>
                                <select name="service_type" class="form-select custom-modal-input" required>
                                    <option value="" selected disabled>Choose a Service</option>
                                    <option value="tyre_service">Tyre Replacement & Repair</option>
                                    <option value="oil_change">Oil & Filter Change</option>
                                    <option value="alloy_wheels">Alloy Wheels Service</option>
                                    <option value="engine_check">Engine Diagnostics & Repair</option>
                                    <option value="wheel_alignment">Wheel Alignment & Balancing</option>
                                    <option value="battery_service">Battery Replacement</option>
                                    <option value="other">Other Service</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-uppercase">Preferred Date <span style="color: red;">*</span></label>
                                <input type="date" name="booking_date" class="form-control custom-modal-input" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-uppercase">Preferred Time Slot <span style="color: red;">*</span></label>
                                <select name="booking_time" class="form-select custom-modal-input" required>
                                    <option value="" selected disabled>Select Time Slot</option>
                                    <option value="morning">Morning (09:00 AM - 12:00 PM)</option>
                                    <option value="afternoon">Afternoon (12:00 PM - 04:00 PM)</option>
                                    <option value="evening">Evening (04:00 PM - 08:00 PM)</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label small fw-bold text-uppercase">Vehicle Info / Additional Notes</label>
                                <textarea name="notes" class="form-control custom-modal-input" rows="3" placeholder="e.g., Car model, specific tyre size, or issue details..."></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-booking-submit w-100">
                                    <i class="fa-solid fa-paper-plane me-2"></i> CONFIRM APPOINTMENT
                                </button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>document.getElementById("year").textContent = new Date().getFullYear();</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const models = {
            toyota: ['Camry', 'Corolla', 'Land Cruiser', 'PRADO'],
            nissan: ['Patrol', 'Altima', 'Sunny', 'X-Trail']
        };

        document.getElementById('vehicleBrand').addEventListener('change', function() {
            const brand = this.value;
            const modelSelect = document.getElementById('vehicleModel');
            const yearSelect = document.getElementById('vehicleYear');

            modelSelect.innerHTML = '<option value="">Select Model</option>';
            yearSelect.innerHTML = '<option value="">Select Year</option>';

            if (brand && models[brand]) {
                models[brand].forEach(model => {
                    const opt = document.createElement('option');
                    opt.value = model.toLowerCase();
                    opt.textContent = model;
                    modelSelect.appendChild(opt);
                });
            }
        });

        document.getElementById('vehicleModel').addEventListener('change', function() {
            const yearSelect = document.getElementById('vehicleYear');
            yearSelect.innerHTML = '<option value="">Select Year</option>';

            if (this.value) {
                for (let y = 2024; y >= 2010; y--) {
                    const opt = document.createElement('option');
                    opt.value = y;
                    opt.textContent = y;
                    yearSelect.appendChild(opt);
                }
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\hayat-tyers\resources\views/master.blade.php ENDPATH**/ ?>