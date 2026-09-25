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
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brandPink: '#e11d48',
                        brandBlue: '#0284c7',
                        brandTeal: '#0d9488',
                        brandOrange: '#ea580c',
                        sidebar: '#1e293b',
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-link { display: flex; align-items: center; gap: .75rem; padding: .75rem 1rem; border-radius: .5rem; color: #cbd5e1; transition: all .2s; font-size: .9rem; }
        .sidebar-link:hover { background: #334155; color: #fff; }
        .sidebar-link.active { background: #e11d48; color: #fff; font-weight: 600; }
        .badge { padding: .2rem .6rem; border-radius: 9999px; font-size: .7rem; font-weight: 600; display: inline-flex; align-items: center; gap: .25rem; }
    </style>
</head>
<body class="bg-slate-100 font-sans">

<div class="flex min-h-screen">

    
    <aside class="w-64 bg-sidebar text-white flex flex-col fixed h-full z-40">
        <div class="p-5 border-b border-slate-700">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3">
                <img src="<?php echo e(asset('img/logo.png')); ?>" class="h-10 w-10 object-contain bg-white rounded-full p-1" alt="">
                <div class="">
                    <p class="t"><?php echo e(auth()->user()->name); ?></p>
                </div>
            </a>
        </div>

        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-2">Main</p>

            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <i class="fa-solid fa-gauge-high w-5"></i> Dashboard
            </a>

            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mt-5 mb-2">Manage</p>

            <a href="<?php echo e(route('admin.events.index')); ?>"
               class="sidebar-link <?php echo e(request()->routeIs('admin.events.*') ? 'active' : ''); ?>">
                <i class="fa-regular fa-calendar-check w-5"></i> Events
            </a>

            <a href="<?php echo e(route('admin.registrations.index')); ?>"
               class="sidebar-link <?php echo e(request()->routeIs('admin.registrations.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-users w-5"></i> Registrations
            </a>
            <a href="<?php echo e(route('admin.users.index')); ?>"
                class="sidebar-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-user-gear w-5"></i> Users
            </a>

            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mt-5 mb-2">System</p>

            <a href="<?php echo e(route('home')); ?>" target="_blank" class="sidebar-link">
                <i class="fa-solid fa-arrow-up-right-from-square w-5"></i> View Site
            </a>
        </nav>

        <div class="p-4 border-t border-slate-700">
           
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="sidebar-link w-full text-left">
                    <i class="fa-solid fa-right-from-bracket w-5"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    
    <div class="flex-1 ml-64 flex flex-col">

        <header class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-30">
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-slate-800"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                    <p class="text-sm text-slate-500"><?php echo $__env->yieldContent('page-subtitle', 'Welcome back, Admin'); ?></p>
                </div>
                <div class="flex items-center gap-3 pl-4 border-l border-slate-200">
                    <div class="w-9 h-9 rounded-full bg-brandPink text-white flex items-center justify-center font-bold">A</div>
                    <div class="hidden md:block">
                        <p class="text-sm font-semibold text-slate-800"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-xs text-slate-500"><?php echo e(auth()->user()->email); ?></p>
                    </div>
                </div>
            </div>
        </header>

        <?php if(session('success')): ?>
            <div class="mx-6 mt-4 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-700 flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="mx-6 mt-4 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-red-700 flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i> <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <main class="flex-1 p-6">
            <?php echo $__env->yieldContent('body'); ?>
        </main>

        <footer class="px-6 py-4 text-center text-sm text-slate-500 border-t bg-white">
            © <span id="adminYear"></span> Run Burjowan Admin Panel.
        </footer>
    </div>
</div>

<script>
    document.getElementById('adminYear').textContent = new Date().getFullYear();

</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\run-event\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>