

<?php $__env->startSection('title', 'Create Event - Admin'); ?>
<?php $__env->startSection('page-title', 'Create New Event'); ?>
<?php $__env->startSection('page-subtitle', 'Add a new event with categories, awards, and details'); ?>

<?php $__env->startSection('body'); ?>


<div class="flex items-center justify-between gap-2 mb-5">
    <div class="flex items-center gap-2.5">
        <a href="<?php echo e(route('admin.events.index')); ?>"
           class="w-9 h-9 rounded-lg bg-white shadow-sm border border-slate-200
                  flex items-center justify-center text-slate-700
                  hover:text-brandPink hover:border-brandPink transition">
            <i class="fa-solid fa-arrow-left text-xs"></i>
        </a>
        <div>
            <p class="text-[9px] uppercase tracking-[0.12em] text-slate-500 font-bold">Events</p>
            <p class="text-[14px] font-extrabold text-slate-900 leading-tight">Create New Event</p>
        </div>
    </div>

    <a href="<?php echo e(route('admin.events.index')); ?>"
       class="px-3 py-1.5 rounded-lg bg-white border border-slate-300 text-[11px] font-bold
              text-slate-800 hover:border-brandPink hover:text-brandPink transition">
        <i class="fa-solid fa-list"></i> All Events
    </a>
</div>


<div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-5 flex items-start gap-3">
    <i class="fa-solid fa-info-circle text-blue-500 text-lg flex-shrink-0 mt-0.5"></i>
    <div class="text-[12.5px] text-blue-800 leading-relaxed">
        Fields marked with <span class="text-red-500 font-bold">*</span> are required.
        Categories, entitlements, awards, schedules, and rules are pre-filled with defaults — edit or remove them freely.
    </div>
</div>


<form id="eventForm" method="POST" action="<?php echo e(route('admin.events.store')); ?>"
      enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <?php echo $__env->make('admin.events.partials.form', ['event' => $event, 'mode' => 'create'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm border-t border-slate-200
                -mx-4 sm:-mx-6 px-4 sm:px-6 py-4 flex flex-col-reverse sm:flex-row justify-end gap-2 sm:gap-3 shadow-lg">
        <a href="<?php echo e(route('admin.events.index')); ?>"
           class="w-full sm:w-auto px-5 py-2.5 rounded-lg text-sm font-semibold
                  bg-slate-100 text-slate-700 hover:bg-slate-200 transition text-center">
            <i class="fa-solid fa-xmark mr-1"></i> Cancel
        </a>
        <button type="submit"
                class="w-full sm:w-auto px-6 py-2.5 rounded-lg text-sm font-semibold
                       bg-gradient-to-r from-brandPink to-pink-600
                       hover:from-pink-600 hover:to-brandPink
                       text-white transition shadow-md hover:shadow-lg">
            <i class="fa-solid fa-check mr-1"></i> Create Event
        </button>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\run-event\resources\views/admin/events/create.blade.php ENDPATH**/ ?>