<?php $__env->startSection('title', $event->title . ' - Event Details'); ?>
<?php $__env->startSection('page-title', 'Event Details'); ?>
<?php $__env->startSection('page-subtitle', $event->title); ?>

<?php $__env->startSection('body'); ?>

<?php
    $categories   = $event->categories   ?? [];
    $entitlements = $event->entitlements ?? [];
    $awards       = $event->awards       ?? [];
    $schedules    = $event->schedules    ?? [];
    $rules        = $event->rules        ?? [];

    $statusColors = [
        'active'    => 'bg-green-100 text-green-700',
        'draft'     => 'bg-slate-100 text-slate-700',
        'completed' => 'bg-blue-100 text-blue-700',
        'cancelled' => 'bg-red-100 text-red-700',
    ];

    $imageUrl = $event->image ? (\Illuminate\Support\Str::startsWith($event->image, ['http://','https://'])
                    ? $event->image
                    : (\Illuminate\Support\Str::startsWith($event->image, 'events/')
                        ? asset('storage/' . $event->image)
                        : asset($event->image)))
                : null;

    $heroUrl = $event->hero_image ? (\Illuminate\Support\Str::startsWith($event->hero_image, ['http://','https://'])
                    ? $event->hero_image
                    : (\Illuminate\Support\Str::startsWith($event->hero_image, 'events/')
                        ? asset('storage/' . $event->hero_image)
                        : asset($event->hero_image)))
                : null;
?>


<div class="flex flex-wrap items-center justify-between gap-2 mb-5">
    <div class="flex items-center gap-2.5">
        <a href="<?php echo e(route('admin.events.index')); ?>"
           class="w-9 h-9 rounded-lg bg-white shadow-sm border border-slate-200
                  flex items-center justify-center text-slate-700
                  hover:text-brandPink hover:border-brandPink transition">
            <i class="fa-solid fa-arrow-left text-xs"></i>
        </a>
        <div>
            <p class="text-[9px] uppercase tracking-[0.12em] text-slate-500 font-bold">Events</p>
            <p class="text-[14px] font-extrabold text-slate-900 leading-tight">
                #<?php echo e($event->id); ?> · <?php echo e($event->title); ?>

            </p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <a href="<?php echo e(route('admin.registrations.index', ['event_id' => $event->id])); ?>"
           class="px-3 py-1.5 rounded-lg bg-blue-50 border border-blue-200
                  text-[11px] font-bold text-blue-700 hover:bg-blue-100 transition">
            <i class="fa-solid fa-users"></i> Registrations (<?php echo e($event->registrations->count()); ?>)
        </a>
        <a href="<?php echo e(route('admin.events.edit', $event)); ?>"
           class="px-3 py-1.5 rounded-lg bg-yellow-50 border border-yellow-200
                  text-[11px] font-bold text-yellow-700 hover:bg-yellow-100 transition">
            <i class="fa-solid fa-pen"></i> Edit
        </a>
    </div>
</div>


<div class="bg-gradient-to-r from-slate-900 via-slate-900 to-brandPink rounded-xl shadow-md
            px-5 py-5 mb-5 text-white relative overflow-hidden">
    <div class="absolute -top-12 -right-12 w-40 h-40 rounded-full bg-white/5"></div>
    <div class="absolute -bottom-16 -right-4 w-52 h-52 rounded-full bg-white/5"></div>

    <div class="relative flex flex-wrap items-center gap-4">
        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-pink-500 to-purple-600
                    flex items-center justify-center shadow-xl ring-2 ring-white/25 flex-shrink-0">
            <i class="fa-solid fa-person-running text-2xl"></i>
        </div>

        <div class="flex-1 min-w-[200px]">
            <h2 class="text-lg font-extrabold leading-tight"><?php echo e($event->title); ?></h2>
            <?php if($event->subtitle): ?>
                <p class="text-[12px] text-slate-200 mt-0.5"><?php echo e($event->subtitle); ?></p>
            <?php endif; ?>

            <div class="flex flex-wrap items-center gap-1.5 mt-2">
                <?php if($event->race_type): ?>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold
                                 bg-white/15 backdrop-blur ring-1 ring-white/25">
                        <i class="fa-solid fa-flag-checkered mr-1"></i><?php echo e($event->race_type); ?>

                    </span>
                <?php endif; ?>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold
                             bg-white/15 backdrop-blur ring-1 ring-white/25">
                    <i class="fa-solid fa-location-dot mr-1"></i><?php echo e($event->location); ?>

                </span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold
                             bg-white/15 backdrop-blur ring-1 ring-white/25">
                    <i class="fa-regular fa-calendar mr-1"></i><?php echo e($event->event_date?->format('d M Y')); ?>

                </span>
                <?php if($event->is_featured): ?>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold
                                 bg-yellow-400 text-yellow-900 ring-1 ring-yellow-300">
                        <i class="fa-solid fa-star mr-0.5"></i>FEATURED
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="text-right shrink-0">
            <p class="text-[9px] uppercase tracking-[0.12em] text-slate-300 mb-1 font-bold">Status</p>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                         font-extrabold text-[11px] bg-white text-slate-900 shadow">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <?php echo e(ucfirst($event->status)); ?>

            </span>
        </div>
    </div>
