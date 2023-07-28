<script type="text/javascript">
    
    window.dataView = {
        data : <?php echo isset($data) ? json_encode($data) : '313'; ?>,
        token: '<?php echo e(csrf_token()); ?>',
    };
    
</script>