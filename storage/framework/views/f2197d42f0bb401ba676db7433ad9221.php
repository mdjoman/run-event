<?php $__env->startSection('title', 'Events - Admin'); ?>
<?php $__env->startSection('page-title', 'Manage Events'); ?>
<?php $__env->startSection('page-subtitle', 'Create, edit, and manage your running events'); ?>

<?php $__env->startSection('body'); ?>


<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">

    
    <form method="GET" class="flex items-center gap-2 w-full sm:w-auto">
        <div class="relative flex-1 sm:flex-none">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                   placeholder="Search events..."
                   class="w-full sm:w-64 pl-9 pr-4 py-2 border border-slate-200 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-brandPink focus:border-transparent
                          transition">
        </div>
        <button class="px-4 py-2 bg-slate-800 text-white rounded-lg text-sm hover:bg-slate-700 transition flex-shrink-0">
            <i class="fa-solid fa-search"></i>
            <span class="hidden sm:inline ml-1">Search</span>
        </button>

        <?php if(request('search')): ?>
            <a href="<?php echo e(route('admin.events.index')); ?>"
               class="px-3 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm hover:bg-slate-200 transition flex-shrink-0"
               title="Clear search">
                <i class="fa-solid fa-xmark"></i>
            </a>
        <?php endif; ?>
    </form>

    
    <a href="<?php echo e(route('admin.events.create')); ?>"
       class="bg-gradient-to-r from-brandPink to-pink-600 hover:from-pink-600 hover:to-brandPink
              text-white px-5 py-2.5 rounded-lg text-sm font-semibold flex items-center justify-center
              gap-2 transition shadow-md hover:shadow-lg w-full sm:w-auto">
        <i class="fa-solid fa-plus"></i>
        <span>Add New Event</span>
    </a>
</div>


