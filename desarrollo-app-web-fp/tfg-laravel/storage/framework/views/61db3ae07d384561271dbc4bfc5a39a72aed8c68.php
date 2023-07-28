<?php $__env->startSection('title', 'Captive Portal'); ?>

<?php $__env->startSection('head'); ?>

    <script>

        addEventOnLoad(function(){
    
            showModal('modalCongratulations');

            setTimeout(function(){
                window.location = 'http://google.com';
            }, 3000);

        });
    
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.captive-portal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>