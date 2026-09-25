<?php $__env->startSection('title', 'Registration #' . $registration->id); ?>
<?php $__env->startSection('page-title', 'Registration Details'); ?>
<?php $__env->startSection('page-subtitle', 'Full information of registration #' . $registration->id); ?>

<?php $__env->startSection('body'); ?>

<?php
    $statusStyles = [
        'pending'   => ['badge' => 'bg-amber-50 text-amber-800 ring-amber-300',    'dot' => 'bg-amber-600',   'icon' => 'fa-clock',         'label' => 'Pending Review'],
        'approved'  => ['badge' => 'bg-emerald-50 text-emerald-800 ring-emerald-300','dot' => 'bg-emerald-600','icon' => 'fa-circle-check',  'label' => 'Approved'],
        'rejected'  => ['badge' => 'bg-rose-50 text-rose-800 ring-rose-300',       'dot' => 'bg-rose-600',    'icon' => 'fa-circle-xmark',  'label' => 'Rejected'],
        'cancelled' => ['badge' => 'bg-slate-100 text-slate-800 ring-slate-300',   'dot' => 'bg-slate-600',   'icon' => 'fa-ban',           'label' => 'Cancelled'],
    ];
    $s = $statusStyles[$registration->status] ?? $statusStyles['pending'];

    $avatarPalette = [
        'from-pink-600 to-rose-700',
        'from-violet-600 to-indigo-700',
        'from-sky-600 to-cyan-700',
        'from-teal-600 to-emerald-700',
        'from-orange-600 to-amber-700',
        'from-fuchsia-600 to-pink-700',
    ];
    $colorIdx = crc32($registration->full_name) % count($avatarPalette);
    $avatarGradient = $avatarPalette[$colorIdx];
    $initials = strtoupper(substr($registration->first_name, 0, 1) . substr($registration->last_name, 0, 1));
?>


<div class="flex flex-wrap items-center justify-between gap-2 mb-3">
    <div class="flex items-center gap-2.5">
        <a href="<?php echo e(route('admin.registrations.index')); ?>"
           class="w-8 h-8 rounded-lg bg-white shadow-sm border border-slate-200 flex items-center justify-center text-slate-700 hover:text-brandPink hover:border-brandPink transition">
            <i class="fa-solid fa-arrow-left text-xs"></i>
        </a>
        <div>
            <p class="text-[9px] uppercase tracking-[0.12em] text-slate-500 font-bold">Registrations</p>
            <p class="text-[13.5px] font-extrabold text-slate-900 leading-tight">#<?php echo e($registration->id); ?> · <?php echo e($registration->full_name); ?></p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <button onclick="window.print()"
                class="px-3 py-1.5 rounded-lg bg-white border border-slate-300 text-[11px] font-bold text-slate-800 hover:border-brandPink hover:text-brandPink transition">
            <i class="fa-solid fa-print"></i> Print
        </button>
        <button onclick='openStatusModal()'
                class="px-3 py-1.5 rounded-lg bg-brandPink text-white text-[11px] font-bold hover:bg-pink-700 transition shadow-sm">
            <i class="fa-solid fa-pen-to-square"></i> Update Status
        </button>
    </div>
</div>