<div class="bg-white rounded-xl shadow-sm overflow-hidden card-glossy">

    
    <div class="hidden lg:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold">Event</th>
                    <th class="px-5 py-3 text-left font-semibold">Date & Time</th>
                    <th class="px-5 py-3 text-left font-semibold">Location</th>
                    <th class="px-5 py-3 text-left font-semibold">Categories</th>
                    <th class="px-5 py-3 text-left font-semibold">Slots</th>
                    <th class="px-5 py-3 text-left font-semibold">Status</th>
                    <th class="px-5 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $distances = collect($event->categories ?? [])->pluck('distance')->filter()->take(3);
                    ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-brandPink to-purple-600
                                            flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">
                                    <i class="fa-solid fa-person-running"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-800 truncate"><?php echo e($event->title); ?></p>
                                    <p class="text-xs text-slate-500 truncate">
                                        <?php echo e($event->subtitle ?? $event->category ?? '—'); ?>

                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-700">
                            <div class="font-medium"><?php echo e($event->event_date?->format('d M Y') ?? '—'); ?></div>
                            <div class="text-xs text-slate-500"><?php echo e($event->start_time ?? '—'); ?></div>
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            <i class="fa-solid fa-location-dot text-brandPink"></i> <?php echo e($event->location ?? '—'); ?>

                        </td>
                        <td class="px-5 py-4">
                            <?php if($distances->count()): ?>
                                <div class="flex flex-wrap gap-1">
                                    <?php $__currentLoopData = $distances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-blue-50 text-brandBlue"><?php echo e($d); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <span class="text-slate-400 text-xs">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-semibold text-slate-800"><?php echo e($event->registered); ?></span>
                            <span class="text-slate-400"> / <?php echo e($event->slots); ?></span>
                        </td>
                        <td class="px-5 py-4">
                            <?php
                                $colors = [
                                    'active'    => 'bg-green-100 text-green-700',
                                    'draft'     => 'bg-slate-100 text-slate-700',
                                    'completed' => 'bg-blue-100 text-blue-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                ];
                            ?>
                            <span class="badge <?php echo e($colors[$event->status] ?? 'bg-slate-100 text-slate-700'); ?>">
                                <?php echo e(ucfirst($event->status)); ?>

                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">

                                
                                <a href="<?php echo e(route('admin.events.show', $event)); ?>"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-brandBlue hover:bg-blue-100 transition"
                                   title="View">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>

                                
                                <a href="<?php echo e(route('admin.events.edit', $event)); ?>"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition"
                                   title="Edit">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>

                                
                                <form action="<?php echo e(route('admin.events.destroy', $event)); ?>" method="POST"
                                      onsubmit="return confirm('Delete this event?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="w-8 h-8 flex items-center justify-center rounded-lg
                                                   bg-red-50 text-red-600 hover:bg-red-100 transition"
                                            title="Delete">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="px-5 py-10 text-center text-slate-500">
                            <i class="fa-regular fa-folder-open text-3xl mb-2 block text-slate-300"></i>
                            <p class="text-sm font-medium">No events found.</p>
                            <p class="text-xs mt-1">Click "Add New Event" to create your first one.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="lg:hidden divide-y divide-slate-100">
        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $colors = [
                    'active'    => 'bg-green-100 text-green-700',
                    'draft'     => 'bg-slate-100 text-slate-700',
                    'completed' => 'bg-blue-100 text-blue-700',
                    'cancelled' => 'bg-red-100 text-red-700',
                ];
                $progress = $event->slots > 0
                    ? round(($event->registered / $event->slots) * 100)
                    : 0;
            ?>

            <div class="p-4 hover:bg-slate-50 transition">

                
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-brandPink to-purple-600
                                flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">
                        <i class="fa-solid fa-person-running"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <p class="font-semibold text-slate-800 truncate"><?php echo e($event->title); ?></p>
                                <p class="text-xs text-slate-500 truncate">
                                    <?php echo e($event->subtitle ?? $event->category ?? '—'); ?>

                                </p>
                            </div>
                            <span class="badge <?php echo e($colors[$event->status] ?? 'bg-slate-100 text-slate-700'); ?> flex-shrink-0">
                                <?php echo e(ucfirst($event->status)); ?>

                            </span>
                        </div>
                    </div>
                </div>

                
                <div class="grid grid-cols-2 gap-3 mb-3 text-xs">
                    <div class="flex items-center gap-2 text-slate-600">
                        <i class="fa-regular fa-calendar text-brandPink w-4"></i>
                        <span class="truncate"><?php echo e($event->event_date?->format('d M Y') ?? '—'); ?></span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-600">
                        <i class="fa-regular fa-clock text-brandPink w-4"></i>
                        <span class="truncate"><?php echo e($event->start_time ?? '—'); ?></span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-600 col-span-2">
                        <i class="fa-solid fa-location-dot text-brandPink w-4"></i>
                        <span class="truncate"><?php echo e($event->location ?? '—'); ?></span>
                    </div>
                </div>

                
                <div class="mb-3">
                    <div class="flex items-center justify-between text-xs mb-1">
                        <span class="text-slate-500">Slots filled</span>
                        <span class="font-semibold text-slate-700">
                            <?php echo e($event->registered); ?> / <?php echo e($event->slots); ?>

                            <span class="text-slate-400 font-normal">(<?php echo e($progress); ?>%)</span>
                        </span>
                    </div>
                    <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-brandPink to-purple-500 rounded-full transition-all duration-500"
                             style="width: <?php echo e($progress); ?>%"></div>
                    </div>
                </div>

                
                <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider">Fee</p>
                        <p class="font-bold text-slate-800 text-sm">BDT <?php echo e(number_format($event->fee)); ?></p>
                    </div>

                    <div class="flex items-center gap-2">
                        
                        <a href="<?php echo e(route('admin.events.show', $event)); ?>"
                           class="w-9 h-9 flex items-center justify-center rounded-lg
                                  bg-blue-50 text-brandBlue hover:bg-blue-100 transition"
                           title="View">
                            <i class="fa-solid fa-eye text-xs"></i>
                        </a>

                        
                        <a href="<?php echo e(route('admin.events.edit', $event)); ?>"
                           class="w-9 h-9 flex items-center justify-center rounded-lg
                                  bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition"
                           title="Edit">
                            <i class="fa-solid fa-pen text-xs"></i>
                        </a>

                        
                        <form action="<?php echo e(route('admin.events.destroy', $event)); ?>" method="POST"
                              onsubmit="return confirm('Delete this event?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="w-9 h-9 flex items-center justify-center rounded-lg
                                           bg-red-50 text-red-600 hover:bg-red-100 transition"
                                    title="Delete">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="p-10 text-center text-slate-500">
                <i class="fa-regular fa-folder-open text-4xl mb-3 block text-slate-300"></i>
                <p class="text-sm font-medium mb-1">No events found</p>
                <p class="text-xs">Click "Add New Event" to create your first one.</p>
            </div>
        <?php endif; ?>
    </div>

    
    <?php if($events->hasPages()): ?>
        <div class="px-4 sm:px-5 py-3 border-t border-slate-100">
            <?php echo e($events->links()); ?>

        </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\run-event\resources\views/admin/events/index.blade.php ENDPATH**/ ?>