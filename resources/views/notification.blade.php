<!DOCTYPE html>
<head>
    <title>Laravel Real Time Notification Tutorial With Example</title>
    <h1>Laravel Real Time Notification Tutorial With Example</h1>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('b31cf5016a092eb24c0e', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('notify-channel');
        channel.bind('notify-test', function(data) {
            alert(data.message);
        });
    </script>
</head>
