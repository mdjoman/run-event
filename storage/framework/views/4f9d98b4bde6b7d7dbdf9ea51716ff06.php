<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'RUN BURJOWAN - Running Events & Community'); ?></title>

    <link rel="icon" type="image/webp" href="<?php echo e(asset('img/logo.png')); ?>">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>?v=<?php echo e(time()); ?>">

    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    
    <style>
        /* ============ SWEETALERT THEME ============ */
        .swal2-popup {
            border-radius: 16px !important;
            font-family: 'Poppins', sans-serif !important;
            padding: 24px !important;
        }
        .swal2-title {
            font-weight: 700 !important;
            color: #1e293b !important;
            font-size: 20px !important;
        }
        .swal2-html-container {
            color: #64748b !important;
            font-size: 14px !important;
        }
        .swal2-confirm {
            border-radius: 10px !important;
            font-weight: 600 !important;
            padding: 10px 22px !important;
        }
        .swal2-container {
            z-index: 99999 !important;
        }

        /* ============ SUCCESS MODAL ============ */
        #successModal {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .6);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 16px;
        }
        #successModal.show {
            display: flex;
            animation: fadeInSuccess .25s ease;
        }
        @keyframes fadeInSuccess {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .success-card {
            background: #fff;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .25);
            overflow: hidden;
            animation: popInSuccess .35s cubic-bezier(.18, .89, .32, 1.28);
        }
        @keyframes popInSuccess {
            0%   { transform: scale(.85); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .success-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 28px 20px 22px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .success-header::before,
        .success-header::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .08);
        }
        .success-header::before { width: 120px; height: 120px; top: -50px; right: -30px; }
        .success-header::after  { width: 80px;  height: 80px;  bottom: -30px; left: -20px; }
        .success-checkmark {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .15);
            position: relative;
            z-index: 2;
        }
        .success-checkmark i {
            font-size: 32px;
            color: #10b981;
        }
        .success-header h2 {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 4px;
            position: relative;
            z-index: 2;
        }
        .success-header p {
            color: rgba(255, 255, 255, .9);
            font-size: 13px;
            margin: 0;
            position: relative;
            z-index: 2;
        }
        .success-body {
            padding: 22px 24px 24px;
            text-align: center;
        }
        .success-body p {
            color: #475569;
            font-size: 14px;
            margin: 0 0 4px;
            line-height: 1.5;
        }
        .success-body .success-note {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 6px;
        }
        .success-close-btn {
            width: 100%;
            margin-top: 18px;
            padding: 12px;
            background: #e11d48;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s ease;
        }
        .success-close-btn:hover {
            background: #be123c;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(225, 29, 72, .3);
        }

        /* ============ EVENT DETAILS MODAL ============ */
        .event-modal {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .65);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
        }
        .event-modal.active {
            display: flex;
        }
        .event-modal-box {
            background: #ffffff;
            border-radius: 16px;
            width: 100%;
            max-width: 1100px;
            max-height: 92vh;
            overflow: hidden;
            position: relative;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        }
        .event-scroll {
            max-height: 92vh;
            overflow-y: auto;
        }
        .modal-close {
            position: absolute;
            top: 14px;
            right: 18px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .9);
            border: none;
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
            color: #1e293b;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
            transition: all .2s;
        }
        .modal-close:hover {
            background: #e11d48;
            color: #ffffff;
        }

        /* ============ REGISTRATION MODAL VISIBILITY ============ */
        #registrationModal.active,
        #registrationModal[style*="display: flex"],
        #registrationModal[style*="display:flex"] {
            display: flex !important;
        }

        /* ============ FORM HELPERS ============ */
        .form-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        /* ============================================================================
           MOBILE NAVIGATION — Drawer only (NO overlay)
           ============================================================================ */
        .mobile-menu-btn,
        .mobile-nav-close,
        .mobile-only-actions {
            display: none;
        }

        @media (max-width: 991px) {

            html, body {
                overflow-x: hidden !important;
            }

            /* ---- HEADER ---- */
            .header {
                position: sticky !important;
                top: 0 !important;
                z-index: 1000 !important;
            }
            .header .nav-container {
                height: 70px !important;
                padding: 0 16px !important;
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                gap: 10px !important;
            }
            .header .logo {
                height: 70px !important;
                flex-shrink: 0 !important;
            }
            .header .logo img {
                max-height: 56px !important;
                width: auto !important;
            }
            .header .nav-actions {
                display: none !important;
            }

            /* ---- HAMBURGER BUTTON ---- */
            .mobile-menu-btn {
                display: inline-flex !important;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 10px;
                background: #fff;
                border: 1.5px solid #e2e8f0;
                color: #1c2541;
                font-size: 20px;
                cursor: pointer;
                margin-left: auto;
                padding: 0;
                transition: all 0.2s ease;
                flex-shrink: 0;
            }
            .mobile-menu-btn:hover {
                background: #6bad3f;
                color: #fff;
                border-color: #6bad3f;
            }

            /* ---- DRAWER ---- */
            #mainNavLinks {
                position: fixed !important;
                top: 0 !important;
                right: -100% !important;
                width: 82% !important;
                max-width: 340px !important;
                height: 100vh !important;
                background: #ffffff !important;
                background-color: #ffffff !important;
                display: flex !important;
                flex-direction: column !important;
                align-items: stretch !important;
                justify-content: flex-start !important;
                padding: 76px 22px 22px !important;
                margin: 0 !important;
                gap: 2px !important;
                box-shadow: -10px 0 40px rgba(11, 19, 43, 0.35) !important;
                transition: right 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
                overflow-y: auto !important;
                overflow-x: hidden !important;
                z-index: 99999 !important;
                filter: none !important;
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
                opacity: 1 !important;
            }

            #mainNavLinks.mobile-open {
                right: 0 !important;
            }

            /* ---- NAV LINKS ---- */
            #mainNavLinks > a,
            #mainNavLinks .nav-link {
                display: block !important;
                width: 100% !important;
                padding: 14px 16px !important;
                font-size: 15px !important;
                font-weight: 600 !important;
                color: #1c2541 !important;
                text-align: left !important;
                border-radius: 10px !important;
                border-bottom: 1px solid #f1f5f9 !important;
                white-space: normal !important;
                background: #ffffff !important;
                background-color: #ffffff !important;
                filter: none !important;
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
                opacity: 1 !important;
            }
            #mainNavLinks > a:hover,
            #mainNavLinks .nav-link:hover,
            #mainNavLinks .nav-link.active {
                background: #f0fdf4 !important;
                background-color: #f0fdf4 !important;
                color: #6bad3f !important;
            }

            /* ---- MOBILE-ONLY ACTIONS ---- */
            #mainNavLinks .mobile-only-actions {
                display: flex !important;
                flex-direction: column !important;
                gap: 10px !important;
                margin-top: 20px !important;
                padding-top: 20px !important;
                border-top: 1px solid #f1f5f9 !important;
                width: 100% !important;
                background: #ffffff !important;
                background-color: #ffffff !important;
            }

            /* ---- CLOSE BUTTON ---- */
            #mobileNavClose {
                display: inline-flex !important;
                position: absolute !important;
                top: 16px !important;
                right: 16px !important;
                width: 38px !important;
                height: 38px !important;
                border-radius: 50% !important;
                background: #f1f5f9 !important;
                border: none !important;
                color: #1c2541 !important;
                font-size: 20px !important;
                cursor: pointer !important;
                align-items: center !important;
                justify-content: center !important;
                z-index: 100000 !important;
                padding: 0 !important;
                filter: none !important;
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
            }
            #mobileNavClose:hover {
                background: #e11d48 !important;
                color: #fff !important;
            }

            /* ---- BODY LOCK ---- */
            body.mobile-nav-open {
                overflow: hidden !important;
            }

            /* ---- HERO ---- */
            .hero {
                padding: 45px 0 90px !important;
                text-align: center !important;
            }
            .hero-title {
                font-size: 40px !important;
                line-height: 1.1 !important;
            }
            .hero-description {
                font-size: 14px !important;
            }
            .hero-description br {
                display: none !important;
            }
            .hero-btns {
                display: flex !important;
                flex-direction: row !important;
                justify-content: center !important;
                flex-wrap: wrap !important;
                gap: 10px !important;
            }

            /* ---- FILTER BOX ---- */
            .filter-container {
                position: relative !important;
                bottom: auto !important;
                margin-top: 20px !important;
                padding: 0 16px !important;
            }
            .filter-box {
                display: grid !important;
                grid-template-columns: 1fr 1fr !important;
                gap: 12px !important;
                padding: 16px !important;
                border-radius: 14px !important;
            }
            .filter-item {
                width: 100% !important;
                flex: 1 1 100% !important;
                border-right: none !important;
                border-bottom: none !important;
                padding-right: 0 !important;
                margin-right: 0 !important;
                min-width: 0 !important;
            }
            .filter-item > div {
                width: 100% !important;
                min-width: 0 !important;
            }
            .filter-item select,
            .filter-item input {
                width: 100% !important;
                min-width: 0 !important;
            }
            .filter-box .btn-search {
                grid-column: span 2 !important;
                width: 100% !important;
                justify-content: center !important;
            }

            /* ---- STATS ---- */
            .stats-section {
                padding: 60px 0 40px !important;
            }
            .stats-grid {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow: hidden !important;
                gap: 20px !important;
                transition: transform 0.5s ease !important;
            }
            .stat-card {
                flex: 0 0 100% !important;
                min-width: 100% !important;
                max-width: 100% !important;
            }

            /* ---- EVENTS SLIDER ---- */
            .events-section {
                padding: 40px 0 !important;
            }
            .events-section .section-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 10px !important;
            }
            .unique-slider-wrap {
                overflow: hidden !important;
                width: 100% !important;
                padding: 0 8px !important;
            }
            .unique-track {
                display: flex !important;
                gap: 14px !important;
                width: max-content !important;
                will-change: transform !important;
                cursor: grab !important;
                user-select: none !important;
                touch-action: pan-y !important;
                padding: 6px 4px !important;
            }
            .unique-track:active {
                cursor: grabbing !important;
            }
            .unique-card {
                flex: 0 0 calc(100vw - 60px) !important;
                width: calc(100vw - 60px) !important;
                min-width: calc(100vw - 60px) !important;
                max-width: calc(100vw - 60px) !important;
            }

            /* ---- FEATURES ---- */
            .features-section { padding: 40px 0 !important; }
            .features-grid { display: block !important; }
            .features-header {
                text-align: center !important;
                margin-bottom: 20px !important;
            }
            .features-header h2 {
                font-size: 22px !important;
                line-height: 1.25 !important;
            }
            .features-header h2 br { display: none !important; }
            .features-boxes {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 12px !important;
            }

            /* ---- STEPS ---- */
            .steps-section { padding: 40px 0 !important; }
            .steps-grid {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 16px !important;
            }

            /* ---- BANNER ---- */
            .banner-section {
                height: auto !important;
                min-height: 260px !important;
                padding: 40px 0 !important;
            }
            .banner-content-wrapper { justify-content: center !important; }
            .banner-content-right {
                width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
                text-align: center !important;
            }
            .banner-title { font-size: 22px !important; }
            .banner-title br { display: none !important; }
            .banner-desc { font-size: 13px !important; }
            .banner-desc br { display: none !important; }
            .btn-join-movement { margin: 0 auto !important; }

            /* ---- PARTNERS ---- */
            .partners-logos {
                display: grid !important;
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 14px !important;
            }

            /* ---- GALLERY ---- */
            .gallery-grid {
                display: grid !important;
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 10px !important;
            }
            .gallery-grid img { height: 110px !important; }

            /* ---- CTA ---- */
            .cta-banner {
                height: auto !important;
                padding: 30px 0 !important;
            }
            .cta-content-wrapper {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 18px !important;
            }
            .cta-text h2 { font-size: 22px !important; }
            .cta-text h2 br { display: none !important; }
            .btn-cta {
                width: 100% !important;
                justify-content: center !important;
            }

            /* ---- FOOTER ---- */
            .footer-top {
                flex-direction: column !important;
                gap: 22px !important;
                text-align: center !important;
            }
            .footer-links {
                flex-wrap: wrap !important;
                justify-content: center !important;
                gap: 12px 18px !important;
            }
            .footer-contact { text-align: center !important; }
            .social-icons { justify-content: center !important; }
            .footer-bottom {
                flex-direction: column !important;
                gap: 8px !important;
                text-align: center !important;
            }

            /* ---- EVENT MODAL ---- */
            .event-modal { padding: 8px !important; }
            .event-modal-box {
                max-height: 96vh !important;
                border-radius: 12px !important;
            }
            .event-scroll { max-height: 96vh !important; }
        }

        /* ============================================================================
           MOBILE PHONE (≤ 768px)
           ============================================================================ */
        @media (max-width: 768px) {
            .header .nav-container { height: 62px !important; }
            .header .logo,
            .header .logo img {
                height: 60px !important;
                max-height: 48px !important;
            }
            .hero { padding: 30px 0 70px !important; }
            .hero-title { font-size: 32px !important; }
            .hero-subtitle {
                font-size: 11px !important;
                letter-spacing: 1px !important;
            }
            .hero-description {
                font-size: 13px !important;
                line-height: 1.55 !important;
            }
            .hero-btns {
                flex-direction: column !important;
                align-items: stretch !important;
            }
            .hero-btns a {
                width: 100% !important;
                justify-content: center !important;
            }
            .filter-box {
                grid-template-columns: 1fr !important;
                padding: 14px !important;
            }
            .filter-box .btn-search { grid-column: span 1 !important; }
            .stats-grid { gap: 14px !important; }
            .stat-card { padding: 16px !important; }
            .stat-info h3 { font-size: 24px !important; }
            .unique-card {
                flex: 0 0 calc(100vw - 48px) !important;
                width: calc(100vw - 48px) !important;
                min-width: calc(100vw - 48px) !important;
                max-width: calc(100vw - 48px) !important;
            }
            .unique-card .event-img img { height: 190px !important; }
            .action-buttons { flex-direction: column !important; }
            .action-buttons .btn-primary { width: 100% !important; }
            .features-boxes { grid-template-columns: 1fr !important; }
            .steps-grid { grid-template-columns: 1fr !important; }
            .step-card {
                background: #fff;
                padding: 16px;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            }
            .banner-section {
                min-height: 220px !important;
                padding: 30px 0 !important;
            }
            .banner-title { font-size: 20px !important; }
            .partners-logos {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 12px !important;
            }
            .logo-item { font-size: 11px !important; }
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 8px !important;
            }
            .gallery-grid img { height: 140px !important; }
            .cta-text h2 { font-size: 20px !important; }
            .cta-text p { font-size: 12px !important; }
            .event-modal { padding: 6px !important; }

            /* EVENT PAGE */
            .ev-hero-title { font-size: 28px !important; }
            .ev-section-title { font-size: 22px !important; }
            .ev-section-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 8px !important;
            }
            .ev-main-event-card { flex-direction: column !important; }
            .ev-event-left-box,
            .ev-widget-right-box { width: 100% !important; }
            .ev-event-left-box {
                border-right: none !important;
                border-bottom: 1px dashed #e9ecef !important;
            }
            .ev-event-img-wrap { height: 240px !important; }
            .ev-meta-grid {
                flex-direction: column !important;
                gap: 12px !important;
            }
            .ev-category-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
            .ev-past-grid { grid-template-columns: 1fr !important; }
            .ev-steps-container {
                flex-direction: column !important;
                gap: 20px !important;
            }
            .ev-step-arrow { transform: rotate(90deg) !important; }

            /* REGISTER MODAL */
            .modal-overlay { padding: 0 !important; }
            .modal-container {
                max-width: 100% !important;
                height: 100% !important;
                max-height: 100vh !important;
                border-radius: 0 !important;
            }
            .form-grid-2 { grid-template-columns: 1fr !important; }
            .banner-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 10px !important;
            }
            .brand-section {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 10px !important;
            }
            .logo-area {
                border-right: none !important;
                padding-right: 0 !important;
            }
            .official-entry-badge { align-self: flex-start !important; }
        }

        /* ============================================================================
           SMALL PHONE (≤ 480px)
           ============================================================================ */
        @media (max-width: 480px) {
            .header .nav-container { padding: 0 12px !important; }
            .hero-title { font-size: 26px !important; }
            .section-title { font-size: 20px !important; }
            .events-section .section-title,
            .gallery-section .section-title { font-size: 20px !important; }
            .unique-card {
                flex: 0 0 calc(100vw - 40px) !important;
                width: calc(100vw - 40px) !important;
                min-width: calc(100vw - 40px) !important;
                max-width: calc(100vw - 40px) !important;
            }
            .stat-info h3 { font-size: 22px !important; }
            .banner-title { font-size: 18px !important; }
            .partners-logos { grid-template-columns: 1fr !important; }
            .gallery-grid { grid-template-columns: 1fr !important; }
            .gallery-grid img { height: 180px !important; }
            .cta-text h2 { font-size: 18px !important; }
            .ev-hero-title { font-size: 24px !important; }
            .ev-event-img-wrap { height: 200px !important; }
            .ev-category-grid { grid-template-columns: 1fr 1fr !important; }
            #mainNavLinks { width: 90% !important; }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

    
    <header class="header">
        <div class="container nav-container">
            <a href="<?php echo e(route('home')); ?>" class="logo">
                <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Run Burjowan">
            </a>

            
            <button type="button" class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            
            <nav class="nav-links" id="mainNavLinks">
                <button type="button" class="mobile-nav-close" id="mobileNavClose" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Home</a>
                <a class="nav-link <?php echo e(request()->routeIs('event') ? 'active' : ''); ?>" href="<?php echo e(route('event')); ?>">Events</a>
                <a class="nav-link <?php echo e(request()->routeIs('about') ? 'active' : ''); ?>" href="<?php echo e(route('about')); ?>">About</a>
                <a class="nav-link <?php echo e(request()->routeIs('activity') ? 'active' : ''); ?>" href="<?php echo e(route('activity')); ?>">Activities</a>
                <a class="nav-link <?php echo e(request()->routeIs('blog') ? 'active' : ''); ?>" href="<?php echo e(route('blog')); ?>">Blog</a>
                <a class="nav-link <?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>" href="<?php echo e(route('contact')); ?>">Contact</a>
                <a href="#">Results</a>
                <a class="nav-link <?php echo e(request()->routeIs('gallery') ? 'active' : ''); ?>" href="<?php echo e(route('gallery')); ?>">Gallery</a>

                <div class="mobile-only-actions">
                    <a href="#" class="btn-login" style="display:block; text-align:center; padding:10px; border:1px solid #cbd5e1; border-radius:10px; color:#1c2541; font-weight:600; text-decoration:none;">Login</a>
                    <a href="#" class="btn-primary" style="display:block; text-align:center; padding:10px; border-radius:10px; color:#fff; font-weight:600; text-decoration:none; background:#6bad3f;">Join Us</a>
                </div>
            </nav>

            
            <div class="nav-actions">
                <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                <a href="#" class="btn-login">Login</a>
                <a href="#" class="btn-primary">Join Us</a>
            </div>
        </div>
    </header>

    
    <?php echo $__env->yieldContent('body'); ?>

    
    <section class="cta-banner" style="background-image: url('<?php echo e(asset('img/home3.jpg')); ?>');">
        <div class="cta-overlay"></div>
        <div class="cta-brush-left"></div>

        <div class="container cta-content-wrapper">
            <div class="cta-text">
                <h2>Your Next Finish Line<br><span class="highlight">Starts Here</span></h2>
                <p>Be part of the journey. Register for upcoming events and take the first step towards a healthier, stronger you.</p>
            </div>
            <a href="<?php echo e(route('event')); ?>" class="btn-cta">
                Explore Events <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>

    
    <div class="event-modal" id="indexEventModal">
        <div class="event-modal-box">
            <button class="modal-close" onclick="closeEventModal()">&times;</button>
            <div class="event-scroll" id="eventModalContent">
                <div style="padding: 60px 20px; text-align: center; color: #999;">
                    <i class="fa-solid fa-spinner fa-spin" style="font-size: 32px;"></i>
                    <p style="margin-top: 12px; font-size: 14px;">Loading event details...</p>
                </div>
            </div>
        </div>
    </div>

    
    <div id="shareModal"
        style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.6); z-index:9999; align-items:center; justify-content:center; padding:16px;">
        <div style="background:#fff; padding:20px; border-radius:12px; width:340px; max-width:100%; text-align:center; position:relative;">
            <span id="closeShare" style="position:absolute; right:12px; top:8px; cursor:pointer; font-size:20px;">&times;</span>
            <h3 style="margin-bottom:14px;">Share Event</h3>

            <div style="display:flex; flex-direction:column; gap:10px;">
                <a id="shareFb" target="_blank" class="btn-primary full-width" style="background:#1877f2;">Facebook</a>
                <a id="shareWa" target="_blank" class="btn-primary full-width" style="background:#25d366;">WhatsApp</a>
                <a id="shareLi" target="_blank" class="btn-primary full-width" style="background:#0a66c2;">LinkedIn</a>
                <a id="shareTw" target="_blank" class="btn-primary full-width" style="background:#000;">X (Twitter)</a>
                <button id="copyLink" class="btn-primary full-width" style="background:#555;">Copy Link</button>
            </div>

            <p id="copyMsg" style="color:green; font-size:13px; margin-top:8px; display:none;">Link copied!</p>
        </div>
    </div>

    
    <div id="successModal">
        <div class="success-card">
            <div class="success-header">
                <div class="success-checkmark">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h2>Registration Successful!</h2>
                <p>Your spot has been reserved</p>
            </div>
            <div class="success-body">
                <p id="successMessage">Your registration has been received.</p>
                <p class="success-note">We'll review your payment and notify you shortly.</p>
                <button type="button" class="success-close-btn" id="successCloseBtn">
                    <i class="fa-solid fa-check"></i> &nbsp;Great, Got It!
                </button>
            </div>
        </div>
    </div>

    
    <?php echo $__env->make('registration-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <footer class="footer">
        <div class="container footer-top">
            <div class="footer-brand">
                <a href="<?php echo e(route('home')); ?>" class="logo">
                    <img src="<?php echo e(asset('img/logo2.png')); ?>" alt="Run Burjowan">
                </a>
            </div>

            <div class="footer-links">
                <a href="<?php echo e(route('home')); ?>">Home</a>
                <a href="<?php echo e(route('event')); ?>">Events</a>
                <a href="<?php echo e(route('activity')); ?>">Activities</a>
                <a href="<?php echo e(route('about')); ?>">About</a>
                <a href="<?php echo e(route('blog')); ?>">Blog</a>
                <a href="<?php echo e(route('contact')); ?>">Contact</a>
                <a href="#">Results</a>
                <a href="<?php echo e(route('gallery')); ?>">Gallery</a>
            </div>

            <div class="footer-contact">
                <div class="social-icons">
                    <a href="https://www.facebook.com/RunBujowan" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <p><i class="fa-regular fa-envelope"></i> info@runburjowan.com</p>
                <p><i class="fa-solid fa-phone"></i> +880 19 1146 9861</p>
                <p><i class="fa-solid fa-phone"></i> +880 17 1154 3414</p>
                <p><i class="fa-solid fa-phone"></i> +880 17 1180 8026</p>
                <p><i class="fa-solid fa-location-dot"></i> Dhaka, Bangladesh</p>
            </div>
        </div>

        <div class="container footer-bottom">
            <p><span id="year"></span> Run Burjowan. All rights reserved.</p>
            <p>Running Together for a Healthier Tomorrow</p>
        </div>
    </footer>

    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    
    <?php echo $__env->make('event-details-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script>
        $(function () {
            'use strict';

            /* ====================================================
             * 1. YEAR
             * ==================================================== */
            $('#year').text(new Date().getFullYear());


            /* ====================================================
             * 2. MOBILE NAVIGATION — Drawer only (no overlay)
             * ==================================================== */
            const $navLinks = $('#mainNavLinks');

            function openMobileNav() {
                $navLinks.addClass('mobile-open');
                $('body').addClass('mobile-nav-open');
            }

            function closeMobileNav() {
                $navLinks.removeClass('mobile-open');
                $('body').removeClass('mobile-nav-open');
            }

            // Open hamburger
            $(document).off('click.navOpen').on('click.navOpen', '#mobileMenuBtn', function (e) {
                e.preventDefault();
                e.stopPropagation();
                openMobileNav();
            });

            // Close X button
            $(document).off('click.navClose').on('click.navClose', '#mobileNavClose', function (e) {
                e.preventDefault();
                e.stopPropagation();
                closeMobileNav();
            });

            // Close on nav link click
            $(document).off('click.navLink').on('click.navLink', '#mainNavLinks a', function () {
                if (window.innerWidth <= 991) {
                    closeMobileNav();
                }
            });

            // ESC key
            $(document).off('keydown.navEsc').on('keydown.navEsc', function (e) {
                if (e.key === 'Escape') {
                    closeMobileNav();
                }
            });

            // Click outside drawer to close
            $(document).off('click.navOutside').on('click.navOutside', function (e) {
                if (!$('body').hasClass('mobile-nav-open')) return;

                const $target = $(e.target);
                if ($target.closest('#mainNavLinks').length) return;
                if ($target.closest('#mobileMenuBtn').length) return;

                closeMobileNav();
            });

            // Reset on resize to desktop
            $(window).off('resize.navReset').on('resize.navReset', function () {
                if (window.innerWidth > 991) {
                    closeMobileNav();
                }
            });


            /* ====================================================
             * 3. REGISTRATION MODAL — OPEN / CLOSE
             * ==================================================== */
            const $regModal = $('#registrationModal');

            $(document).on('click', '.openRegModal', function (e) {
                e.preventDefault();
                const evId = $(this).data('event-id');
                if (evId) $('#event_id_field').val(evId);
                $regModal.addClass('active');
            });

            $(document).on('click', '#closeRegModal', function () {
                $regModal.removeClass('active').css('display', '');
            });

            $regModal.on('click', function (e) {
                if (e.target === this) {
                    $(this).removeClass('active').css('display', '');
                }
            });

            $(document).on('keydown', function (e) {
                if (e.key === 'Escape') {
                    $regModal.removeClass('active').css('display', '');
                }
            });


          /* ============================================================
   PROFILE IMAGE DROPZONE
   ============================================================ */
(function () {
    'use strict';

    const $dropzone = $('#profile_dropzone');
    const $input    = $('#profile_image_input');
    const $preview  = $('#profile_preview_img');
    const $icon     = $('#profile_placeholder_icon');
    const $remove   = $('#profile_remove_btn');
    const $error    = $('#profile_error');
    const $title    = $('#profile_upload_text');
    const $chip     = $('#profile_action_chip');

    if (!$dropzone.length || !$input.length) {
        return;
    }

    const MAX_SIZE = 50 * 1024 * 1024; // 50 MB

    // ----------------------------------------------------------
    // FLAG: prevent re-entrant clicks (input → bubble → dropzone → input...)
    // ----------------------------------------------------------
    let filePickerOpening = false;

    // ----------------------------------------------------------
    // CLICK on dropzone → open file picker (with loop protection)
    // ----------------------------------------------------------
    $dropzone.on('click', function (e) {

        // Ignore if click came from remove button
        if ($(e.target).closest('#profile_remove_btn').length) {
            return;
        }

        // Ignore if click originated from the file input itself
        if (e.target === $input[0]) {
            return;
        }

        // Prevent re-entrant call
        if (filePickerOpening) {
            return;
        }

        e.preventDefault();
        e.stopPropagation();

        filePickerOpening = true;

        try {
            $input[0].click();   // native click, not jQuery .trigger()
        } finally {
            // Reset after short delay
            setTimeout(function () {
                filePickerOpening = false;
            }, 300);
        }
    });

    // ----------------------------------------------------------
    // Explicitly stop propagation on input's own click
    // (so it never bubbles back to dropzone)
    // ----------------------------------------------------------
    $input.on('click', function (e) {
        e.stopPropagation();
    });

    // ----------------------------------------------------------
    // HOVER EFFECTS
    // ----------------------------------------------------------
    $dropzone.on('mouseenter', function () {
        $(this).css({
            borderColor: '#e11d48',
            background:  'linear-gradient(135deg,#fff5f7 0%,#ffe4e9 100%)',
            boxShadow:   '0 6px 20px rgba(225,29,72,.12)'
        });
        $chip.css({ background: '#e11d48', color: '#fff', borderColor: '#e11d48' });
    }).on('mouseleave', function () {
        $(this).css({
            borderColor: '#fbcfe8',
            background:  'linear-gradient(135deg,#fff 0%,#fff5f7 100%)',
            boxShadow:   'none'
        });
        $chip.css({ background: '#fff', color: '#e11d48', borderColor: '#fbcfe8' });
    });

    // ----------------------------------------------------------
    // DRAG & DROP
    // ----------------------------------------------------------
    $dropzone.on('dragenter dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).css({
            borderColor: '#e11d48',
            borderStyle: 'solid',
            background:  'linear-gradient(135deg,#ffe4e9 0%,#fbcfe8 100%)'
        });
    });

    $dropzone.on('dragleave drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).css({
            borderColor: '#fbcfe8',
            borderStyle: 'dashed',
            background:  'linear-gradient(135deg,#fff 0%,#fff5f7 100%)'
        });
    });

    $dropzone.on('drop', function (e) {
        const dt = e.originalEvent.dataTransfer;
        if (dt && dt.files && dt.files.length) {
            handleFile(dt.files[0]);
        }
    });

    // ----------------------------------------------------------
    // FILE INPUT CHANGE
    // ----------------------------------------------------------
    $input.on('change', function () {
        if (this.files && this.files.length) {
            handleFile(this.files[0]);
        }
    });

    // ----------------------------------------------------------
    // REMOVE BUTTON
    // ----------------------------------------------------------
    $remove.on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        resetUploader();
    });

    // ----------------------------------------------------------
    // HANDLE FILE
    // ----------------------------------------------------------
    function handleFile(file) {
        $error.hide().text('');

        if (!file.type.startsWith('image/')) {
            showError('Please select a valid image (JPG, PNG, WEBP).');
            return;
        }

        if (file.size > MAX_SIZE) {
            const mb = (file.size / (1024 * 1024)).toFixed(2);
            showError('Image is too large (' + mb + ' MB). Maximum is 50 MB.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function (ev) {
            $preview.attr('src', ev.target.result).css('display', 'block');
            $icon.hide();
            $remove.css('display', 'flex');
            $title.text(file.name.length > 34 ? file.name.slice(0, 31) + '…' : file.name);
            $chip.text('Change');
            $dropzone.css({ borderStyle: 'solid', borderColor: '#e11d48' });
        };
        reader.readAsDataURL(file);
    }

    function showError(msg) {
        $error.text(msg).css('display', 'block');
        $input.val('');
    }

    function resetUploader() {
        $input.val('');
        $preview.attr('src', '').css('display', 'none');
        $icon.css('display', 'block');
        $remove.css('display', 'none');
        $title.text('Click to upload or drag & drop');
        $chip.text('Browse');
        $dropzone.css({ borderStyle: 'dashed', borderColor: '#fbcfe8' });
        $error.hide().text('');
    }

    // Expose globally for AJAX reset
    window.resetProfileUploader = resetUploader;

})();


            /* ====================================================
             * 5. REGISTRATION FORM — AJAX SUBMIT
             * ==================================================== */
            const $regForm      = $('#registrationForm');
            const $submitBtn    = $('#submitBtn');
            const $btnText      = $('#submitBtnText');
            const $btnSpinner   = $('#submitBtnSpinner');
            const $successModal = $('#successModal');
            const $successMsg   = $('#successMessage');
            const $successClose = $('#successCloseBtn');

            $successClose.on('click', function () {
                $successModal.removeClass('show').hide();
            });

            $regForm.on('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Please check your information carefully. Once submitted, it cannot be changed!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3a8908',
                    cancelButtonColor: '#e11d48',
                    confirmButtonText: 'Yes, Submit!',
                    cancelButtonText: 'No, Review'
                }).then(function (result) {
                    if (!result.isConfirmed) return;

                    clearFieldErrors();
                    setLoading(true);

                    const formEl = $regForm[0];
                    const formData = new FormData(formEl);
                    const csrfToken = $regForm.find('input[name="_token"]').val();

                    fetch(formEl.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: formData,
                    })
                    .then(function (response) {
                        return response.json()
                            .then(function (data) { return { response: response, data: data }; })
                            .catch(function (parseErr) {
                                console.error('Invalid JSON response:', parseErr);
                                return { response: response, data: null };
                            });
                    })
                    .then(function (res) {
                        const response = res.response;
                        const data = res.data;

                        if (!data) {
                            setLoading(false);
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Something went wrong on the server. Check Laravel logs.',
                                confirmButtonColor: '#e11d48',
                            });
                            return;
                        }

                        if (response.status === 422) {
                            displayErrors(data.errors || {});
                            setLoading(false);
                            scrollToFirstError();

                            const firstError = (Object.values(data.errors || {})[0] || [])[0] || 'Please fix the highlighted fields.';

                            Swal.fire({
                                icon: 'warning',
                                title: 'Validation Error',
                                text: firstError,
                                confirmButtonColor: '#e11d48',
                                confirmButtonText: 'Fix Now',
                            });
                            return;
                        }

                        if (!response.ok) {
                            setLoading(false);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: data.message || 'Something went wrong. Please try again.',
                                confirmButtonColor: '#e11d48',
                            });
                            return;
                        }

                        if (data.success) {
                            setLoading(false);

                            $successMsg.text(data.message || 'Your registration has been received.');
                            $successModal.addClass('show');

                            formEl.reset();
                            if (typeof window.resetProfileUploader === 'function') {
                                window.resetProfileUploader();
                            }

                            $regModal.removeClass('active').css('display', '');
                        } else {
                            setLoading(false);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Unknown error.',
                                confirmButtonColor: '#e11d48',
                            });
                        }
                    })
                    .catch(function (err) {
                        console.error('Fetch error:', err);
                        setLoading(false);
                        Swal.fire({
                            icon: 'error',
                            title: 'Network Error',
                            text: 'Please check your connection and try again.',
                            confirmButtonColor: '#e11d48',
                        });
                    });
                });
            });

            function setLoading(isLoading) {
                if (!$submitBtn.length) return;
                $submitBtn.prop('disabled', isLoading).css('cursor', isLoading ? 'not-allowed' : 'pointer');
                $btnText.css('opacity', isLoading ? '.5' : '1');
                $btnSpinner.css('display', isLoading ? 'inline-block' : 'none');
            }

            function displayErrors(errors) {
                Object.keys(errors).forEach(function (field) {
                    const $inputs = $regForm.find('[name="' + field + '"]');
                    if (!$inputs.length) return;

                    const $wrapper = $inputs.first().closest('.form-group');
                    const $target = $wrapper.length ? $wrapper : $inputs.first().parent();

                    $inputs.css({
                        borderColor: '#ef4444',
                        boxShadow: '0 0 0 2px rgba(239,68,68,.15)'
                    });

                    let $err = $target.find('.field-error');
                    if (!$err.length) {
                        $err = $('<small class="field-error"></small>').css({
                            display: 'block',
                            color: '#ef4444',
                            fontSize: '11px',
                            marginTop: '4px',
                            fontWeight: 500
                        }).appendTo($target);
                    }
                    $err.text(errors[field][0]);
                });
            }

            function clearFieldErrors() {
                $regForm.find('.field-error').remove();
                $regForm.find('input, select, textarea').css({ borderColor: '', boxShadow: '' });
            }

            function scrollToFirstError() {
                const $first = $regForm.find('.field-error').first();
                if ($first.length) {
                    $('html, body').animate({ scrollTop: $first.offset().top - 120 }, 400);
                }
            }


            /* ====================================================
             * 6. PROCEED REGISTRATION BUTTON
             * ==================================================== */
            $(document).on('click', '.proceedRegistrationBtn', function (e) {
                e.preventDefault();

                const $btn = $(this);
                const title = $btn.data('title') || 'Event';
                const eventId = $btn.data('event_id') || '';
                const fallbackPrice = $btn.data('price') || '0';

                let categories = [];
                try {
                    categories = JSON.parse($btn.attr('data-categories') || '[]');
                } catch (err) {
                    categories = [];
                }

                if (!categories.length) {
                    categories = [{
                        distance: 'General',
                        name: 'General',
                        fee: parseFloat(fallbackPrice) || 0,
                    }];
                }

                const radiosHtml = categories.map(function (cat, idx) {
                    const label = cat.name + ' (' + cat.distance + ')';
                    const fee = parseFloat(cat.fee).toLocaleString();
                    const id = 'cat_' + idx;

                    return '' +
                        '<label for="' + id + '" ' +
                        '   style="display:flex; align-items:center; gap:12px; padding:12px 14px; margin-bottom:8px; cursor:pointer;' +
                        '          border:2px solid #e2e8f0; border-radius:10px; background:#fff; transition:all .2s;" ' +
                        '   onmouseover="this.style.borderColor=\'#0284c7\'; this.style.background=\'#f0f9ff\';" ' +
                        '   onmouseout="if(!this.querySelector(\'input\').checked){this.style.borderColor=\'#e2e8f0\'; this.style.background=\'#fff\';}">' +
                        '  <input type="radio" name="selected_category" value="' + idx + '" id="' + id + '" ' +
                        '         ' + (idx === 0 ? 'checked' : '') + ' ' +
                        '         style="accent-color:#0284c7; width:18px; height:18px; cursor:pointer;" ' +
                        '         data-fee="' + cat.fee + '" ' +
                        '         data-distance="' + cat.distance + '" ' +
                        '         data-name="' + cat.name + '">' +
                        '  <div style="flex:1; text-align:left;">' +
                        '    <div style="font-weight:700; color:#1e293b; font-size:14px;">' + label + '</div>' +
                        '  </div>' +
                        '  <div style="font-weight:800; color:#0284c7; font-size:15px; white-space:nowrap;">' +
                        '    BDT ' + fee +
                        '  </div>' +
                        '</label>';
                }).join('');

                Swal.fire({
                    title: '<span style="color: #0284c7;">Select Your Category</span>',
                    html: '' +
                        '<div style="text-align:left; color:#475569; font-size:14px; line-height:1.6;">' +
                        '  <p style="margin-bottom:12px;">' +
                        '    <strong style="color:#102c55;">Event:</strong> ' + title +
                        '  </p>' +
                        '  <p style="margin-bottom:8px; font-weight:700; color:#1e293b; font-size:13px;">' +
                        '    Choose your race category:' +
                        '  </p>' +
                        '  <div id="categoryListContainer">' + radiosHtml + '</div>' +
                        '  <div style="margin-top:14px; padding:12px;' +
                        '              background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 100%);' +
                        '              border-radius:10px; border:1px solid #bae6fd;">' +
                        '    <p style="margin:0; font-size:13px; color:#0c4a6e;">' +
                        '      <strong>Payment:</strong> Send the fee to bKash or Nagad' +
                        '      (<strong style="color:#0284c7;">+880 1911469861</strong>) ' +
                        '      first. You\'ll need the last 3 digits of sender\'s number and the Transaction ID.' +
                        '    </p>' +
                        '  </div>' +
                        '</div>',
                    background: '#f0f9ff',
                    icon: 'info',
                    iconColor: '#0284c7',
                    width: 500,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fa-solid fa-arrow-right"></i> Continue to Register',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#0284c7',
                    cancelButtonColor: '#64748b',
                    reverseButtons: true,
                    focusConfirm: false,

                    didOpen: function () {
                        $('#categoryListContainer input[name="selected_category"]').each(function () {
                            const $radio = $(this);
                            if ($radio.is(':checked')) {
                                highlightLabel($radio);
                            }
                            $radio.on('change', function () {
                                $('#categoryListContainer label').css({
                                    borderColor: '#e2e8f0',
                                    background: '#ffffff',
                                    boxShadow: 'none'
                                });
                                highlightLabel($radio);
                            });
                        });

                        function highlightLabel($radio) {
                            $radio.closest('label').css({
                                borderColor: '#0284c7',
                                background: '#f0f9ff',
                                boxShadow: '0 0 0 3px rgba(2,132,199,0.1)'
                            });
                        }
                    },

                    preConfirm: function () {
                        const $selected = $('#categoryListContainer input[name="selected_category"]:checked');
                        if (!$selected.length) {
                            Swal.showValidationMessage('Please select a category');
                            return false;
                        }
                        return {
                            fee: parseFloat($selected.data('fee')),
                            distance: String($selected.data('distance')),
                            name: String($selected.data('name')),
                        };
                    }
                }).then(function (result) {
                    if (!result.isConfirmed || !result.value) return;

                    const fee = result.value.fee;
                    const distance = result.value.distance;
                    const name = result.value.name;

                    const $modal = $('#registrationModal');
                    if (!$modal.length) {
                        console.error('Registration modal not found');
                        return;
                    }

                    $modal.addClass('active').css('display', 'flex');

                    $modal.find('#event_id_field, [name="event_id"]').val(eventId);
                    $modal.find('#eventPrice, [name="event_price"]').val(Number(fee).toLocaleString());

                    const $catSelect = $modal.find('select[name="category"]');
                    if ($catSelect.length) {
                        let optionsHtml = '<option value="" disabled>Select Category</option>';
                        categories.forEach(function (cat) {
                            const val = cat.distance || '';
                            const lbl = cat.name + ' (' + cat.distance + ') — BDT ' + parseFloat(cat.fee).toLocaleString();
                            const sel = (String(val).toLowerCase() === String(distance).toLowerCase()) ? 'selected' : '';
                            optionsHtml += '<option value="' + val + '" ' + sel + '>' + lbl + '</option>';
                        });
                        $catSelect.html(optionsHtml);
                        $catSelect.val(distance).trigger('change');
                    }

                    $modal.find('.brand-section p').first()
                        .text('Category: ' + name + ' (' + distance + ') — BDT ' + Number(fee).toLocaleString());

                    $modal.find('.modal-body').scrollTop(0);
                });
            });

            $(document).on('change', '#registrationModal select[name="category"]', function () {
                const $btn = $('.proceedRegistrationBtn').first();
                if (!$btn.length) return;

                let categories = [];
                try {
                    categories = JSON.parse($btn.attr('data-categories') || '[]');
                } catch (e) {
                    categories = [];
                }

                const value = String($(this).val()).toLowerCase();
                const matched = categories.find(function (cat) {
                    return String(cat.distance || '').toLowerCase() === value;
                });

                if (matched) {
                    $('#eventPrice').val(parseFloat(matched.fee).toLocaleString());
                }
            });


            /* ====================================================
             * 7. SHARE MODAL
             * ==================================================== */
            const $shareModal = $('#shareModal');
            const $shareClose = $('#closeShare');

            $(document).on('click', '.shareBtn', function () {
                const url = $(this).data('url') || '';
                const title = $(this).data('title') || '';

                const encUrl = encodeURIComponent(url);
                const encTitle = encodeURIComponent(title);

                $('#shareFb').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + encUrl);
                $('#shareWa').attr('href', 'https://api.whatsapp.com/send?text=' + encTitle + '%20' + encUrl);
                $('#shareLi').attr('href', 'https://www.linkedin.com/sharing/share-offsite/?url=' + encUrl);
                $('#shareTw').attr('href', 'https://twitter.com/intent/tweet?text=' + encTitle + '&url=' + encUrl);

                $shareModal.css('display', 'flex');
            });

            $shareClose.on('click', function () {
                $shareModal.css('display', 'none');
            });

            $shareModal.on('click', function (e) {
                if (e.target === this) $(this).css('display', 'none');
            });

            $(document).on('click', '#copyLink', function () {
                const url = $('.shareBtn').first().data('url') || '';
                const $msg = $('#copyMsg');

                function showMsg(text) {
                    $msg.text(text).show();
                    clearTimeout($msg.data('timer'));
                    $msg.data('timer', setTimeout(function () { $msg.hide(); }, 2000));
                }

                function legacyCopy(text) {
                    const ta = document.createElement('textarea');
                    ta.value = text;
                    ta.style.position = 'fixed';
                    ta.style.top = '-9999px';
                    ta.setAttribute('readonly', '');
                    document.body.appendChild(ta);
                    ta.select();
                    ta.setSelectionRange(0, ta.value.length);
                    let ok = false;
                    try { ok = document.execCommand('copy'); } catch (e) { ok = false; }
                    document.body.removeChild(ta);
                    return ok;
                }

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(url)
                        .then(function () { showMsg('✅ Link Copied!'); })
                        .catch(function () {
                            if (legacyCopy(url)) showMsg('✅ Link Copied!');
                            else showMsg('❌ Copy Failed');
                        });
                } else {
                    if (legacyCopy(url)) showMsg('✅ Link Copied!');
                    else showMsg('❌ Copy Failed');
                }
            });


            /* ====================================================
             * 8. MISC EFFECTS
             * ==================================================== */
            $(document).on('click', '.btn-register, .btn-search, .btn-subscribe', function () {
                const $btn = $(this);
                $btn.css('transform', 'scale(0.95)');
                setTimeout(function () { $btn.css('transform', 'none'); }, 150);
            });

            $('.dot').on('click', function () {
                $('.dot').removeClass('active');
                $(this).addClass('active');
            });

            $(window).on('scroll', function () {
                $('.cat-card, .event-card, .why-card').each(function () {
                    const $card = $(this);
                    if ($card.offset().top < $(window).scrollTop() + $(window).height() - 50) {
                        $card.css({ opacity: '1', transform: 'translateY(0)' });
                    }
                });
            });


            /* ====================================================
             * 9. PHONE INPUT — +880 prefix guard
             * ==================================================== */
            const $phoneInput = $('#phoneInput');
            if ($phoneInput.length) {
                $phoneInput.on('keydown', function (e) {
                    if (this.selectionStart <= 4 && (e.key === 'Backspace' || e.key === 'Delete')) {
                        e.preventDefault();
                    }
                });
                $phoneInput.on('click', function () {
                    if (this.selectionStart < 5) {
                        this.setSelectionRange(this.value.length, this.value.length);
                    }
                });
                $phoneInput.on('input', function () {
                    if (!this.value.startsWith('+880 ')) {
                        this.value = '+880 ';
                    }
                });
            }

            ['#whatsappInput', '#emergencyPhoneInput'].forEach(function (sel) {
                const $inp = $(sel);
                if (!$inp.length) return;
                $inp.on('keydown', function (e) {
                    if (this.selectionStart <= 4 && (e.key === 'Backspace' || e.key === 'Delete')) {
                        e.preventDefault();
                    }
                });
                $inp.on('click', function () {
                    if (this.selectionStart < 5) {
                        this.setSelectionRange(this.value.length, this.value.length);
                    }
                });
                $inp.on('input', function () {
                    if (!this.value.startsWith('+880 ')) {
                        this.value = '+880 ';
                    }
                });
            });


            /* ====================================================
             * 10. FLATPICKR — DOB PICKER
             * ==================================================== */
            if ($('#event-date').length) {
                flatpickr('#event-date', {
                    dateFormat: 'd/m/Y',
                    allowInput: true
                });
            }

        });

        window.openRegistrationModal = function (eventId) {
            if (eventId) $('#event_id_field').val(eventId);
            $('#registrationModal').addClass('active').css('display', 'flex');
        };
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH D:\laragon\www\run-event\resources\views/master.blade.php ENDPATH**/ ?>