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
    }

    /**
     * [Method] Enable rental email notifications.
     *
     * @param $id
     * @return mixed
     */
    public function VerhuurAan($id)
    {
        if (Gate::denies('verhuur-beheer', Auth::user()->permission->verhuurbeheer)) {
            return Redirect::back();
        }

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
     */
    public function VerhuurUit($id)
    {
        if (Gate::denies('verhuur-beheer', Auth::user()->permission->verhuurbeheer)) {
            return Redirect::back();
        }
        $notification = Notifications::findOrNew($id);
        $notification->verhuring = 0;
        $notification->save();

        return Redirect::back();
    }
}
