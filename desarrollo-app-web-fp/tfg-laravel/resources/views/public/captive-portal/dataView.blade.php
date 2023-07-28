<script type="text/javascript">
    window.dataView.routes = {
        'register_clientele' : '{{ route('register.clientele') }}',
        'captive_portal': '{{ route('index') }}'
    };
    window.dataView.feedbacks = @lang('captive-portal.feedbacks');
    window.dataView.form = {
        'validations' : @lang('captive-portal.form.validations'),
    };
    window.dataView.calendar = @lang('calendar-semantic-ui.calendar');
</script>