<div class="bg-gradient-to-r from-slate-900 via-slate-900 to-brandPink rounded-xl shadow-md px-4 py-3 mb-3 text-white relative overflow-hidden">
    <div class="absolute -top-8 -right-8 w-28 h-28 rounded-full bg-white/5"></div>
    <div class="absolute -bottom-12 -right-2 w-36 h-36 rounded-full bg-white/5"></div>

    <div class="relative flex flex-wrap items-center gap-3">
        
        <div class="relative shrink-0">
            <?php if($registration->profile_image): ?>
                <img src="<?php echo e(asset('storage/' . $registration->profile_image)); ?>"
                    alt="<?php echo e($registration->full_name); ?>"
                    class="w-14 h-14 rounded-full object-cover shadow-xl ring-2 ring-white/25">
            <?php else: ?>
                <div class="w-14 h-14 rounded-full bg-gradient-to-br <?php echo e($avatarGradient); ?> flex items-center justify-center text-xl font-extrabold shadow-xl ring-2 ring-white/25">
                    <?php echo e($initials); ?>

                </div>
            <?php endif; ?>
            <span class="absolute -bottom-0.5 -right-0.5 w-5 h-5 rounded-full bg-white flex items-center justify-center text-[10px] shadow
                        <?php if($registration->status === 'approved'): ?> text-emerald-700
                        <?php elseif($registration->status === 'rejected'): ?> text-rose-700
                        <?php elseif($registration->status === 'cancelled'): ?> text-slate-700
                        <?php else: ?> text-amber-700 <?php endif; ?>">
                <i class="fa-solid <?php echo e($s['icon']); ?>"></i>
            </span>
        </div>

        
        <div class="flex-1 min-w-[180px]">
            <h2 class="text-[15.5px] font-extrabold leading-tight tracking-tight"><?php echo e($registration->full_name); ?></h2>
            <p class="text-[11px] text-slate-200 mt-0.5">
                <i class="fa-solid fa-phone mr-1 text-[9px] text-slate-300"></i> <?php echo e($registration->phone); ?>

                <?php if($registration->email): ?>
                    <span class="mx-1.5 text-slate-400">•</span>
                    <i class="fa-regular fa-envelope mr-1 text-[9px] text-slate-300"></i> <?php echo e($registration->email); ?>

                <?php endif; ?>
            </p>
            <div class="flex flex-wrap items-center gap-1.5 mt-1.5">
                <span class="px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-white/15 backdrop-blur ring-1 ring-white/25">
                    <i class="fa-solid fa-person-running mr-1"></i><?php echo e($registration->category); ?>

                </span>
                <span class="px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-white/15 backdrop-blur ring-1 ring-white/25">
                    <i class="fa-solid fa-shirt mr-1"></i><?php echo e($registration->tshirt_size); ?>

                </span>
                <?php if($registration->bib_number): ?>
                    <span class="px-2 py-0.5 rounded-full text-[9.5px] font-extrabold bg-emerald-500 ring-1 ring-emerald-300 shadow-sm">
                        <i class="fa-solid fa-hashtag mr-0.5"></i>BIB <?php echo e($registration->bib_number); ?>

                    </span>
                <?php endif; ?>
                <?php if($registration->blood_group): ?>
                    <span class="px-2 py-0.5 rounded-full text-[9.5px] font-extrabold bg-rose-600 ring-1 ring-rose-300/70 shadow-sm">
                        <i class="fa-solid fa-droplet mr-0.5"></i><?php echo e($registration->blood_group); ?>

                    </span>
                <?php endif; ?>
                <span class="px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-white/15 backdrop-blur ring-1 ring-white/25">
                    <i class="fa-solid fa-flag-checkered mr-1"></i><?php echo e($registration->event?->title); ?>

                </span>
            </div>
        </div>

        
        <div class="text-right shrink-0">
            <p class="text-[9px] uppercase tracking-[0.12em] text-slate-300 mb-0.5 font-bold">Status</p>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-extrabold text-[10.5px] bg-white text-slate-900 shadow">
                <span class="w-1.5 h-1.5 rounded-full <?php echo e($s['dot']); ?> animate-pulse"></span>
                <?php echo e($s['label']); ?>

            </span>
        </div>
    </div>
