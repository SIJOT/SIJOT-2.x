<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class UserManagement extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');

        // TODO: Need be created.
        // TODO: set middleware
        // $this->middleware('admin');
        $this->middleware('auth');

        if(Auth::check()) {
            $this->permission = Permission::where('user_id', Auth::user()->id)
                ->get();
        } else {
            $this->permission = 0;
        }

    }

    /**
     * get the index view for the usermanagement console.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        if(Gate::denies('leden-beheer', $this->permission)) {
            return Redirect::back();
        }

        $data['title']  = 'Gebruikers beheer';
        $data['active'] = 0;

        // Get the MySQL Data group by group.
        $data['gebruikers'] = User::paginate(10);
        // {{ gebruikers->render() }} to display the pagination.

        return View('back-end.userManagement', $data);
    }

    /**
     * Get the profile for the user.
     *
     * @param $id, integer, the user profile id.
     * @return \Illuminate\View\View
     */
    public function UserProfile($id)
    {
        if(Gate::denies('leden-beheer', $this->permission)) {
            return Redirect::back();
        }

        $data['title'] = 'Gebruikers profiel';
        $data['active'] = 0;
        $data['permission'] = [];

        $user = User::find($id)->get();

        if (count($user) === 1) {
            foreach($user as $info) {
                $data['username'] = $info->name;
                $data['email']    = $info->email;
            }
        }

        return View('back-end.profile', $data);
    }
}
