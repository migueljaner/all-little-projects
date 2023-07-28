<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

    <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?php echo $__env->yieldContent('title'); ?></title>
        
        <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="language" content="<?php echo e(Session::get('lang')); ?>">
        <base href="<?php echo e(url()->current()); ?>">

        <!--Metas para compartir en Facebook-->
        <!--<meta property="og:title" content="Captive Portal" />
        <meta property="og:description" content="Descripción de la página" />
        <meta property="og:image" content="https://www.anuttarayoga.com/wp-content/uploads/2016/12/free-wifi.png" />      
        <meta property="og:url" content="https://portaldev.p.w34marketing.com/captive-portal/e2b11b93-e26f-4b96-afbd-00e228e8a1c1" />-->

        <link rel="icon" href="/images/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <!-- Scripts -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
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