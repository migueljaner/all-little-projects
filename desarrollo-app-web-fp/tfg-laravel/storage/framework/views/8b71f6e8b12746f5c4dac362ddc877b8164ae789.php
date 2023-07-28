<?php $__env->startSection('title', 'Captive Portal'); ?>

<?php $__env->startSection('head'); ?>

    <script>

        addEventOnLoad(function(){

            var params;
    
            showModal('modalValidatingData');

            params = {
                <?php $__currentLoopData = array_get($data, "parameters", []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo "'".$key."': '".$value."'"; ?>,
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            };

            formLogin = document.createElement('form');
            formLogin.action = params['login'];
            formLogin.method = 'post';
            formLogin.style.display = 'none';

            Object.keys(params).forEach(function(key){
                var inputFormLogin = document.createElement('input');
                inputFormLogin.type = 'hidden';
                inputFormLogin.name = key;
                inputFormLogin.value = params[key];
                formLogin.appendChild(inputFormLogin);
            });

            document.body.appendChild(formLogin);

            formLogin.submit();

        });
    
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.captive-portal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>