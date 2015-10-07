<script>
    var pusher = new Pusher('{{ env('PUSHER_KEY') }}');

    //subscribe to our notifications channel
    var notificationsChannel = pusher.subscribe('verhuur_channel');

    // do something with our new information
    notificationsChannel.bind('verhuur_notification', function(notification){
        // assign the notification's message to a <div></div>

        $.bootstrapGrowl(notification.message, {
            ele: 'body', // which element to append to
            type: 'info', // (null, 'info', 'danger', 'success')
            offset: {
                from: 'top',
                amount: 20
            }, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 250, // (integer, or 'auto')
            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
    });
</script>