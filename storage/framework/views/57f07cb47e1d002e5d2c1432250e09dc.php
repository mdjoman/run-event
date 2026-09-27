<?php $__env->startSection('title', 'Dashboard - Admin'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>
<?php $__env->startSection('page-subtitle', "Welcome back, " . auth()->user()->name); ?>

<?php $__env->startSection('body'); ?>


<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 mb-6 sm:mb-8">

    
    <div class="card-glossy p-4 sm:p-5 border-l-4 border-brandPink">
        <div class="flex items-center justify-between gap-2">
            <div class="min-w-0">
                <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Total Events</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-1"><?php echo e($stats['total_events']); ?></h3>
                <p class="text-[10px] sm:text-xs text-green-600 mt-1 sm:mt-2 truncate">
                    <i class="fa-solid fa-arrow-up"></i> Active season
                </p>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-pink-100 text-brandPink flex items-center justify-center text-lg sm:text-2xl flex-shrink-0">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
        </div>
    </div>

    
    <div class="card-glossy p-4 sm:p-5 border-l-4 border-brandBlue">
        <div class="flex items-center justify-between gap-2">
            <div class="min-w-0">
                <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Registrations</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-1"><?php echo e(number_format($stats['total_registrations'])); ?></h3>
                <p class="text-[10px] sm:text-xs text-green-600 mt-1 sm:mt-2 truncate">
                    <i class="fa-solid fa-arrow-up"></i> Total runners
                </p>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-blue-100 text-brandBlue flex items-center justify-center text-lg sm:text-2xl flex-shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
    </div>

    
    <div class="card-glossy p-4 sm:p-5 border-l-4 border-brandOrange">
        <div class="flex items-center justify-between gap-2">
            <div class="min-w-0">
                <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Pending</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-1"><?php echo e($stats['pending_payments']); ?></h3>
                <p class="text-[10px] sm:text-xs text-orange-600 mt-1 sm:mt-2 truncate">
                    <i class="fa-solid fa-clock"></i> Needs review
                </p>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-orange-100 text-brandOrange flex items-center justify-center text-lg sm:text-2xl flex-shrink-0">
                <i class="fa-regular fa-clock"></i>
            </div>
        </div>
    </div>

    
    <div class="card-glossy p-4 sm:p-5 border-l-4 border-brandTeal">
        <div class="flex items-center justify-between gap-2">
            <div class="min-w-0">
                <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Completed</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-1"><?php echo e($stats['completed_events']); ?></h3>
                <p class="text-[10px] sm:text-xs text-teal-600 mt-1 sm:mt-2 truncate">
                    <i class="fa-solid fa-check"></i> All time
                </p>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-teal-100 text-brandTeal flex items-center justify-center text-lg sm:text-2xl flex-shrink-0">
                <i class="fa-solid fa-trophy"></i>
            </div>
        </div>
    </div>

</div>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-6">

    
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm card-glossy overflow-hidden">
        <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800 text-base sm:text-lg flex items-center gap-2">
                <i class="fa-solid fa-users text-brandPink"></i>
                <span class="glossy-text">Recent Registrations</span>
            </h2>
            <a href="<?php echo e(route('admin.registrations.index')); ?>"
               class="text-xs sm:text-sm text-brandPink hover:underline font-medium flex items-center gap-1">
                View All <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold">Runner</th>
                        <th class="px-5 py-3 text-left font-semibold">Event</th>
                        <th class="px-5 py-3 text-left font-semibold">Amount</th>
                        <th class="px-5 py-3 text-left font-semibold">Status</th>
                        <th class="px-5 py-3 text-left font-semibold">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $recentRegistrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-5 py-3 font-medium text-slate-800"><?php echo e($reg->full_name); ?></td>
                            <td class="px-5 py-3 text-slate-600"><?php echo e($reg->event?->title ?? '—'); ?></td>
                            <td class="px-5 py-3 font-semibold text-slate-800">BDT <?php echo e(number_format($reg->amount)); ?></td>
                            <td class="px-5 py-3">
                                <?php
                                    $colors = [
                                        'pending'   => 'bg-yellow-100 text-yellow-700',
                                        'approved'  => 'bg-green-100 text-green-700',
                                        'rejected'  => 'bg-red-100 text-red-700',
                                        'cancelled' => 'bg-slate-100 text-slate-700',
                                    ];
                                ?>
                                <span class="badge <?php echo e($colors[$reg->status] ?? ''); ?>">
                                    <?php echo e(ucfirst($reg->status)); ?>

                                </span>
                            </td>
                            <td class="px-5 py-3 text-slate-500 text-xs"><?php echo e($reg->created_at->diffForHumans()); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-slate-500">No registrations yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="md:hidden divide-y divide-slate-100">
            <?php $__empty_1 = true; $__currentLoopData = $recentRegistrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $colors = [
                        'pending'   => 'bg-yellow-100 text-yellow-700',
                        'approved'  => 'bg-green-100 text-green-700',
                        'rejected'  => 'bg-red-100 text-red-700',
                        'cancelled' => 'bg-slate-100 text-slate-700',
                    ];
                ?>
                <div class="p-4 hover:bg-slate-50 transition">
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <p class="font-semibold text-slate-800 text-sm truncate"><?php echo e($reg->full_name); ?></p>
                        <span class="badge <?php echo e($colors[$reg->status] ?? ''); ?> flex-shrink-0">
                            <?php echo e(ucfirst($reg->status)); ?>

                        </span>
                    </div>
                    <p class="text-xs text-slate-500 truncate mb-1">
                        <i class="fa-regular fa-calendar-check mr-1"></i>
                        <?php echo e($reg->event?->title ?? '—'); ?>

                    </p>
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-bold text-slate-800">BDT <?php echo e(number_format($reg->amount)); ?></span>
                        <span class="text-slate-400"><?php echo e($reg->created_at->diffForHumans()); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="p-8 text-center text-slate-500 text-sm">No registrations yet.</p>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm card-glossy">
        <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800 text-base sm:text-lg flex items-center gap-2">
                <i class="fa-regular fa-calendar-check text-brandBlue"></i>
                <span class="glossy-text">Upcoming</span>
            </h2>
            <a href="<?php echo e(route('admin.events.index')); ?>"
               class="text-xs sm:text-sm text-brandPink hover:underline font-medium">
                Manage
            </a>
        </div>

        <div class="p-4 sm:p-5 space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $percent = $event->slots > 0 ? round(($event->registered / $event->slots) * 100) : 0;
                ?>
                <div class="border border-slate-100 rounded-lg p-3 hover:border-brandPink transition">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0">
                            <h4 class="font-semibold text-slate-800 text-sm truncate"><?php echo e($event->title); ?></h4>
                            <p class="text-xs text-slate-500 mt-1 truncate">
                                <i class="fa-solid fa-location-dot"></i> <?php echo e($event->location); ?>

                            </p>
                            <p class="text-xs text-slate-500 truncate">
                                <i class="fa-regular fa-calendar"></i> <?php echo e($event->event_date->format('d M Y')); ?>

                            </p>
                        </div>
                        <span class="text-xs bg-blue-50 text-brandBlue px-2 py-1 rounded-full font-semibold flex-shrink-0">
                            <?php echo e($event->registered); ?>/<?php echo e($event->slots); ?>

                        </span>
                    </div>

                    <div class="mt-3">
                        <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-brandPink to-purple-500 rounded-full transition-all duration-500"
                                 style="width: <?php echo e($percent); ?>%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1"><?php echo e($percent); ?>% filled</p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-center text-slate-500 text-sm py-4">No upcoming events.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\run-event\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>