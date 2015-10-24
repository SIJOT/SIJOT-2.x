<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;

class UserManagement extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');

        // TODO: Need be created.
        // $this->middleware('admin');
    }

    /**
     * get the index view for the usermanagement console.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $data['title']  = 'Gebruikers beheer';
        $data['active'] = '';

        // Get the MySQL Data group by group.
        $data['gebruikers']     = User::all();
        $data['leiding']        = User::where('role', '=', 1)->get();
        $data['administrators'] = User::where('role', '=', 2)->get();
        $data['ouders']         = User::where('role', '=', 0)->get();


        return View('back-end.userManagement', $data);
    }
}
