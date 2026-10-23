@extends('master')

@section('title', 'Contact Us - Run Burjowan')

@section('body')

<section class="relative bg-cover bg-right md:bg-center bg-no-repeat text-white py-16 md:py-24 overflow-hidden"
         style="background-image: url('{{ asset('img/about-hero.jpg') }}');">

    {{-- Decorative circle --}}
    <div class="absolute -top-32 -right-24 w-[500px] h-[500px] rounded-full bg-[#6bad3f]/10 pointer-events-none"></div>

    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8 items-center">

            {{-- LEFT CONTENT --}}
            <div class="md:col-span-3 text-center md:text-left">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-black tracking-wider mb-3 leading-tight drop-shadow-md">
                    CONTACT US
                </h1>
                <p class="text-sm md:text-base text-slate-200 mb-5 max-w-xl mx-auto md:mx-0 leading-relaxed drop-shadow-sm">
                    We're here to help! Reach out to us for any inquiries, registration or support.
                </p>
                <div class="flex items-center justify-center md:justify-start gap-2 text-xs md:text-sm text-slate-300">
                    <a href="{{ url('/') }}" class="text-[#6bad3f] font-semibold hover:text-white transition">Home</a>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    <span class="text-slate-100 font-medium">Contact Us</span>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="bg-gradient-to-b from-slate-50 to-slate-100 py-12 md:py-16">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        {{-- ============ TOP GRID ============ --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

            {{-- ===== LEFT: INFO CARDS (4 cols) ===== --}}
            <div class="lg:col-span-4 flex flex-col space-y-4">

                {{-- Phone Card --}}
                <div class="group bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-[#6bad3f] hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#6bad3f] to-[#4f8a2c] text-white flex items-center justify-center flex-shrink-0 shadow-md shadow-[#6bad3f]/20 group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-phone text-lg"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-black tracking-widest text-[#6bad3f] uppercase block">Call Us Directly</span>
                            <h4 class="text-base font-bold text-[#0b132b]">Phone Support</h4>
                        </div>
                    </div>
                    <div class="space-y-1.5 pl-1">
                        <a href="tel:+8801911469861" class="flex items-center justify-between text-xs md:text-sm font-semibold text-slate-700 hover:text-[#6bad3f] py-1 px-2.5 rounded-lg hover:bg-slate-50 transition-colors">
                            <span>+880 19 1146 9861</span>
                            <i class="fa-solid fa-arrow-right text-xs opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </a>
                        <a href="tel:+8801711543414" class="flex items-center justify-between text-xs md:text-sm font-semibold text-slate-700 hover:text-[#6bad3f] py-1 px-2.5 rounded-lg hover:bg-slate-50 transition-colors">
                            <span>+880 17 1154 3414</span>
                            <i class="fa-solid fa-arrow-right text-xs opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </a>
                        <a href="tel:+8801711808026" class="flex items-center justify-between text-xs md:text-sm font-semibold text-slate-700 hover:text-[#6bad3f] py-1 px-2.5 rounded-lg hover:bg-slate-50 transition-colors">
                            <span>+880 17 1180 8026</span>
                            <i class="fa-solid fa-arrow-right text-xs opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </a>
                    </div>
                </div>

                {{-- WhatsApp Card --}}
                <div class="group bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-[#25d366] hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#25d366] to-[#128c7e] text-white flex items-center justify-center flex-shrink-0 shadow-md shadow-emerald-500/20 group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-black tracking-widest text-[#25d366] uppercase block">Instant Messaging</span>
                            <h4 class="text-base font-bold text-[#0b132b]">WhatsApp Chat</h4>
                        </div>
                    </div>
                    <div class="space-y-1.5 pl-1">
                        <a href="https://wa.me/8801911469861" target="_blank" class="flex items-center justify-between text-xs md:text-sm font-semibold text-slate-700 hover:text-[#25d366] py-1 px-2.5 rounded-lg hover:bg-emerald-50/50 transition-colors">
                            <span>+880 19 1146 9861</span>
                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-full">Chat</span>
                        </a>
                        <a href="https://wa.me/8801711543414" target="_blank" class="flex items-center justify-between text-xs md:text-sm font-semibold text-slate-700 hover:text-[#25d366] py-1 px-2.5 rounded-lg hover:bg-emerald-50/50 transition-colors">
                            <span>+880 17 1154 3414</span>
                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-full">Chat</span>
                        </a>
                        <a href="https://wa.me/8801711808026" target="_blank" class="flex items-center justify-between text-xs md:text-sm font-semibold text-slate-700 hover:text-[#25d366] py-1 px-2.5 rounded-lg hover:bg-emerald-50/50 transition-colors">
                            <span>+880 17 1180 8026</span>
                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-full">Chat</span>
                        </a>
                    </div>
                </div>

                {{-- Email Card --}}
                <div class="group bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-[#6bad3f] hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#6bad3f] to-[#4f8a2c] text-white flex items-center justify-center flex-shrink-0 shadow-md shadow-[#6bad3f]/20 group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-envelope text-lg"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <span class="text-[10px] font-black tracking-widest text-[#6bad3f] uppercase block">Write To Us</span>
                            <a href="mailto:info@runburjowan.com" class="text-xs md:text-sm font-bold text-[#0b132b] hover:text-[#6bad3f] truncate block transition-colors">
                                info@runburjowan.com
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ===== CENTER: MESSAGE FORM (5 cols) ===== --}}
            <div class="lg:col-span-5">
                <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow h-full flex flex-col justify-between">
                    <div>
                        <div class="mb-5">
                            <span class="text-xs font-black tracking-widest text-[#6bad3f] uppercase block mb-1">Get In Touch</span>
                            <h3 class="text-xl md:text-2xl font-black text-[#0b132b] tracking-wide">
                                SEND US A MESSAGE
                            </h3>
                            <div class="w-12 h-1 bg-gradient-to-r from-[#6bad3f] to-[#4f8a2c] rounded-full mt-2"></div>
                        </div>

                        <form action="#" method="POST" class="space-y-3.5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                                <div>
                                    <input type="text" placeholder="Your Name *" required
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-sm text-slate-800 outline-none transition-all focus:border-[#6bad3f] focus:bg-white focus:ring-4 focus:ring-[#6bad3f]/10 placeholder:text-slate-400">
                                </div>
                                <div>
                                    <input type="tel" placeholder="Phone Number *" required
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-sm text-slate-800 outline-none transition-all focus:border-[#6bad3f] focus:bg-white focus:ring-4 focus:ring-[#6bad3f]/10 placeholder:text-slate-400">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                                <div>
                                    <input type="email" placeholder="Email Address *" required
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-sm text-slate-800 outline-none transition-all focus:border-[#6bad3f] focus:bg-white focus:ring-4 focus:ring-[#6bad3f]/10 placeholder:text-slate-400">
                                </div>
                                <div>
                                    <input type="text" placeholder="Subject"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-sm text-slate-800 outline-none transition-all focus:border-[#6bad3f] focus:bg-white focus:ring-4 focus:ring-[#6bad3f]/10 placeholder:text-slate-400">
                                </div>
                            </div>

                            <div>
                                <textarea rows="4" placeholder="Write your message here..." required
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-sm text-slate-800 outline-none transition-all focus:border-[#6bad3f] focus:bg-white focus:ring-4 focus:ring-[#6bad3f]/10 placeholder:text-slate-400 resize-y min-h-[120px]"></textarea>
                            </div>
                        </form>
                    </div>

                    {{-- Button placed at the bottom so it aligns with the right card's divider line --}}
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2.5 px-8 py-3.5 rounded-xl bg-gradient-to-r from-[#6bad3f] to-[#4f8a2c] text-white font-bold text-sm tracking-widest shadow-lg shadow-[#6bad3f]/25 hover:shadow-xl hover:shadow-[#6bad3f]/35 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                            <span>SEND MESSAGE</span>
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ===== RIGHT: ASSISTANCE CARD (3 cols) ===== --}}
            <div class="lg:col-span-3">
                <div class="relative overflow-hidden bg-gradient-to-br from-[#0b132b] via-[#1c2541] to-[#0b132b] text-white p-6 md:p-7 rounded-2xl shadow-xl flex flex-col justify-between items-center text-center h-full border border-slate-700/50">

                    {{-- Decorative background glow --}}
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-[#6bad3f]/20 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="relative z-10 w-full flex flex-col items-center flex-1 pt-4">

                        {{-- Image container to be larger (w-28 h-28) --}}
                        <div class="w-28 h-28 mb-5 rounded-2xl bg-white/10 backdrop-blur-md p-3 flex items-center justify-center border border-white/15 shadow-inner">
                            <img src="{{ asset('img/call.png') }}" alt="Help Center" class="w-full h-full object-contain">
                        </div>

                        {{-- Text elements pushed further down --}}
                        <div class="mt-2 mb-6">
                            <h4 class="text-xl font-black tracking-wide mb-2">
                                Need Quick Help?
                            </h4>
                            <p class="text-xs text-slate-300 max-w-[220px] mx-auto leading-relaxed">
                                Our support team is available for direct calling or WhatsApp chat.
                            </p>
                        </div>

                        {{-- Buttons pushed right above the bottom divider line --}}
                        <div class="w-full space-y-2.5 mt-auto pt-2">
                            <a href="tel:+8801911469861"
                            class="flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl bg-rose-500 hover:bg-rose-600 text-white text-xs font-bold tracking-wider shadow-lg shadow-rose-500/25 hover:shadow-rose-500/40 hover:-translate-y-0.5 transition-all duration-300">
                                <i class="fa-solid fa-phone"></i>
                                <span>CALL SUPPORT</span>
                            </a>

                            <a href="https://wa.me/8801711808026"
                            target="_blank"
                            class="flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl bg-[#25d366] hover:bg-[#1da851] text-white text-xs font-bold tracking-wider shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 hover:-translate-y-0.5 transition-all duration-300">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>WHATSAPP CHAT</span>
                            </a>
                        </div>
                    </div>

                    {{-- Bottom border line --}}
                    <div class="relative z-10 mt-4 pt-4 border-t border-white/10 w-full">
                        <p class="text-[11px] text-slate-400">
                            <i class="fa-regular fa-clock mr-1 text-[#6bad3f]"></i> Quick response guaranteed
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>
@endpush