</div>


<div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-5">
    <div class="bg-white rounded-lg shadow-sm p-3 border-l-4 border-brandPink">
        <p class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold">Fee</p>
        <p class="text-xl font-bold text-slate-800">BDT <?php echo e(number_format($event->fee)); ?></p>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-3 border-l-4 border-blue-500">
        <p class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold">Slots</p>
        <p class="text-xl font-bold text-slate-800"><?php echo e($event->slots); ?></p>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-3 border-l-4 border-green-500">
        <p class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold">Registered</p>
        <p class="text-xl font-bold text-slate-800"><?php echo e($event->registered); ?></p>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-3 border-l-4 border-purple-500">
        <p class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold">Categories</p>
        <p class="text-xl font-bold text-slate-800"><?php echo e(count($categories)); ?></p>
    </div>
</div>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    
    <div class="lg:col-span-2 space-y-5">

        
        <?php if($imageUrl || $heroUrl): ?>
            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5">
                <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-pink-100 text-pink-700 flex items-center justify-center">
                        <i class="fa-solid fa-image text-xs"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-sm">Images</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php if($imageUrl): ?>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold mb-2">Main Image</p>
                            <div class="aspect-video bg-slate-100 rounded-lg overflow-hidden border border-slate-200">
                                <img src="<?php echo e($imageUrl); ?>" alt="Main image"
                                     class="w-full h-full object-cover">
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1 font-mono truncate"><?php echo e($event->image); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if($heroUrl): ?>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold mb-2">Hero Image</p>
                            <div class="aspect-video bg-slate-100 rounded-lg overflow-hidden border border-slate-200">
                                <img src="<?php echo e($heroUrl); ?>" alt="Hero image"
                                     class="w-full h-full object-cover">
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1 font-mono truncate"><?php echo e($event->hero_image); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        
        <?php if($event->description): ?>
            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5">
                <div class="flex items-center gap-2 mb-3 pb-3 border-b border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-pink-100 text-pink-700 flex items-center justify-center">
                        <i class="fa-solid fa-align-left text-xs"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-sm">Description</h3>
                </div>
                <div class="text-[13px] text-slate-700 leading-relaxed space-y-3">
                         <?php echo $event->description; ?>

                </div>
            </div>
        <?php endif; ?>

        
        <?php if(count($categories) > 0): ?>
            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5">
                <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
                        <i class="fa-solid fa-list text-xs"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-sm">
                        Race Categories
                        <span class="badge bg-blue-100 text-blue-700 ml-2"><?php echo e(count($categories)); ?></span>
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border border-slate-200 rounded-lg p-4
                                    bg-gradient-to-br from-slate-50 to-white
                                    hover:border-brandPink hover:shadow-md transition">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <div class="text-2xl font-extrabold text-brandPink">
                                        <?php echo e($cat['distance'] ?? ''); ?>

                                    </div>
                                    <div class="text-xs uppercase tracking-wider text-slate-500 font-bold">
                                        <?php echo e($cat['name'] ?? ''); ?>

                                    </div>
                                </div>
                                <div class="w-9 h-9 rounded-full bg-brandPink/10 text-brandPink flex items-center justify-center">
                                    <i class="fa-solid fa-person-running"></i>
                                </div>
                            </div>

                            <?php if(!empty($cat['tagline'])): ?>
                                <p class="text-[12px] font-bold text-slate-800 italic mb-1">
                                    "<?php echo e($cat['tagline']); ?>"
                                </p>
                            <?php endif; ?>
                            <?php if(!empty($cat['description'])): ?>
                                <p class="text-[11.5px] text-slate-600 leading-relaxed mb-2">
                                    <?php echo e($cat['description']); ?>

                                </p>
                            <?php endif; ?>

                            <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-slate-100 text-[11px]">
                                <?php if(!empty($cat['cutoff'])): ?>
                                    <span class="badge bg-amber-100 text-amber-700">
                                        <i class="fa-solid fa-clock text-[9px]"></i> <?php echo e($cat['cutoff']); ?>

                                    </span>
                                <?php endif; ?>
                                <?php if(!empty($cat['fee'])): ?>
                                    <span class="badge bg-green-100 text-green-700">
                                        <i class="fa-solid fa-money-bill-wave text-[9px]"></i>
                                        BDT <?php echo e(number_format((float) $cat['fee'])); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        
        <?php if(count($entitlements) > 0): ?>
            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5">
                <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center">
                        <i class="fa-solid fa-gift text-xs"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-sm">
                        Runner Entitlements
                        <span class="badge bg-teal-100 text-teal-700 ml-2"><?php echo e(count($entitlements)); ?></span>
                    </h3>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    <?php $__currentLoopData = $entitlements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="text-center p-3 rounded-lg bg-slate-50 border border-slate-100
                                    hover:border-brandPink hover:shadow-sm transition">
                            <div class="text-2xl mb-1.5"><?php echo e($ent['icon'] ?? '🎁'); ?></div>
                            <p class="text-[11px] font-semibold text-slate-700 leading-tight">
                                <?php echo nl2br(e($ent['text'] ?? '')); ?>

                            </p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        
        <?php if(!empty($awards) && !empty($awards['positions'])): ?>
            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5">
                <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-yellow-100 text-yellow-700 flex items-center justify-center">
                        <i class="fa-solid fa-trophy text-xs"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-sm">Awards & Recognition</h3>
                </div>

                <?php if(!empty($awards['intro'])): ?>
                    <div class="text-[12.5px] text-slate-700 mb-3 p-3
                                bg-yellow-50 border-l-4 border-yellow-400 rounded">
                        <?php echo nl2br(e($awards['intro'])); ?>

                    </div>
                <?php endif; ?>

                <div class="overflow-x-auto">
                    <table class="w-full text-[12px] border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-3 py-2 text-left font-bold text-slate-700 border border-slate-200">
                                    Position
                                </th>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th class="px-3 py-2 text-left font-bold text-slate-700 border border-slate-200">
                                        <?php echo e($cat['name'] ?? ''); ?> (<?php echo e($cat['distance'] ?? ''); ?>)
                                    </th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $awards['positions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-slate-50">
                                    <td class="px-3 py-2 font-semibold text-slate-800 border border-slate-200">
                                        <?php echo e($pos['label'] ?? ''); ?>

                                    </td>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td class="px-3 py-2 text-slate-700 border border-slate-200">
                                            <?php if(!empty($pos['amounts'][$i])): ?>
                                                <strong class="text-green-700"><?php echo e($pos['amounts'][$i]); ?></strong> BDT
                                            <?php else: ?>
                                                <span class="text-slate-400">—</span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <?php if(!empty($awards['notes'])): ?>
                    <div class="mt-3 p-3 bg-slate-50 border-l-4 border-slate-400 rounded text-[11.5px] text-slate-700">
                        <strong>Important Notes:</strong><br>• <?php echo e($awards['notes']); ?>

                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        
        <?php if(count($schedules) > 0): ?>
            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5">
                <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-violet-100 text-violet-700 flex items-center justify-center">
                        <i class="fa-solid fa-clock text-xs"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-sm">Race Day Schedule</h3>
                </div>

                <div class="space-y-2">
                    <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg border-l-4 border-brandPink">
                            <div class="text-[12px] font-extrabold text-brandPink w-20 flex-shrink-0">
                                <?php echo e($sch['time'] ?? ''); ?>

                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[12.5px] font-semibold text-slate-800">
                                    <?php echo e($sch['title'] ?? ''); ?>

                                </p>
                                <?php if(!empty($sch['note'])): ?>
                                    <p class="text-[11px] text-slate-500 mt-0.5"><?php echo e($sch['note']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        
        <?php if(count($rules) > 0): ?>
            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5">
                <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-red-100 text-red-700 flex items-center justify-center">
                        <i class="fa-solid fa-clipboard-list text-xs"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-sm">Rules & Guidelines</h3>
                </div>

                <ol class="space-y-2">
                    <?php $__currentLoopData = $rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-slate-50 transition">
                            <span class="w-6 h-6 rounded-full bg-brandPink text-white text-[11px] font-bold
                                         flex items-center justify-center flex-shrink-0">
                                <?php echo e($i + 1); ?>

                            </span>
                            <p class="text-[12.5px] text-slate-700 leading-relaxed"><?php echo e($rule); ?></p>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </div>
        <?php endif; ?>

    </div>

    
    <div class="space-y-5">

        
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5">
            <h3 class="font-extrabold text-slate-900 text-sm mb-3">
                <i class="fa-solid fa-circle-info text-brandPink mr-1.5"></i> Quick Info
            </h3>

            <div class="space-y-2.5 text-[12.5px]">
                <div class="flex items-start justify-between gap-3 pb-2 border-b border-slate-100">
                    <span class="text-slate-500 font-semibold flex-shrink-0">Organizer</span>
                    <span class="font-bold text-slate-800 text-right"><?php echo e($event->organizer ?? '—'); ?></span>
                </div>
                <div class="flex items-start justify-between gap-3 pb-2 border-b border-slate-100">
                    <span class="text-slate-500 font-semibold flex-shrink-0">Race Type</span>
                    <span class="font-bold text-slate-800 text-right"><?php echo e($event->race_type ?? '—'); ?></span>
                </div>
                <div class="flex items-start justify-between gap-3 pb-2 border-b border-slate-100">
                    <span class="text-slate-500 font-semibold flex-shrink-0">Start Time</span>
                    <span class="font-bold text-slate-800 text-right"><?php echo e($event->start_time ?? '—'); ?></span>
                </div>
                <div class="flex items-start justify-between gap-3 pb-2 border-b border-slate-100">
                    <span class="text-slate-500 font-semibold flex-shrink-0">Category Label</span>
                    <span class="font-bold text-slate-800 text-right"><?php echo e($event->category ?? '—'); ?></span>
                </div>
                <div class="flex items-start justify-between gap-3 pb-2 border-b border-slate-100">
                    <span class="text-slate-500 font-semibold flex-shrink-0">Slug</span>
                    <span class="font-mono text-[11px] text-slate-700 text-right truncate"><?php echo e($event->slug ?? '—'); ?></span>
                </div>
                <div class="flex items-start justify-between gap-3">
                    <span class="text-slate-500 font-semibold flex-shrink-0">Tagline</span>
                    <span class="font-bold text-slate-800 text-right italic"><?php echo e($event->tagline ?? '—'); ?></span>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-5">
            <div class="flex items-center justify-between mb-3">
                <h3 class="font-extrabold text-slate-900 text-sm">
                    <i class="fa-solid fa-users text-brandPink mr-1.5"></i> Recent Registrations
                </h3>
                <span class="badge bg-blue-100 text-blue-700"><?php echo e($event->registrations->count()); ?></span>
            </div>

            <div class="space-y-2 max-h-64 overflow-y-auto">
                <?php $__empty_1 = true; $__currentLoopData = $event->registrations->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('admin.registrations.show', $reg)); ?>"
                       class="flex items-center gap-2 p-2 rounded-lg hover:bg-slate-50 transition">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brandPink to-purple-500
                                    text-white text-[11px] font-bold
                                    flex items-center justify-center flex-shrink-0">
                            <?php echo e(strtoupper(substr($reg->first_name ?? 'X', 0, 1))); ?>

                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[11.5px] font-semibold text-slate-800 truncate">
                                <?php echo e($reg->first_name); ?> <?php echo e($reg->last_name); ?>

                            </p>
                            <p class="text-[10px] text-slate-500 truncate">
                                <?php echo e($reg->category); ?> · <?php echo e($reg->bib_number ? 'BIB '.$reg->bib_number : 'Pending'); ?>

                            </p>
                        </div>
                        <span class="text-[9px] px-1.5 py-0.5 rounded flex-shrink-0
                            <?php if($reg->status === 'approved'): ?> bg-green-100 text-green-700
                            <?php elseif($reg->status === 'rejected'): ?> bg-red-100 text-red-700
                            <?php else: ?> bg-yellow-100 text-yellow-700 <?php endif; ?>">
                            <?php echo e(ucfirst($reg->status)); ?>

                        </span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center text-slate-400 text-[12px] py-4">No registrations yet.</p>
                <?php endif; ?>
            </div>

            <?php if($event->registrations->count() > 8): ?>
                <a href="<?php echo e(route('admin.registrations.index', ['event_id' => $event->id])); ?>"
                   class="mt-3 block text-center text-[11px] font-bold text-brandPink hover:underline">
                    View all <?php echo e($event->registrations->count()); ?> registrations →
                </a>
            <?php endif; ?>
        </div>

        
        <div class="bg-red-50 rounded-xl border border-red-100 p-5">
            <h3 class="font-extrabold text-red-800 text-sm mb-2">
                <i class="fa-solid fa-triangle-exclamation mr-1.5"></i> Danger Zone
            </h3>
            <p class="text-[11px] text-red-700 mb-3 leading-relaxed">
                Deleting this event will also delete all related registrations and uploaded images.
                This action cannot be undone.
            </p>
            <form method="POST" action="<?php echo e(route('admin.events.destroy', $event)); ?>"
                  onsubmit="return confirm('⚠️ Permanently delete this event and all its registrations?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button class="w-full px-4 py-2 rounded-lg text-[12px] font-bold
                               bg-red-500 text-white hover:bg-red-600 transition shadow-sm">
                    <i class="fa-solid fa-trash mr-1"></i> Delete Event
                </button>
            </form>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\run-event\resources\views/admin/events/show.blade.php ENDPATH**/ ?>