<script type="text/javascript">
    
    window.dataView = {
        data : {!! isset($data) ? json_encode($data) : '313' !!},
        token: '{{ csrf_token() }}',
    };
    
</script>