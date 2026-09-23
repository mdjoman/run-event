@extends('master')
@section('body')
    <section class="contact-hero overflow-hidden">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7 col-md-6 pb-4" style="padding-bottom: 4.8rem !important;">
                    <h1 class="hero-title">CONTACT US</h1>
                    <p class="hero-desc">We're here to help! Reach out to us for any inquiries, bookings or support.</p>
                    <div class="breadcrumb-custom">
                        <a href="{{url('/')}}">Home</a> <i class="fa-solid fa-chevron-right mx-1 fs-6"></i> <span>Contact Us</span>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 text-center text-md-end">
                    <div class="hero-img-box">
                        <img src="{{asset('img/tyres/tt.png')}}" alt="Tyre Image" class="img-fluid slide-from-right">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-main-section">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-3 col-md-4">
                    <div class="info-card">
                        <div class="info-icon-circle"><i class="fa-solid fa-phone"></i></div>
                        <div class="info-content">
                            <div class="info-label">PHONE</div>
                            <p class="info-value">+971 52 978 4757</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon-circle"><i class="fa-solid fa-envelope"></i></div>
                        <div class="info-content">
                            <div class="info-label">EMAIL</div>
                            <p class="info-value">info@hayattyres.ae</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon-circle"><i class="fa-brands fa-whatsapp"></i></div>
                        <div class="info-content">
                            <div class="info-label">WHATSAPP</div>
                            <p class="info-value">+971 52 978 4757<br><small class="text-muted">Chat with us on WhatsApp</small></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon-circle"><i class="fa-regular fa-clock"></i></div>
                        <div class="info-content">
                            <div class="info-label">WORKING HOURS</div>
                            <p class="info-value">Saturday – Thursday<br>8:00 AM – 10:00 PM<br><small class="text-muted">Friday: 2:00 PM – 10:00 PM</small></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-8">
                    <div class="message-card">
                        <h3 class="form-title">SEND US A MESSAGE</h3>
                        <form action="#" method="POST" class="mt-4">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control custom-input" placeholder="Your Name *">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control custom-input" placeholder="Phone Number *">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control custom-input" placeholder="Email Address *">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control custom-input" placeholder="Subject">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control custom-input" rows="4" placeholder="Write your message..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-send">SEND MESSAGE <i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12">
                    <div class="assistance-card">
                        <img src="{{asset('img/contact2.png')}}" alt="Headphone" class="headphone-img">
                        <h4 class="assistance-title">Need Immediate Assistance?</h4>
                        <p class="assistance-desc">Call or WhatsApp us anytime!</p>
                        <a href="tel:+971501234567" class="btn-action-red"><i class="fa-solid fa-phone"></i> CALL NOW</a>
                        <a href="https://wa.me/971501234567" class="btn-action-dark"><i class="fa-brands fa-whatsapp"></i> CHAT ON WHATSAPP</a>
                    </div>
                </div>

            </div>

            <div class="map-branch-section" style="padding-bottom: 12px;">
                <div class="row g-3">
                    <div class="col-lg-6 col-md-12">
                        <div class="map-wrapper">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3597.7867835462266!2d55.937396175395456!3d25.612000377446265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ef5dbf9ab06b443%3A0x9486d43c9f0f8ea0!2sRas%20Al%20Khaimah%20International%20Airport!5e0!3m2!1sen!2sbd!4v1786043622451!5m2!1sen!2sbd" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="branch-card">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h3 class="branch-title"><i class="fa-solid fa-location-dot"></i> OUR BRANCH</h3>
                                    <div class="branch-name">Hayat Tyres</div>
                                    <p class="branch-address">RAK Airport Road, After Lamp R/A, Ras Al Khaimah, United Arab Emirates</p>

                                    <ul class="feature-list">
                                        <li><i class="fa-solid fa-circle-check"></i> Easy to find location</li>
                                        <li><i class="fa-solid fa-circle-check"></i> Ample parking available</li>
                                        <li><i class="fa-solid fa-circle-check"></i> State-of-the-art workshop</li>
                                        <li><i class="fa-solid fa-circle-check"></i> Customer lounge & Wi-Fi</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <div class="branch-img-box">
                                        <img src="https://images.unsplash.com/photo-1625047509168-a7026f36de04?auto=format&fit=crop&q=80&w=600" alt="Branch Workshop">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature-strip">
                <div class="container-fluid">
                    <div class="row g-0 align-items-center">
                        <div class="col-lg col-md-4 col-sm-6 strip-col">
                            <div class="strip-item">
                                <div class="strip-icon"><i class="fa-solid fa-car-side"></i></div>
                                <div>
                                    <div class="strip-title">BOOK APPOINTMENT</div>
                                    <p class="strip-desc">Schedule your service online in minutes</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg col-md-4 col-sm-6 strip-col">
                            <div class="strip-item">
                                <div class="strip-icon"><i class="fa-solid fa-van-shuttle"></i></div>
                                <div>
                                    <div class="strip-title">MOBILE TYRE SERVICE</div>
                                    <p class="strip-desc">We come to you 24/7 anywhere in UAE</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg col-md-4 col-sm-6 strip-col">
                            <div class="strip-item">
                                <div class="strip-icon"><i class="fa-solid fa-phone-volume"></i></div>
                                <div>
                                    <div class="strip-title">EMERGENCY SUPPORT</div>
                                    <p class="strip-desc">Round the clock roadside assistance</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg col-md-6 col-sm-6 strip-col">
                            <div class="strip-item">
                                <div class="strip-icon"><i class="fa-solid fa-comments"></i></div>
                                <div>
                                    <div class="strip-title">LIVE CHAT</div>
                                    <p class="strip-desc">Chat with our support team now</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg col-md-6 col-sm-12 strip-col">
                            <div class="strip-item">
                                <div class="strip-icon"><i class="fa-solid fa-headset"></i></div>
                                <div>
                                    <div class="strip-title">CUSTOMER SUPPORT</div>
                                    <p class="strip-desc">We are always here to help you</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
