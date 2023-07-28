<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

    <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?php echo $__env->yieldContent('title'); ?></title>
        
        <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <meta name="mobile-web-app-capable" content="yes">
        <base href="<?php echo e(url()->current()); ?>">

        <link rel="icon" href="/images/favicon.ico" type="image/x-icon"/>

        <!-- Scripts -->

            <script src="<?php echo e(asset('components/jquery.min.js')); ?>" type="text/javascript"></script>
            <script src="<?php echo e(asset('components/semantic-ui/semantic.min.js')); ?>" type="text/javascript"></script>
            <script src="<?php echo e(asset('semantic-ui-calendar/calendar.min.js')); ?>" type="text/javascript"></script>
            <script src="<?php echo e(asset('js/ajax.js')); ?>" type="text/javascript"></script>
            <script src="<?php echo e(asset('js/modals.js')); ?>" type="text/javascript"></script>
            <script src="<?php echo e(asset('js/public.js')); ?>" type="text/javascript"></script>

            <?php echo $__env->make('layouts.subLayouts.public.dataView', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('public.captive-portal.dataView', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!--^^ Scripts ^^-->

        <!-- Styles -->

            <!-- <link href="<?php echo e(asset('css/public.css')); ?>" rel="stylesheet" type="text/css"> -->
            <link href="<?php echo e(asset('components/semantic-ui/semantic.min.css')); ?>" rel="stylesheet" type="text/css">
            <link href="<?php echo e(asset('semantic-ui-calendar/calendar.min.css')); ?>" rel="stylesheet" type="text/css">
            <link href="<?php echo e(asset('css/captive-portal.css')); ?>" rel="stylesheet" type="text/css">

        <!--^^ Styles ^^-->

        <?php echo $__env->yieldContent('head'); ?>

    </head>
    <body>

        <div id="structure">

            <div id="content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <?php echo $__env->make('public.captive-portal.modals', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>

    </body>

</html>