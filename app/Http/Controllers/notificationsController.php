<?php

namespace App\Http\Controllers;

use App\Notifications;
use Illuminate\Support\Facades\Redirect;

class NotificationsController extends Controller
{
    /**
     * notificationsController constructor.
     */
    public function __construct()
    {
        // Auth          = Check to see if the user is authencation.
        // Verhuurbeheer = Check if he get the right permission.
        $this->middleware('auth');
        $this->middleware('verhuurbeheer', ['only' => ['VerhuurAan', 'VerhuurUit']]);
    }

    /**
     * [Method] Enable rental email notifications.
     *
     * @param $id
     * @return mixed
     *
     * @Get("/notification/aan/{id}", as="rental.notificationEnable")
     */
    public function verhuurAan($id)
    {
        $notification = Notifications::findOrNew($id);
        $notification->verhuring = 1;
        $notification->save();

        return Redirect::back();
    }

    /**
     * [Method] Disable rental notifications.
     *
     * @param $id
     * @return mixed
     *
     * @Get("/notification/uit/{id}", as="rental.notificationDisable")
     */
    public function verhuurUit($id)
    {
        $notification = Notifications::findOrNew($id);
        $notification->verhuring = 0;
        $notification->save();

        return Redirect::back();
    }
}
