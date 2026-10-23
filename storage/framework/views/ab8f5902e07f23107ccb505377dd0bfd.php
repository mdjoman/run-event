<?php $__env->startSection('title', 'SMS Log #' . $log->id . ' - Admin'); ?>
<?php $__env->startSection('page-title', 'SMS Log #' . $log->id); ?>
<?php $__env->startSection('page-subtitle', 'Detailed view of sent SMS'); ?>

<?php $__env->startSection('body'); ?>

<div class="mb-5">
    <a href="<?php echo e(route('admin.sms.logs')); ?>"
       class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm font-semibold text-slate-700 transition">
        <i class="fa-solid fa-arrow-left"></i> Back to Logs
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    
    <div class="lg:col-span-1 bg-white rounded-xl shadow-sm p-5 card-glossy">
        <h3 class="text-sm font-bold glossy-text mb-4 flex items-center gap-2">
            <i class="fa-solid fa-circle-info text-brandPink"></i> SMS Details
        </h3>
        <dl class="space-y-3 text-sm">
            <div class="flex justify-between gap-2">
                <dt class="text-slate-500">Status</dt>
                <dd>
                    <?php if($log->status === 'sent'): ?>
                        <span class="badge bg-green-100 text-green-700">Sent</span>
                    <?php else: ?>
                        <span class="badge bg-red-100 text-red-700">Failed</span>
                    <?php endif; ?>
                </dd>
            </div>
            <div class="flex justify-between gap-2">
                <dt class="text-slate-500">Recipient</dt>
                <dd class="font-semibold text-slate-800 text-right"><?php echo e($log->recipient_name ?? '—'); ?></dd>
            </div>
            <div class="flex justify-between gap-2">
                <dt class="text-slate-500">Phone</dt>
                <dd class="font-mono text-slate-800"><?php echo e($log->to_phone); ?></dd>
            </div>
            <div class="flex justify-between gap-2">
                <dt class="text-slate-500">Event</dt>
                <dd class="text-slate-800 text-right"><?php echo e($log->event?->title ?? '—'); ?></dd>
            </div>
            <div class="flex justify-between gap-2">
                <dt class="text-slate-500">Length</dt>
                <dd class="text-slate-800"><?php echo e($log->message_length); ?> chars</dd>
            </div>
            <div class="flex justify-between gap-2">
                <dt class="text-slate-500">Sent by</dt>
                <dd class="text-slate-800"><?php echo e($log->sender?->name ?? 'System'); ?></dd>
            </div>
            <div class="flex justify-between gap-2">
                <dt class="text-slate-500">Sent at</dt>
                <dd class="text-slate-800"><?php echo e($log->created_at->format('d M Y H:i:s')); ?></dd>
            </div>
            <?php if($log->batch_id): ?>
                <div class="flex justify-between gap-2">
                    <dt class="text-slate-500">Batch ID</dt>
                    <dd class="text-[10px] font-mono text-slate-600 break-all text-right"><?php echo e($log->batch_id); ?></dd>
                </div>
            <?php endif; ?>
        </dl>

        <?php if($log->error): ?>
            <div class="mt-4 p-3 bg-red-50 border border-red-100 rounded-lg text-xs text-red-700">
                <strong><i class="fa-solid fa-triangle-exclamation"></i> Error:</strong>
                <?php echo e($log->error); ?>

            </div>
        <?php endif; ?>
    </div>

    
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-5 card-glossy">
        <h3 class="text-sm font-bold glossy-text mb-4 flex items-center gap-2">
            <i class="fa-solid fa-comment-dots text-brandPink"></i> Message
        </h3>
        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
            <pre class="whitespace-pre-wrap text-sm text-slate-800 font-sans leading-relaxed"><?php echo e($log->message); ?></pre>
        </div>

        <?php if($log->registration): ?>
            <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-lg text-xs text-blue-700">
                <i class="fa-solid fa-user mr-1"></i>
                Linked to registration
                <a href="<?php echo e(route('admin.registrations.show', $log->registration)); ?>"
                   class="font-bold underline hover:text-blue-900">
                    #<?php echo e($log->registration_id); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\run-event\resources\views/admin/sms/log-show.blade.php ENDPATH**/ ?>