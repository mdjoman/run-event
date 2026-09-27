<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin - Run Burjowan'); ?></title>
    <link rel="icon" type="image/webp" href="<?php echo e(asset('img/logo.png')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                    colors: {
                        brandPink: '#e11d48',
                        brandBlue: '#0284c7',
                        brandTeal: '#0d9488',
                        brandOrange: '#ea580c',
                        sidebar: '#1e293b',
                    },
                    animation: {
                        'slide-in': 'slideIn 0.3s ease-out',
                        'fade-in': 'fadeIn 0.4s ease-out',
                        'shimmer': 'shimmer 3s ease-in-out infinite',
                    },
                    keyframes: {
                        slideIn: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        shimmer: {
                            '0%, 100%': { backgroundPosition: '-200% center' },
                            '50%': { backgroundPosition: '200% center' },
                        },
                    },
                }
            }
        }
    </script>
    <style>
        /* ============ SIDEBAR LINKS ============ */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .7rem 1rem;
            border-radius: .5rem;
            color: #cbd5e1;
            transition: all .2s;
            font-size: .9rem;
            position: relative;
            overflow: hidden;
        }
        .sidebar-link:hover {
            background: #334155;
            color: #fff;
            transform: translateX(3px);
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(225, 29, 72, 0.4);
        }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #fff;
        }

        /* ============ GLOSSY TEXT ============ */
        .glossy-text {
            background: linear-gradient(
                135deg,
                #1e293b 0%,
                #475569 25%,
                #1e293b 50%,
                #64748b 75%,
                #1e293b 100%
            );
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s ease-in-out infinite;
            font-weight: 800;
        }

        .glossy-text-pink {
            background: linear-gradient(
                135deg,
                #e11d48 0%,
                #fb7185 25%,
                #e11d48 50%,
                #f43f5e 75%,
                #be123c 100%
            );
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s ease-in-out infinite;
            font-weight: 800;
        }

        .glossy-text-white {
            background: linear-gradient(
                135deg,
                #ffffff 0%,
                #e2e8f0 25%,
                #ffffff 50%,
                #cbd5e1 75%,
                #ffffff 100%
            );
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s ease-in-out infinite;
            font-weight: 800;
        }

        .glossy-bg {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #1e293b 100%);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1),
                        0 4px 20px rgba(0,0,0,0.2);
        }

        .card-glossy {
            position: relative;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }
        .card-glossy:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }
        .card-glossy::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #e11d48, #0284c7, #0d9488, #ea580c);
            background-size: 300% 100%;
            animation: shimmer 6s linear infinite;
        }

        /* ============ SCROLLBAR ============ */
        .sidebar-nav::-webkit-scrollbar { width: 5px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: #475569; border-radius: 5px; }
        .sidebar-nav::-webkit-scrollbar-thumb:hover { background: #64748b; }

        /* ============ OVERLAY ============ */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(2px);
            z-index: 45;
            opacity: 0;
            visibility: hidden;
            transition: opacity .3s, visibility .3s;
        }
        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* ============ SIDEBAR TRANSITION ============ */
        #adminSidebar {
            transition: transform .3s ease-in-out;
        }

        @media (max-width: 1023px) {
            #adminSidebar {
                transform: translateX(-100%);
            }
            #adminSidebar.open {
                transform: translateX(0);
            }
        }

        /* ============ BADGE ============ */
        .badge {
            padding: .2rem .6rem;
            border-radius: 9999px;
            font-size: .7rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: .25rem;
        }

        /* ============ MOBILE HEADER SHADOW ============ */
        @media (max-width: 1023px) {
            .admin-header {
                box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            }
        }
    </style>
</head>
<body class="bg-slate-100 font-sans antialiased">

