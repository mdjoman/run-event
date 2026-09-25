<?php $__env->startSection('title', 'Dashboard - Admin'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>
<?php $__env->startSection('page-subtitle', "Welcome back, " . auth()->user()->name); ?>
<?php $__env->startSection('body'); ?>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

    <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-brandPink">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500 font-medium">Total Events</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1"><?php echo e($stats['total_events']); ?></h3>
                <p class="text-xs text-green-600 mt-2"><i class="fa-solid fa-arrow-up"></i> Active this season</p>
            </div>
            <div class="w-14 h-14 rounded-full bg-pink-100 text-brandPink flex items-center justify-center text-2xl">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-brandBlue">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500 font-medium">Registrations</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1"><?php echo e(number_format($stats['total_registrations'])); ?></h3>
                <p class="text-xs text-green-600 mt-2"><i class="fa-solid fa-arrow-up"></i> Total runners</p>
            </div>
            <div class="w-14 h-14 rounded-full bg-blue-100 text-brandBlue flex items-center justify-center text-2xl">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-brandOrange">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500 font-medium">Pending Payments</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1"><?php echo e($stats['pending_payments']); ?></h3>
                <p class="text-xs text-orange-600 mt-2"><i class="fa-solid fa-clock"></i> Needs review</p>
            </div>
            <div class="w-14 h-14 rounded-full bg-orange-100 text-brandOrange flex items-center justify-center text-2xl">
                <i class="fa-regular fa-clock"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-brandTeal">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500 font-medium">Completed Events</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1"><?php echo e($stats['completed_events']); ?></h3>
                <p class="text-xs text-teal-600 mt-2"><i class="fa-solid fa-check"></i> All time</p>
            </div>
            <div class="w-14 h-14 rounded-full bg-teal-100 text-brandTeal flex items-center justify-center text-2xl">
                <i class="fa-solid fa-trophy"></i>
            </div>
        </div>
    </div>

</div>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800 text-lg">
                <i class="fa-solid fa-users text-brandPink mr-2"></i> Recent Registrations
            </h2>
            <a href="<?php echo e(route('admin.registrations.index')); ?>" class="text-sm text-brandPink hover:underline font-medium">
                View All <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
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
                                <span class="px-2 py-1 rounded-full text-xs font-semibold <?php echo e($colors[$reg->status] ?? ''); ?>">
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
    </div>

    
    <div class="bg-white rounded-xl shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800 text-lg">
                <i class="fa-regular fa-calendar-check text-brandBlue mr-2"></i> Upcoming
            </h2>
            <a href="<?php echo e(route('admin.events.index')); ?>" class="text-sm text-brandPink hover:underline font-medium">
                Manage
            </a>
        </div>

        <div class="p-5 space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $percent = $event->slots > 0 ? round(($event->registered / $event->slots) * 100) : 0;
                ?>
                <div class="border border-slate-100 rounded-lg p-3 hover:border-brandPink transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="font-semibold text-slate-800 text-sm"><?php echo e($event->title); ?></h4>
                            <p class="text-xs text-slate-500 mt-1">
                                <i class="fa-solid fa-location-dot"></i> <?php echo e($event->location); ?>

                            </p>
                            <p class="text-xs text-slate-500">
                                <i class="fa-regular fa-calendar"></i> <?php echo e($event->event_date->format('d M Y')); ?>

                            </p>
                        </div>
                        <span class="text-xs bg-blue-50 text-brandBlue px-2 py-1 rounded-full font-semibold">
                            <?php echo e($event->registered); ?>/<?php echo e($event->slots); ?>

                        </span>
                    </div>

                    <div class="mt-3">
                        <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-brandPink to-purple-500 rounded-full"
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