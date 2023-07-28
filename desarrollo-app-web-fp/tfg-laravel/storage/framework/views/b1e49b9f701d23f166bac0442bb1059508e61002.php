<script type="text/javascript">
    window.dataView.routes = {
        'register_clientele' : '<?php echo e(route('register.clientele')); ?>',
        'captive_portal': '<?php echo e(route('index')); ?>'
    };
    window.dataView.feedbacks = <?php echo app('translator')->getFromJson('captive-portal.feedbacks'); ?>;
    window.dataView.form = {
        'validations' : <?php echo app('translator')->getFromJson('captive-portal.form.validations'); ?>,
    };
    window.dataView.calendar = <?php echo app('translator')->getFromJson('calendar-semantic-ui.calendar'); ?>;
</script>