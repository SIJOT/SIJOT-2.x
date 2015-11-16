<?php

namespace App\Http\Controllers;

use App\Notifications;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class notificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function VerhuurAan($id)
    {
        $notification = Notifications::findOrNew($id);
        $notification->verhuring = 1;
        $notification->save();

        return Redirect::back();
    }

    public function VerhuurUit($id)
    {
        $notification = Notifications::findOrNew($id);
        $notification->verhuring = 0;
        $notification->save();

        return Redirect::back();
    }
}