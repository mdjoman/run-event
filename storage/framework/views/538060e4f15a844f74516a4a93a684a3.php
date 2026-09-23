<style>
    .max-w-7xl {
        max-width: 104rem !important;
    }
</style>
<?php $__env->startSection('body'); ?>
    <section class="relative bg-slate-900 text-white overflow-hidden py-8 md:py-12">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1920&q=80" alt="Mountain Landscape" class="w-full h-full object-cover object-center opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/70 to-slate-950/40"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6 min-h-[300px]">

                <div class="max-w-2xl space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800/80 border border-slate-700 backdrop-blur-md text-xs font-bold tracking-widest text-slate-200 uppercase">
                        <i class="fa-solid fa-mountain text-pink-400"></i>
                        <span>EXPLORE • EXPERIENCE • ENJOY</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                        Exciting <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-400 via-pink-500 to-purple-400">Activities</span>
                    </h1>

                    <p class="text-lg sm:text-xl font-bold text-slate-200">
                        Tours, Marathons, Workshops & More!
                    </p>

                    <p class="text-slate-300 text-base max-w-xl font-normal leading-relaxed">
                        Step out of your routine and make it memorable. Discover amazing activities, register easily and be part of something great!
                    </p>
                </div>

                <div class="hidden lg:flex justify-end items-center">
                    <div class="text-right font-handwriting text-2xl xl:text-3xl text-amber-200 leading-tight drop-shadow-lg select-none transform -rotate-2">
                        New Places<br>
                        <span class="text-pink-400 font-extrabold text-3xl xl:text-4xl">New People</span><br>
                        <span class="text-cyan-300 underline decoration-wavy decoration-pink-500 text-3xl xl:text-4xl">More Adventures</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-20">
        <div class="bg-white rounded-2xl p-3 shadow-xl border border-slate-100 flex items-center gap-2 overflow-x-auto no-scrollbar scroll-smooth" id="categoryTabs">

            <button onclick="filterCategory('all', this)" class="category-btn active px-5 py-3 rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold text-sm whitespace-nowrap shadow-md shadow-pink-500/20 flex items-center gap-2 transition-all">
                <i class="fa-solid fa-border-all"></i>
                All Activities
            </button>

            <button onclick="filterCategory('Tour', this)" class="category-btn px-5 py-3 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-sm whitespace-nowrap flex items-center gap-2 transition-all">
                <i class="fa-solid fa-plane-departure text-cyan-500"></i>
                Tours & Travel
            </button>

            <button onclick="filterCategory('Marathon', this)" class="category-btn px-5 py-3 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-sm whitespace-nowrap flex items-center gap-2 transition-all">
                <i class="fa-solid fa-person-running text-blue-500"></i>
                Marathons
            </button>

            <button onclick="filterCategory('Workshop', this)" class="category-btn px-5 py-3 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-sm whitespace-nowrap flex items-center gap-2 transition-all">
                <i class="fa-solid fa-graduation-cap text-teal-500"></i>
                Workshops
            </button>

            <button onclick="filterCategory('Outdoor', this)" class="category-btn px-5 py-3 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-sm whitespace-nowrap flex items-center gap-2 transition-all">
                <i class="fa-solid fa-mountain-sun text-emerald-500"></i>
                Outdoor & Adventure
            </button>

            <button onclick="filterCategory('Sports', this)" class="category-btn px-5 py-3 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-sm whitespace-nowrap flex items-center gap-2 transition-all">
                <i class="fa-solid fa-basketball text-orange-500"></i>
                Sports
            </button>

            <button onclick="filterCategory('Community', this)" class="category-btn px-5 py-3 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-sm whitespace-nowrap flex items-center gap-2 transition-all">
                <i class="fa-solid fa-users text-indigo-500"></i>
                Community
            </button>

            <button onclick="filterCategory('more', this)" class="category-btn px-4 py-3 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold text-sm whitespace-nowrap flex items-center gap-2 transition-all">
                <i class="fa-solid fa-ellipsis"></i>
                More
            </button>

        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest text-pink-500 mb-1">
                    <span class="w-6 h-0.5 bg-pink-500 rounded-full"></span>
                    POPULAR ACTIVITIES
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Explore Our Top Activities
                </h2>
            </div>
            <a href="#" class="inline-flex items-center gap-2 text-pink-500 font-bold hover:text-pink-600 transition-colors text-sm group">
                View All Activities
                <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- LEFT AREA: Cards Grid (8 cols) -->
            <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="activityCardsGrid">

                <!-- CARD 1 -->
                <article class="activity-card group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full" data-category="Tour" data-price="250" data-location="Ras Al Khaimah">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80" alt="Hiking Adventure" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-pink-500 text-white font-bold text-xs shadow-md">
                            Tour
                        </span>
                        <div class="absolute top-3 right-3 flex flex-col items-end gap-2">
                            <button onclick="toggleWishlist(this)" aria-label="Add to Wishlist" class="w-8 h-8 rounded-full bg-white/90 backdrop-blur-md flex items-center justify-center text-slate-600 hover:text-pink-500 transition-colors shadow-sm">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                            <div class="bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-bold px-2.5 py-1 rounded-lg text-center leading-tight shadow-md border border-white/20">
                                <span class="block text-sm leading-none font-black text-pink-400">12</span>
                                Oct 2026
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow justify-between space-y-3">
                        <div class="space-y-2">
                            <h3 class="font-bold text-slate-900 group-hover:text-pink-500 transition-colors line-clamp-2 text-base leading-snug">
                                Hiking Adventure – Shangri La Mountain Tour
                            </h3>
                            <div class="space-y-1 text-xs text-slate-500 font-medium">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-slate-400 w-3 text-center"></i>
                                    <span class="truncate">Ras Al Khaimah</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-regular fa-clock text-slate-400 w-3 text-center"></i>
                                    <span>7:00 AM – 5:00 PM</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tag Badges -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold">Outdoor</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-purple-50 text-purple-600 text-[11px] font-bold">Adventure</span>
                        </div>

                        <!-- Bottom Price & CTA -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-semibold">Price</span>
                                <span class="text-lg font-black text-slate-900">AED 250</span>
                            </div>
                            <button onclick="registerEvent('Hiking Adventure – Shangri La Mountain Tour')" class="gradient-btn-primary text-white text-xs font-extrabold px-4 py-2.5 rounded-xl flex items-center gap-1.5 shadow-sm shadow-pink-500/20">
                                Register Now <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                </article>

                <!-- CARD 2 -->
                <article class="activity-card group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full" data-category="Marathon" data-price="120" data-location="Dubai">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1530541930197-ff16ac917b0e?auto=format&fit=crop&w=600&q=80" alt="Dubai Marathon" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-blue-500 text-white font-bold text-xs shadow-md">
                            Marathon
                        </span>
                        <div class="absolute top-3 right-3 flex flex-col items-end gap-2">
                            <button onclick="toggleWishlist(this)" aria-label="Add to Wishlist" class="w-8 h-8 rounded-full bg-white/90 backdrop-blur-md flex items-center justify-center text-slate-600 hover:text-pink-500 transition-colors shadow-sm">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                            <div class="bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-bold px-2.5 py-1 rounded-lg text-center leading-tight shadow-md border border-white/20">
                                <span class="block text-sm leading-none font-black text-pink-400">25</span>
                                Oct 2026
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow justify-between space-y-3">
                        <div class="space-y-2">
                            <h3 class="font-bold text-slate-900 group-hover:text-pink-500 transition-colors line-clamp-2 text-base leading-snug">
                                Dubai City Marathon 2026
                            </h3>
                            <div class="space-y-1 text-xs text-slate-500 font-medium">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-slate-400 w-3 text-center"></i>
                                    <span class="truncate">Dubai</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-regular fa-clock text-slate-400 w-3 text-center"></i>
                                    <span>6:00 AM – 11:00 PM</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tag Badges -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            <span class="px-2.5 py-0.5 rounded-full bg-sky-50 text-sky-600 text-[11px] font-bold">Fitness</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-600 text-[11px] font-bold">Health</span>
                        </div>

                        <!-- Bottom Price & CTA -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-semibold">Price</span>
                                <span class="text-lg font-black text-slate-900">AED 120</span>
                            </div>
                            <button onclick="registerEvent('Dubai City Marathon 2026')" class="gradient-btn-primary text-white text-xs font-extrabold px-4 py-2.5 rounded-xl flex items-center gap-1.5 shadow-sm shadow-pink-500/20">
                                Register Now <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                </article>

                <!-- CARD 3 -->
                <article class="activity-card group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full" data-category="Tour" data-price="180" data-location="Dubai">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=600&q=80" alt="Desert Safari" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-pink-500 text-white font-bold text-xs shadow-md">
                            Tour
                        </span>
                        <div class="absolute top-3 right-3 flex flex-col items-end gap-2">
                            <button onclick="toggleWishlist(this)" aria-label="Add to Wishlist" class="w-8 h-8 rounded-full bg-white/90 backdrop-blur-md flex items-center justify-center text-slate-600 hover:text-pink-500 transition-colors shadow-sm">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                            <div class="bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-bold px-2.5 py-1 rounded-lg text-center leading-tight shadow-md border border-white/20">
                                <span class="block text-sm leading-none font-black text-pink-400">08</span>
                                Nov 2026
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow justify-between space-y-3">
                        <div class="space-y-2">
                            <h3 class="font-bold text-slate-900 group-hover:text-pink-500 transition-colors line-clamp-2 text-base leading-snug">
                                Desert Safari & Dune Bashing
                            </h3>
                            <div class="space-y-1 text-xs text-slate-500 font-medium">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-slate-400 w-3 text-center"></i>
                                    <span class="truncate">Dubai</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-regular fa-clock text-slate-400 w-3 text-center"></i>
                                    <span>3:00 PM – 9:00 PM</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tag Badges -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold">Adventure</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-fuchsia-50 text-fuchsia-600 text-[11px] font-bold">Travel</span>
                        </div>

                        <!-- Bottom Price & CTA -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-semibold">Price</span>
                                <span class="text-lg font-black text-slate-900">AED 180</span>
                            </div>
                            <button onclick="registerEvent('Desert Safari & Dune Bashing')" class="gradient-btn-primary text-white text-xs font-extrabold px-4 py-2.5 rounded-xl flex items-center gap-1.5 shadow-sm shadow-pink-500/20">
                                Register Now <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                </article>

                <!-- CARD 4 -->
                <article class="activity-card group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full" data-category="Workshop" data-price="95" data-location="Dubai">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=600&q=80" alt="Cooking Class" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-teal-500 text-white font-bold text-xs shadow-md">
                            Workshop
                        </span>
                        <div class="absolute top-3 right-3 flex flex-col items-end gap-2">
                            <button onclick="toggleWishlist(this)" aria-label="Add to Wishlist" class="w-8 h-8 rounded-full bg-white/90 backdrop-blur-md flex items-center justify-center text-slate-600 hover:text-pink-500 transition-colors shadow-sm">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                            <div class="bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-bold px-2.5 py-1 rounded-lg text-center leading-tight shadow-md border border-white/20">
                                <span class="block text-sm leading-none font-black text-pink-400">15</span>
                                Nov 2026
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow justify-between space-y-3">
                        <div class="space-y-2">
                            <h3 class="font-bold text-slate-900 group-hover:text-pink-500 transition-colors line-clamp-2 text-base leading-snug">
                                Arabic Cuisine Cooking Class
                            </h3>
                            <div class="space-y-1 text-xs text-slate-500 font-medium">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-slate-400 w-3 text-center"></i>
                                    <span class="truncate">Dubai</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-regular fa-clock text-slate-400 w-3 text-center"></i>
                                    <span>10:00 AM – 1:00 PM</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tag Badges -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            <span class="px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-600 text-[11px] font-bold">Food</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-600 text-[11px] font-bold">Skills</span>
                        </div>

                        <!-- Bottom Price & CTA -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-semibold">Price</span>
                                <span class="text-lg font-black text-slate-900">AED 95</span>
                            </div>
                            <button onclick="registerEvent('Arabic Cuisine Cooking Class')" class="gradient-btn-primary text-white text-xs font-extrabold px-4 py-2.5 rounded-xl flex items-center gap-1.5 shadow-sm shadow-pink-500/20">
                                Register Now <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                </article>

                <!-- CARD 5 -->
                <article class="activity-card group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full" data-category="Sports" data-price="60" data-location="Dubai">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=600&q=80" alt="Cycling Ride" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-orange-500 text-white font-bold text-xs shadow-md">
                            Sports
                        </span>
                        <div class="absolute top-3 right-3 flex flex-col items-end gap-2">
                            <button onclick="toggleWishlist(this)" aria-label="Add to Wishlist" class="w-8 h-8 rounded-full bg-white/90 backdrop-blur-md flex items-center justify-center text-slate-600 hover:text-pink-500 transition-colors shadow-sm">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                            <div class="bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-bold px-2.5 py-1 rounded-lg text-center leading-tight shadow-md border border-white/20">
                                <span class="block text-sm leading-none font-black text-pink-400">22</span>
                                Nov 2026
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow justify-between space-y-3">
                        <div class="space-y-2">
                            <h3 class="font-bold text-slate-900 group-hover:text-pink-500 transition-colors line-clamp-2 text-base leading-snug">
                                Community Cycling Ride
                            </h3>
                            <div class="space-y-1 text-xs text-slate-500 font-medium">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-slate-400 w-3 text-center"></i>
                                    <span class="truncate">Al Qudra Cycling Track, Dubai</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-regular fa-clock text-slate-400 w-3 text-center"></i>
                                    <span>6:00 AM – 9:00 AM</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tag Badges -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            <span class="px-2.5 py-0.5 rounded-full bg-sky-50 text-sky-600 text-[11px] font-bold">Fitness</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-600 text-[11px] font-bold">Community</span>
                        </div>

                        <!-- Bottom Price & CTA -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-semibold">Price</span>
                                <span class="text-lg font-black text-slate-900">AED 60</span>
                            </div>
                            <button onclick="registerEvent('Community Cycling Ride')" class="gradient-btn-primary text-white text-xs font-extrabold px-4 py-2.5 rounded-xl flex items-center gap-1.5 shadow-sm shadow-pink-500/20">
                                Register Now <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                </article>

                <!-- CARD 6 -->
                <article class="activity-card group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full" data-category="Workshop" data-price="110" data-location="Hatta">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1542038784456-1ea8e935640e?auto=format&fit=crop&w=600&q=80" alt="Photography Workshop" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-teal-500 text-white font-bold text-xs shadow-md">
                            Workshop
                        </span>
                        <div class="absolute top-3 right-3 flex flex-col items-end gap-2">
                            <button onclick="toggleWishlist(this)" aria-label="Add to Wishlist" class="w-8 h-8 rounded-full bg-white/90 backdrop-blur-md flex items-center justify-center text-slate-600 hover:text-pink-500 transition-colors shadow-sm">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                            <div class="bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-bold px-2.5 py-1 rounded-lg text-center leading-tight shadow-md border border-white/20">
                                <span class="block text-sm leading-none font-black text-pink-400">05</span>
                                Dec 2026
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow justify-between space-y-3">
                        <div class="space-y-2">
                            <h3 class="font-bold text-slate-900 group-hover:text-pink-500 transition-colors line-clamp-2 text-base leading-snug">
                                Landscape Photography Workshop
                            </h3>
                            <div class="space-y-1 text-xs text-slate-500 font-medium">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-slate-400 w-3 text-center"></i>
                                    <span class="truncate">Hatta</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-regular fa-clock text-slate-400 w-3 text-center"></i>
                                    <span>9:00 AM – 4:00 PM</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tag Badges -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-bold">Photography</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-violet-50 text-violet-600 text-[11px] font-bold">Creative</span>
                        </div>

                        <!-- Bottom Price & CTA -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-semibold">Price</span>
                                <span class="text-lg font-black text-slate-900">AED 110</span>
                            </div>
                            <button onclick="registerEvent('Landscape Photography Workshop')" class="gradient-btn-primary text-white text-xs font-extrabold px-4 py-2.5 rounded-xl flex items-center gap-1.5 shadow-sm shadow-pink-500/20">
                                Register Now <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                </article>

            </div>

            <!-- RIGHT AREA: Filter Sidebar (4 cols) -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Filter Box Card -->
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-lg space-y-6">

                    <!-- Search Input Box -->
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 text-slate-400 text-sm"></i>
                        <input id="sidebarSearch" type="text" placeholder="Search activities..." class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-pink-500 focus:bg-white transition-all font-medium">
                        <button aria-label="Search activities" class="absolute right-2 p-1.5 bg-slate-900 text-white rounded-lg hover:bg-pink-500 transition-colors text-xs">
                            <i class="fa-solid fa-[#0b132b]"></i>
                            <i class="fa-solid fa-sliders"></i>
                        </button>
                    </div>

                    <!-- Activity Type Checkboxes -->
                    <div class="space-y-3">
                        <h4 class="font-extrabold text-sm text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-shapes text-pink-500 text-xs"></i>
                            Activity Type
                        </h4>
                        <div class="space-y-2.5 text-sm text-slate-600">
                            <label class="flex items-center gap-3 cursor-pointer hover:text-slate-900 select-none">
                                <input type="checkbox" value="Tour" class="filter-checkbox w-4 h-4 rounded border-slate-300 text-pink-500 focus:ring-pink-400">
                                <span class="font-medium">Tour & Travel</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-slate-900 select-none">
                                <input type="checkbox" value="Marathon" class="filter-checkbox w-4 h-4 rounded border-slate-300 text-pink-500 focus:ring-pink-400">
                                <span class="font-medium">Marathon</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-slate-900 select-none">
                                <input type="checkbox" value="Workshop" class="filter-checkbox w-4 h-4 rounded border-slate-300 text-pink-500 focus:ring-pink-400">
                                <span class="font-medium">Workshop</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-slate-900 select-none">
                                <input type="checkbox" value="Outdoor" class="filter-checkbox w-4 h-4 rounded border-slate-300 text-pink-500 focus:ring-pink-400">
                                <span class="font-medium">Outdoor & Adventure</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-slate-900 select-none">
                                <input type="checkbox" value="Sports" class="filter-checkbox w-4 h-4 rounded border-slate-300 text-pink-500 focus:ring-pink-400">
                                <span class="font-medium">Sports</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer hover:text-slate-900 select-none">
                                <input type="checkbox" value="Community" class="filter-checkbox w-4 h-4 rounded border-slate-300 text-pink-500 focus:ring-pink-400">
                                <span class="font-medium">Community</span>
                            </label>
                        </div>
                    </div>

                    <!-- Date Range Dropdown -->
                    <div class="space-y-2">
                        <label class="font-extrabold text-sm text-slate-900 flex items-center gap-2">
                            <i class="fa-regular fa-calendar text-pink-500 text-xs"></i>
                            Date Range
                        </label>
                        <div class="relative">
                            <select id="dateRangeSelect" class="w-full pl-3 pr-8 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-700 appearance-none focus:outline-none focus:border-pink-500">
                                <option value="">Select date range</option>
                                <option value="oct">October 2026</option>
                                <option value="nov">November 2026</option>
                                <option value="dec">December 2026</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400 pointer-events-none"></i>
                        </div>
                    </div>

                    <!-- Location Dropdown -->
                    <div class="space-y-2">
                        <label class="font-extrabold text-sm text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-pink-500 text-xs"></i>
                            Location
                        </label>
                        <div class="relative">
                            <select id="locationSelect" class="w-full pl-3 pr-8 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-700 appearance-none focus:outline-none focus:border-pink-500">
                                <option value="">Any location</option>
                                <option value="Dubai">Dubai</option>
                                <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                                <option value="Hatta">Hatta</option>
                                <option value="Abu Dhabi">Abu Dhabi</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400 pointer-events-none"></i>
                        </div>
                    </div>

                    <!-- Price Range Slider -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="font-extrabold text-sm text-slate-900 flex items-center gap-2">
                                <i class="fa-solid fa-tag text-pink-500 text-xs"></i>
                                Price Range
                            </label>
                            <span id="priceValue" class="text-xs font-bold text-pink-500">Up to AED 300</span>
                        </div>
                        <input id="priceRange" type="range" min="50" max="300" step="10" value="300" class="w-full h-1.5 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-pink-500">
                        <div class="flex items-center justify-between text-xs text-slate-400 font-bold">
                            <span>AED 0</span>
                            <span>AED 300+</span>
                        </div>
                    </div>

                    <!-- Apply Filters Button -->
                    <button onclick="applyFilters()" class="w-full py-3 rounded-xl gradient-btn-primary text-white font-extrabold text-sm shadow-md shadow-pink-500/20 hover:opacity-95 transition-all">
                        Apply Filters
                    </button>
                </div>

                <!-- Promo Banner Card -->
                <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                    <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80" alt="Adventure Promo" class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent p-6 flex flex-col justify-end">
                        <h3 class="text-2xl font-black text-white leading-tight mb-2">
                            Ready for your next <span class="text-pink-400">Adventure?</span>
                        </h3>
                        <p class="text-xs text-slate-300 font-medium mb-4 leading-relaxed">
                            Explore handpicked activities, from city tours to mountain trails and more!
                        </p>
                        <button onclick="registerEvent('Custom Adventure Package')" class="gradient-btn-primary text-white text-xs font-extrabold py-2.5 px-5 rounded-xl self-start flex items-center gap-2 shadow-md">
                            Explore Now <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </button>
                    </div>
                </div>

            </aside>

        </div>
    </main>

    <section class="bg-white border-y border-slate-100 py-8 my-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Item 1 -->
                <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition-colors">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-900 text-sm">Secure Registration</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Your information is safe with us.</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition-colors">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-regular fa-credit-card"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-900 text-sm">Multiple Payment Options</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Cards, wallets & more.</p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition-colors">
                    <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-ticket text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-900 text-sm">Instant Confirmation</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Get your e-ticket immediately.</p>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition-colors">
                    <div class="w-12 h-12 rounded-2xl bg-pink-50 text-pink-600 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-900 text-sm">24/7 Support</h4>
                        <p class="text-xs text-slate-500 mt-0.5">We're here to help anytime.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div id="actionModal" class="fixed inset-0 z-50 hidden bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl relative border border-slate-100 transform transition-all">
            <button onclick="closeModal()" aria-label="Close modal" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
            <div id="modalContent" class="space-y-4">

            </div>
        </div>
    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        const priceRange = document.getElementById('priceRange');
        const priceValue = document.getElementById('priceValue');
        priceRange.addEventListener('input', (e) => {
            priceValue.textContent = `Up to AED ${e.target.value}`;
        });

        function toggleWishlist(btn) {
            const icon = btn.querySelector('i');
            if (icon.classList.contains('fa-regular')) {
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid', 'text-pink-500');
            } else {
                icon.classList.remove('fa-solid', 'text-pink-500');
                icon.classList.add('fa-regular');
            }
        }

        function filterCategory(category, btnElement) {
            const buttons = document.querySelectorAll('.category-btn');
            buttons.forEach(b => {
                b.classList.remove('bg-gradient-to-r', 'from-pink-500', 'to-purple-600', 'text-white', 'shadow-pink-500/20');
                b.classList.add('bg-slate-50', 'text-slate-700');
            });

            btnElement.classList.remove('bg-slate-50', 'text-slate-700');
            btnElement.classList.add('bg-gradient-to-r', 'from-pink-500', 'to-purple-600', 'text-white', 'shadow-pink-500/20');

            const cards = document.querySelectorAll('.activity-card');
            cards.forEach(card => {
                if (category === 'all' || category === 'more' || card.dataset.category === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function applyFilters() {
            const selectedLocation = document.getElementById('locationSelect').value.toLowerCase();
            const maxPrice = parseInt(document.getElementById('priceRange').value, 10);
            const checkboxes = Array.from(document.querySelectorAll('.filter-checkbox:checked')).map(cb => cb.value);
            const searchQuery = document.getElementById('sidebarSearch').value.toLowerCase().trim();

            const cards = document.querySelectorAll('.activity-card');
            cards.forEach(card => {
                const cardCategory = card.dataset.category;
                const cardPrice = parseInt(card.dataset.price, 10);
                const cardLocation = card.dataset.location.toLowerCase();
                const cardTitle = card.querySelector('h3').textContent.toLowerCase();

                const matchesCategory = checkboxes.length === 0 || checkboxes.includes(cardCategory);
                const matchesLocation = !selectedLocation || cardLocation.includes(selectedLocation);
                const matchesPrice = cardPrice <= maxPrice;
                const matchesSearch = !searchQuery || cardTitle.includes(searchQuery);

                if (matchesCategory && matchesLocation && matchesPrice && matchesSearch) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function openModal(type) {
            const modal = document.getElementById('actionModal');
            const content = document.getElementById('modalContent');

            if (type === 'loginModal') {
                content.innerHTML = `
                    <div class="text-center space-y-2">
                        <h3 class="text-2xl font-black text-slate-900">Welcome Back</h3>
                        <p class="text-xs text-slate-500">Sign in to manage your bookings</p>
                    </div>
                    <form class="space-y-3 pt-2" onsubmit="event.preventDefault(); closeModal();">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
                            <input type="email" required placeholder="you@example.com" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-pink-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Password</label>
                            <input type="password" required placeholder="••••••••" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-pink-500">
                        </div>
                        <button type="submit" class="w-full py-3 gradient-btn-primary text-white font-extrabold text-sm rounded-xl shadow-md">Sign In</button>
                    </form>
                `;
            } else if (type === 'registerModal') {
                content.innerHTML = `
                    <div class="text-center space-y-2">
                        <h3 class="text-2xl font-black text-slate-900">Create Account</h3>
                        <p class="text-xs text-slate-500">Join EventHub for instant bookings</p>
                    </div>
                    <form class="space-y-3 pt-2" onsubmit="event.preventDefault(); closeModal();">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Full Name</label>
                            <input type="text" required placeholder="John Doe" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-pink-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
                            <input type="email" required placeholder="you@example.com" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-pink-500">
                        </div>
                        <button type="submit" class="w-full py-3 gradient-btn-primary text-white font-extrabold text-sm rounded-xl shadow-md">Get Started</button>
                    </form>
                `;
            }
            modal.classList.remove('hidden');
        }

        function registerEvent(title) {
            const modal = document.getElementById('actionModal');
            const content = document.getElementById('modalContent');
            content.innerHTML = `
                <div class="text-center space-y-3">
                    <div class="w-12 h-12 bg-pink-100 text-pink-500 rounded-full flex items-center justify-center mx-auto text-xl">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900">Register for Event</h3>
                    <p class="text-sm font-semibold text-pink-500">${title}</p>
                    <p class="text-xs text-slate-500">Fill out your details below to confirm registration.</p>
                </div>
                <form class="space-y-3 pt-2" onsubmit="event.preventDefault(); showSuccess();">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Full Name</label>
                        <input type="text" required placeholder="Your Name" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Phone Number</label>
                        <input type="tel" required placeholder="+971 50 123 4567" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-pink-500">
                    </div>
                    <button type="submit" class="w-full py-3 gradient-btn-primary text-white font-extrabold text-sm rounded-xl shadow-md">Confirm & Pay</button>
                </form>
            `;
            modal.classList.remove('hidden');
        }

        function showSuccess() {
            const content = document.getElementById('modalContent');
            content.innerHTML = `
                <div class="text-center space-y-4 py-4">
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-500 rounded-full flex items-center justify-center mx-auto text-2xl">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">Registration Successful!</h3>
                    <p class="text-xs text-slate-500">We have sent the confirmation ticket to your email.</p>
                    <button onclick="closeModal()" class="w-full py-2.5 bg-slate-900 text-white font-bold text-sm rounded-xl">Close</button>
                </div>
            `;
        }

        function closeModal() {
            document.getElementById('actionModal').classList.add('hidden');
        }

        function handleNewsletter(e) {
            e.preventDefault();
            alert('Thank you for subscribing to EventHub newsletter!');
            e.target.reset();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\run-event\resources\views/activity.blade.php ENDPATH**/ ?>