</div>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-3">

    
    <div class="lg:col-span-2 space-y-3">

        
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <div class="flex items-center gap-2 mb-2.5 pb-2.5 border-b border-slate-200">
                <div class="w-7 h-7 rounded-lg bg-pink-100 text-pink-700 flex items-center justify-center">
                    <i class="fa-solid fa-user text-xs"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-[13px] leading-tight tracking-tight">Personal Information</h3>
                    <p class="text-[9px] text-slate-500 font-medium">Basic details of the runner</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-4 gap-y-2.5 text-[12.5px]">
                <div class="col-span-2 sm:col-span-1">
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Full Name</p>
                    <p class="font-bold text-slate-900 leading-tight"><?php echo e($registration->full_name); ?></p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Phone</p>
                    <p class="font-bold text-slate-900 leading-tight"><?php echo e($registration->phone); ?></p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">WhatsApp</p>
                    <?php if($registration->whatsapp_number): ?>
                        <a href="https://wa.me/<?php echo e(preg_replace('/[^\d]/', '', $registration->whatsapp_number)); ?>"
                           target="_blank"
                           class="font-bold text-green-700 hover:text-green-800 leading-tight">
                            <i class="fa-brands fa-whatsapp text-[10px]"></i> <?php echo e($registration->whatsapp_number); ?>

                        </a>
                    <?php else: ?>
                        <p class="font-bold text-slate-400 leading-tight">—</p>
                    <?php endif; ?>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Email</p>
                    <p class="font-bold text-slate-900 leading-tight truncate"><?php echo e($registration->email ?? '—'); ?></p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Gender</p>
                    <p class="font-bold text-slate-900 leading-tight"><?php echo e($registration->gender); ?></p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Blood Group</p>
                    <?php if($registration->blood_group): ?>
                        <span class="inline-block px-2 py-0.5 rounded-md text-[11px] font-extrabold bg-rose-100 text-rose-800 leading-tight ring-1 ring-rose-200">
                            <i class="fa-solid fa-droplet text-[9px]"></i> <?php echo e($registration->blood_group); ?>

                        </span>
                    <?php else: ?>
                        <p class="font-bold text-slate-400 leading-tight">—</p>
                    <?php endif; ?>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Date of Birth</p>
                    <p class="font-bold text-slate-900 leading-tight"><?php echo e($registration->dob?->format('d M Y') ?? '—'); ?></p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">NID / Passport</p>
                    <p class="font-bold text-slate-900 leading-tight"><?php echo e($registration->nid ?? '—'); ?></p>
                </div>
                <div class="col-span-2 sm:col-span-3">
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Address</p>
                    <p class="font-bold text-slate-900 leading-tight"><?php echo e($registration->address ?? '—'); ?></p>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <div class="flex items-center gap-2 mb-2.5 pb-2.5 border-b border-slate-200">
                <div class="w-7 h-7 rounded-lg bg-teal-100 text-teal-800 flex items-center justify-center">
                    <i class="fa-solid fa-shirt text-xs"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-[13px] leading-tight tracking-tight">Event & Payment</h3>
                    <p class="text-[9px] text-slate-500 font-medium">Event category and payment info</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-4 gap-y-2.5 text-[12.5px]">
                <div class="col-span-2 sm:col-span-3">
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Event</p>
                    <p class="font-bold text-slate-900 leading-tight"><?php echo e($registration->event?->title ?? '—'); ?></p>
                </div>

                
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">BIB Number</p>
                    <?php if($registration->bib_number): ?>
                        <span class="inline-block px-2 py-0.5 rounded-md text-[11px] font-extrabold bg-emerald-100 text-emerald-800 leading-tight ring-1 ring-emerald-200">
                            <i class="fa-solid fa-hashtag text-[9px]"></i> <?php echo e($registration->bib_number); ?>

                        </span>
                    <?php else: ?>
                        <p class="font-bold text-slate-400 leading-tight">Not assigned</p>
                    <?php endif; ?>
                </div>

                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Category</p>
                    <span class="inline-block px-2 py-0.5 rounded-full text-[10.5px] font-extrabold bg-blue-100 text-blue-800 ring-1 ring-blue-200">
                        <?php echo e($registration->category); ?>

                    </span>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">T-Shirt Size</p>
                    <span class="inline-block px-2 py-0.5 rounded-full text-[10.5px] font-extrabold bg-teal-100 text-teal-800 ring-1 ring-teal-200">
                        <?php echo e($registration->tshirt_size); ?>

                    </span>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Amount</p>
                    <p class="font-extrabold text-slate-900 text-[14px] leading-tight">BDT <?php echo e(number_format($registration->amount)); ?></p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Payment Method</p>
                    <p class="font-bold text-slate-900 leading-tight"><?php echo e($registration->payment_method); ?></p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Transaction ID</p>
                    <p class="font-mono text-[11.5px] font-bold text-slate-900 bg-slate-100 rounded px-1.5 py-0.5 inline-block ring-1 ring-slate-200">
                        <?php echo e($registration->trx_id ?? '—'); ?>

                    </p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Sender Phone (Last 3)</p>
                    <p class="font-mono text-[11.5px] font-bold text-slate-900 bg-slate-100 rounded px-1.5 py-0.5 inline-block tracking-widest ring-1 ring-slate-200">
                        <?php echo e($registration->sender_phone_last3 ?? '—'); ?>

                    </p>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <div class="flex items-center gap-2 mb-2.5 pb-2.5 border-b border-slate-200">
                <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-800 flex items-center justify-center">
                    <i class="fa-solid fa-phone text-xs"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-[13px] leading-tight tracking-tight">Emergency Contact</h3>
                    <p class="text-[9px] text-slate-500 font-medium">Person to contact in case of emergency</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-2.5 text-[12.5px]">
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Name</p>
                    <p class="font-bold text-slate-900 leading-tight"><?php echo e($registration->emergency_name); ?></p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Phone</p>
                    <p class="font-bold text-slate-900 leading-tight"><?php echo e($registration->emergency_phone); ?></p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="space-y-3">

        
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <div class="flex items-center justify-between mb-2.5">
                <h3 class="font-extrabold text-slate-900 text-[13px] tracking-tight">
                    <i class="fa-solid fa-flag text-brandPink mr-1.5"></i> Status
                </h3>
                <button onclick='openStatusModal()'
                        class="text-[10px] font-bold text-brandPink hover:underline">
                    <i class="fa-solid fa-pen text-[9px]"></i> Change
                </button>
            </div>

            <div class="rounded-lg p-2.5 text-center ring-2 <?php echo e($s['badge']); ?>">
                <i class="fa-solid <?php echo e($s['icon']); ?> text-xl mb-0.5"></i>
                <p class="font-extrabold text-[12px]"><?php echo e($s['label']); ?></p>
                <p class="text-[9px] opacity-80 mt-0.5 font-semibold">Updated <?php echo e($registration->updated_at->diffForHumans()); ?></p>
            </div>

            <?php if($registration->admin_note): ?>
                <div class="mt-2.5 p-2 rounded-lg bg-slate-100 border-l-2 border-brandPink">
                    <p class="text-[9px] font-extrabold uppercase tracking-[0.1em] text-slate-700 mb-0.5">
                        <i class="fa-solid fa-note-sticky"></i> Admin Note
                    </p>
                    <p class="text-[11px] text-slate-800 leading-relaxed font-medium"><?php echo e($registration->admin_note); ?></p>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <h3 class="font-extrabold text-slate-900 text-[13px] mb-2.5 tracking-tight">
                <i class="fa-solid fa-clock-rotate-left text-violet-600 mr-1.5"></i> Timeline
            </h3>

            <div class="relative pl-4">
                <div class="absolute left-1 top-2 bottom-2 w-0.5 bg-slate-300"></div>

                <div class="relative mb-3">
                    <div class="absolute -left-3 top-1 w-2 h-2 rounded-full bg-brandPink ring-2 ring-pink-200"></div>
                    <p class="text-[11.5px] font-extrabold text-slate-900 leading-tight">Registration Created</p>
                    <p class="text-[9.5px] text-slate-600 mt-0.5 font-semibold"><?php echo e($registration->created_at->format('d M Y, h:i A')); ?></p>
                </div>

                <?php if($registration->updated_at->ne($registration->created_at)): ?>
                    <div class="relative">
                        <div class="absolute -left-3 top-1 w-2 h-2 rounded-full <?php echo e($s['dot']); ?> ring-2 ring-slate-200"></div>
                        <p class="text-[11.5px] font-extrabold text-slate-900 leading-tight">Status Updated</p>
                        <p class="text-[9.5px] text-slate-600 mt-0.5 font-semibold"><?php echo e($registration->updated_at->format('d M Y, h:i A')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <h3 class="font-extrabold text-slate-900 text-[13px] mb-2.5 tracking-tight">
                <i class="fa-solid fa-bolt text-brandOrange mr-1.5"></i> Quick Actions
            </h3>

            <div class="space-y-1.5">
                <a href="tel:<?php echo e($registration->phone); ?>"
                   class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-brandPink hover:text-white transition text-[11.5px] font-bold text-slate-800">
                    <i class="fa-solid fa-phone w-3.5 text-[11px]"></i> Call Runner
                </a>

                <?php if($registration->whatsapp_number): ?>
                    <a href="https://wa.me/<?php echo e(preg_replace('/[^\d]/', '', $registration->whatsapp_number)); ?>"
                       target="_blank"
                       class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg bg-green-100 hover:bg-green-700 hover:text-white transition text-[11.5px] font-bold text-green-800">
                        <i class="fa-brands fa-whatsapp w-3.5 text-[11px]"></i> WhatsApp
                    </a>
                <?php endif; ?>

                <?php if($registration->email): ?>
                    <a href="mailto:<?php echo e($registration->email); ?>"
                       class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-brandPink hover:text-white transition text-[11.5px] font-bold text-slate-800">
                        <i class="fa-regular fa-envelope w-3.5 text-[11px]"></i> Send Email
                    </a>
                <?php endif; ?>

                <form action="<?php echo e(route('admin.registrations.destroy', $registration)); ?>" method="POST"
                      onsubmit="return confirm('Delete this registration permanently?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                            class="w-full flex items-center gap-2 px-2.5 py-1.5 rounded-lg bg-rose-100 hover:bg-rose-700 hover:text-white transition text-[11.5px] font-bold text-rose-800">
                        <i class="fa-solid fa-trash w-3.5 text-[11px]"></i> Delete Registration
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="statusModal" class="fixed inset-0 bg-black/60 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm">
        <div class="px-4 py-3 border-b border-slate-200 flex items-center justify-between">
            <h3 class="text-sm font-extrabold text-slate-900">Update Registration Status</h3>
            <button onclick="closeStatusModal()" class="text-slate-500 hover:text-slate-900 text-xl leading-none">&times;</button>
        </div>

        <form id="statusForm" method="POST" action="<?php echo e(route('admin.registrations.updateStatus', $registration)); ?>" class="p-4 space-y-3">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="bg-slate-100 rounded-lg p-2.5 text-xs ring-1 ring-slate-200">
                <p class="font-extrabold text-slate-900"><?php echo e($registration->full_name); ?></p>
                <p class="text-slate-600 mt-0.5 font-semibold"><?php echo e($registration->event?->title); ?></p>
                <p class="text-slate-600 mt-0.5 font-semibold">Amount: <span class="font-extrabold text-slate-900">BDT <?php echo e(number_format($registration->amount)); ?></span></p>
            </div>

            <div>
                <label class="block text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-700 mb-1.5">
                    Status <span class="text-rose-600">*</span>
                </label>
                <select name="status" id="sm_status" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg text-[13px] font-bold
                               text-slate-900 bg-white focus:ring-2 focus:ring-brandPink focus:outline-none cursor-pointer">
                    <option value="pending"   <?php if($registration->status === 'pending'): echo 'selected'; endif; ?>>Pending</option>
                    <option value="approved"  <?php if($registration->status === 'approved'): echo 'selected'; endif; ?>>Approved</option>
                    <option value="rejected"  <?php if($registration->status === 'rejected'): echo 'selected'; endif; ?>>Rejected</option>
                    <option value="cancelled" <?php if($registration->status === 'cancelled'): echo 'selected'; endif; ?>>Cancelled</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-700 mb-1.5">
                    Admin Note <span class="text-slate-500 font-medium normal-case">(optional)</span>
                </label>
                <textarea name="admin_note" rows="2" placeholder="Reason for approval/rejection..."
                          class="w-full px-3 py-2 border border-slate-300 rounded-lg text-[12px] focus:ring-2 focus:ring-brandPink focus:outline-none resize-none"><?php echo e($registration->admin_note); ?></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-200">
                <button type="button" onclick="closeStatusModal()"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-200 text-slate-800 hover:bg-slate-300">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-1.5 rounded-lg text-xs font-bold bg-brandPink text-white hover:bg-pink-700">
                    <i class="fa-solid fa-check mr-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function openStatusModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeStatusModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    document.getElementById('statusModal')?.addEventListener('click', e => {
        if (e.target === e.currentTarget) closeStatusModal();
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\run-event\resources\views/admin/registrations/show.blade.php ENDPATH**/ ?>