<script src="{{ asset('assets/js/all.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/promise-polyfill.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script>
    var pusher = new Pusher('aed65ef4746550ecbccc', {
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
