<?php

namespace App\Http\Controllers;

use App\Notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class notificationsController extends Controller
{
    // TODO: implement gate ACL function.

    /**
     * notificationsController constructor.
     */
    public function __construct()
    {
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
    public function VerhuurAan($id)
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
    public function VerhuurUit($id)
    {
        $notification = Notifications::findOrNew($id);
        $notification->verhuring = 0;
        $notification->save();

        return Redirect::back();
    }
}
