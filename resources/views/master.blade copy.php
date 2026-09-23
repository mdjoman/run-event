<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUN BURJOWAN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <div class="logo-icon"><i class="fa-regular fa-calendar-check"></i></div>
            <div>
                RUN BURJOWAN
                {{-- <span class="logo-subtitle">Discover • Register • Be Part</span> --}}
            </div>
        </div>
        <nav>
            <ul>
                <li><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                <li><a class="nav-link {{ request()->is('event*') ? 'active' : '' }}" href="{{ url('/event') }}">Events</a></li>
                <li><a class="nav-link {{ request()->is('activity*') ? 'active' : '' }}" href="{{ url('/activity') }}">Activities</a></li>
                <li><a class="nav-link {{ request()->is('about*') ? 'active' : '' }}" href="{{ url('/about') }}">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div class="header-actions">
            <button class="search-icon-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="#" class="btn-login">Login</a>
            <button class="btn-signup" id="openRegModal">Registration</button>
        </div>
    </header>

    @yield('body')
    <footer class="footer-cta">
        <div class="cta-left">
            <div class="logo-icon"><i class="fa-regular fa-calendar-check"></i></div>
            <div class="cta-text">
                <h3>Ready to Explore?</h3>
                <p>Join thousands of people who are already part of our events and activities.</p>
            </div>
        </div>
        <div class="newsletter-form">
            <input type="email" placeholder="Enter your email address">
            <button class="btn-subscribe">Get Started <i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </footer>
    <div class="modal-overlay" id="regModal">
        <div class="modal-card">
            <button class="close-btn" id="closeRegModal">&times;</button>

            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <h2>Event Registration & Payment</h2>
                <p>Please complete your registration and fee payment below</p>
            </div>

            <form id="eventRegistrationForm" class="reg-form">
                <div class="form-group">
                    <label for="fullName">Full Name <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" id="fullName" placeholder="Enter your full name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" id="email" placeholder="example@email.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-phone"></i>
                            <input type="tel" id="phone" placeholder="+1234567890" required>
                        </div>
                    </div>
                </div>

                <!-- Event & Tickets -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="eventSelect">Select Event <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-calendar-check"></i>
                            <select id="eventSelect" required>
                                <option value="" disabled selected>Choose an event</option>
                                <option value="50" data-name="Tech Summit 2026">Tech Summit 2026 ($50)</option>
                                <option value="30" data-name="Web Workshop">Web Workshop ($30)</option>
                                <option value="40" data-name="UI/UX Conference">UI/UX Conference ($40)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ticketQty">Number of Tickets <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-users"></i>
                            <input type="number" id="ticketQty" min="1" max="10" value="1" required>
                        </div>
                    </div>
                </div>

                <!-- Payment Method Selection -->
                <div class="form-group">
                    <label>Payment Method <span class="required">*</span></label>
                    <div class="payment-methods">
                        <label class="payment-option">
                            <input type="radio" name="paymentMethod" value="card" checked>
                            <div class="pay-card">
                                <i class="fa-solid fa-credit-card"></i>
                                <span>Card</span>
                            </div>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="paymentMethod" value="bkash">
                            <div class="pay-card">
                                <i class="fa-solid fa-mobile-screen"></i>
                                <span>bKash</span>
                            </div>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="paymentMethod" value="nagad">
                            <div class="pay-card">
                                <i class="fa-solid fa-wallet"></i>
                                <span>Nagad</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div id="cardDetails" class="payment-details-box">
                    <div class="form-group">
                        <label for="cardNumber">Card Number</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-credit-card"></i>
                            <input type="text" id="cardNumber" placeholder="1234 5678 9101 1121">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="cardExpiry">Expiry Date</label>
                            <input type="text" id="cardExpiry" class="plain-input" placeholder="MM/YY">
                        </div>
                        <div class="form-group">
                            <label for="cardCvc">CVC/CVV</label>
                            <input type="text" id="cardCvc" class="plain-input" placeholder="123">
                        </div>
                    </div>
                </div>

                <div id="mfsDetails" class="payment-details-box hidden">
                    <div class="form-group">
                        <label for="mfsNumber">Mobile Account Number</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-mobile-button"></i>
                            <input type="tel" id="mfsNumber" placeholder="01700000000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mfsTrx">Transaction ID (TrxID)</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-receipt"></i>
                            <input type="text" id="mfsTrx" placeholder="e.g. 9J87X1A">
                        </div>
                    </div>
                </div>
                <div class="summary-box">
                    <span>Total Amount:</span>
                    <span id="totalAmountDisplay">$0.00</span>
                </div>

                <div class="form-checkbox">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree to the event <a href="#">Terms and Conditions</a></label>
                </div>

                <button type="submit" class="submit-btn">
                    Pay & Confirm Registration <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openBtn = document.getElementById('openRegModal');
            const closeBtn = document.getElementById('closeRegModal');
            const modal = document.getElementById('regModal');
            const form = document.getElementById('eventRegistrationForm');

            const eventSelect = document.getElementById('eventSelect');
            const ticketQty = document.getElementById('ticketQty');
            const totalAmountDisplay = document.getElementById('totalAmountDisplay');

            const paymentRadios = document.querySelectorAll('input[name="paymentMethod"]');
            const cardDetails = document.getElementById('cardDetails');
            const mfsDetails = document.getElementById('mfsDetails');

            function updateTotal() {
                const price = parseFloat(eventSelect.value) || 0;
                const qty = parseInt(ticketQty.value) || 1;
                const total = price * qty;
                totalAmountDisplay.textContent = `$${total.toFixed(2)}`;
            }

            eventSelect.addEventListener('change', updateTotal);
            ticketQty.addEventListener('input', updateTotal);
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', (e) => {
                    if (e.target.value === 'card') {
                        cardDetails.classList.remove('hidden');
                        mfsDetails.classList.add('hidden');
                    } else {
                        cardDetails.classList.add('hidden');
                        mfsDetails.classList.remove('hidden');
                    }
                });
            });

            if (openBtn && modal) {
                openBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    modal.classList.add('active');
                });
            }

            if (closeBtn && modal) {
                closeBtn.addEventListener('click', () => {
                    modal.classList.remove('active');
                });
            }

            if (modal) {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.classList.remove('active');
                    }
                });
            }

            if (form) {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    alert('Registration & Payment Successful!');
                    form.reset();
                    updateTotal();
                    cardDetails.classList.remove('hidden');
                    mfsDetails.classList.add('hidden');
                    modal.classList.remove('active');
                });
            }
        });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.querySelectorAll('.btn-register, .btn-search, .btn-subscribe').forEach(button => {
            button.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'none';
                }, 150);
            });
        });

        const dots = document.querySelectorAll('.dot');
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                dots.forEach(d => d.classList.remove('active'));
                dot.classList.add('active');
            });
        });

        window.addEventListener('scroll', () => {
            const cards = document.querySelectorAll('.cat-card, .event-card, .why-card');
            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                if (cardTop < window.innerHeight - 50) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        });
    </script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brandPink: '#e11d48',
                        brandPurple: '#a855f7',
                        brandBlue: '#0284c7',
                        brandTeal: '#0d9488',
                        brandOrange: '#ea580c',
                        darkNavy: '#0f172a',
                    }
                }
            }
        }
    </script>
</body>
</html>
