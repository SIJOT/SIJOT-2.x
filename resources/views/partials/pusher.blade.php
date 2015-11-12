<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/3.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.log = function(message) {
            if (window.console && window.console.log) {
                window.console.log(message);
            }
        };

        var pusher = new Pusher('5a7052ed514df272dd0a', {
            encrypted: true
        });
        var channel = pusher.subscribe('channel_verhuur');
        channel.bind('verhuur_notification', function(data) {
            alert(data.message);
        });
    </script>
</head>