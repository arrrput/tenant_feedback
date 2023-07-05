<script src="{{ asset('assets/js/all.js') }}"></script>
<script>
    var pusher = new Pusher('8c71005b4e26270feccb', {
    encrypted: true
});

var channel = pusher.subscribe('notification-send');
channel.bind('App\\Events\\NotificationEvent', function(data) {
    // this is called when the event notification is received...
});
</script>

<!-- Stack array for including inline js or scripts -->
@stack('plugin-scripts')

@stack('custom-scripts')
