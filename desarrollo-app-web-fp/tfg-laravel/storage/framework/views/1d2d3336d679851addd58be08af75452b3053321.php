

<?php $__env->startSection('content'); ?>
<div class="text-center">
    <div class="top_page my-5">
        <h1 class="text-center text-uppercase text-primary">Perms Control</h1>
        <hr class="star-dark mb-5 text-primary">
    </div>
    <h4 class="perms text-left text-secondary mb-3">Users</h4>
    <select class="browser-default custom-select custom-select-lg mb-3 mx-5" name="user" id="selectUser" aria-placeholder="Select User">
            <option value="" disabled selected> Select User...</option>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->id); ?>"><?php echo e($user->nombre); ?><?php echo e($user->apellidos); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div id="modalDelete" class="modal">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header text-center pb-0">
                <h4 class="modal-title text-danger px-4">Are you sure you want to delete it?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body text-center">
                <div class="icon-box">
                    <img src="https://image.flaticon.com/icons/svg/53/53639.svg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger ml-4">Delete</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('js/perms.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>