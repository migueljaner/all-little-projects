<script type="text/javascript">

    window.dataView.routes = {
        'register_clientele' : '<?php echo e(route('register_clientele')); ?>',
        'captive_portal': '<?php echo e(route('captive_portal')); ?>'
    };
    window.dataView.feedbacks = <?php echo app('translator')->getFromJson('captive-portal.feedbacks'); ?>;
    window.dataView.form = {
        'validations' : <?php echo app('translator')->getFromJson('captive-portal.form.validations'); ?>,
    };
    window.dataView.calendar = <?php echo app('translator')->getFromJson('calendar-semantic-ui.calendar'); ?>;

    window.dataForm = {
        'name': 'pepe',
        'surname' : 'jones',
        'email': 'pepe@gmail.com',
        'gender' : '1',
        'birthdate' : '1999-3-25',
        'acceptConditions' : 'true',
        'acceptConditionsMinor' : 'false'
    };
    
</script>