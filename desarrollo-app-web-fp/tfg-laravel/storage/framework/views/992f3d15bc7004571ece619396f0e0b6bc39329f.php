<script>

    window.dataView = {
        data : <?php echo isset($data) ? json_encode($data) : ''; ?>,
        token: '<?php echo e(csrf_token()); ?>',
    };
    
</script>