<div class="flex min-h-screen">

    
    <div id="sidebarOverlay" class="sidebar-overlay lg:hidden"></div>

    
    <aside id="adminSidebar"
           class="w-64 glossy-bg text-white flex flex-col fixed h-full z-50 lg:z-40">

        
        <div class="p-5 border-b border-slate-700/50">
            <div class="flex items-center justify-between">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 min-w-0">
                    <img src="<?php echo e(asset('img/logo.png')); ?>"
                         class="h-10 w-10 object-contain bg-white rounded-full p-1 flex-shrink-0"
                         alt="Logo">
                    <div class="min-w-0">
                        <p class="text-xs text-slate-400">Welcome back,</p>
                        <p class="glossy-text-white text-sm truncate"><?php echo e(auth()->user()->name); ?></p>
                    </div>
                </a>

                
                <button id="closeSidebar"
                        class="lg:hidden text-slate-400 hover:text-white p-1">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
        </div>

        
        <nav class="sidebar-nav flex-1 p-4 space-y-1 overflow-y-auto">

            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-2 tracking-wider">Main</p>

            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <i class="fa-solid fa-gauge-high w-5"></i>
                <span>Dashboard</span>
            </a>

            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mt-5 mb-2 tracking-wider">Manage</p>

            <a href="<?php echo e(route('admin.events.index')); ?>"
               class="sidebar-link <?php echo e(request()->routeIs('admin.events.*') ? 'active' : ''); ?>">
                <i class="fa-regular fa-calendar-check w-5"></i>
                <span>Events</span>
            </a>

            <a href="<?php echo e(route('admin.registrations.index')); ?>"
               class="sidebar-link <?php echo e(request()->routeIs('admin.registrations.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-users w-5"></i>
                <span>Registrations</span>
                <?php if(isset($pendingCount) && $pendingCount > 0): ?>
                    <span class="ml-auto bg-brandPink text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                        <?php echo e($pendingCount); ?>

                    </span>
                <?php endif; ?>
            </a>

            <a href="<?php echo e(route('admin.users.index')); ?>"
               class="sidebar-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-user-gear w-5"></i>
                <span>Users</span>
            </a>

            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mt-5 mb-2 tracking-wider">System</p>

            <a href="<?php echo e(route('home')); ?>" target="_blank" class="sidebar-link">
                <i class="fa-solid fa-arrow-up-right-from-square w-5"></i>
                <span>View Site</span>
            </a>
        </nav>

        
        <div class="p-4 border-t border-slate-700/50">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="sidebar-link w-full text-left">
                    <i class="fa-solid fa-right-from-bracket w-5"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    
    <div class="flex-1 lg:ml-64 flex flex-col min-w-0">

        
        <header class="admin-header bg-white shadow-sm border-b border-slate-200 sticky top-0 z-30">
            <div class="px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between gap-3">

                <div class="flex items-center gap-3 min-w-0">
                    
                    <button id="openSidebar"
                            class="lg:hidden w-10 h-10 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-700 transition">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <div class="min-w-0">
                        <h1 class="glossy-text text-lg sm:text-xl font-bold truncate">
                            <?php echo $__env->yieldContent('page-title', 'Dashboard'); ?>
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-500 truncate">
                            <?php echo $__env->yieldContent('page-subtitle', 'Welcome back, Admin'); ?>
                        </p>
                    </div>
                </div>

                
                <div class="flex items-center gap-3 pl-3 sm:pl-4 border-l border-slate-200 flex-shrink-0">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-brandPink to-purple-600 text-white flex items-center justify-center font-bold shadow-md">
                        <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                    </div>
                    <div class="hidden md:block min-w-0">
                        <p class="text-sm font-semibold text-slate-800 truncate"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-xs text-slate-500 truncate"><?php echo e(auth()->user()->email); ?></p>
                    </div>
                </div>
            </div>
        </header>

        
        <?php if(session('success')): ?>
            <div class="mx-4 sm:mx-6 mt-4 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-700 flex items-center gap-2 animate-fade-in">
                <i class="fa-solid fa-circle-check flex-shrink-0"></i>
                <span class="text-sm"><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="mx-4 sm:mx-6 mt-4 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-red-700 flex items-center gap-2 animate-fade-in">
                <i class="fa-solid fa-circle-exclamation flex-shrink-0"></i>
                <span class="text-sm"><?php echo e(session('error')); ?></span>
            </div>
        <?php endif; ?>

        
        <main class="flex-1 p-4 sm:p-6 animate-fade-in">
            <?php echo $__env->yieldContent('body'); ?>
        </main>

        
        <footer class="px-4 sm:px-6 py-4 text-center text-xs sm:text-sm text-slate-500 border-t bg-white">
            &copy; <span id="adminYear"></span>
            <span class="glossy-text-pink font-semibold">Run Burjowan</span> Admin Panel
        </footer>
    </div>
</div>

<script>
    document.getElementById('adminYear').textContent = new Date().getFullYear();

    // ============ SIDEBAR TOGGLE ============
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const openBtn = document.getElementById('openSidebar');
    const closeBtn = document.getElementById('closeSidebar');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    if (openBtn)  openBtn.addEventListener('click', openSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
    if (overlay)  overlay.addEventListener('click', closeSidebar);

    // Close sidebar on route change (mobile)
    document.querySelectorAll('#adminSidebar a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) closeSidebar();
        });
    });

    // Escape key closes sidebar
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) closeSidebar();
    });
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\run-event\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>