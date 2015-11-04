<?php

namespace App\Http\Controllers;

use Pusher;
use App\User;
use App\Permission;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Registervalidation;

class AuthorizationController extends Controller
{
    public $pusher;

    public function __construct()
    {
        // Set Real Time Notification. (Pusher)
        $this->pusher = new Pusher(
            env('PUSHER_KEY'),
            env('PUSHER_SECRET'),
            env('PUSHER_ID')
        );
    }

    /**
     * [VIEW] The logid page
     */
    public function viewLogin()
    {
        return View('auth.login');
    }

    /**
     * Verify that a user can login into the system.
     *
     * TODO: Pusher integration. For welcome message.
     */
    public function verifyLogin()
    {
        $restrictions['email']    = Input::get('email');
        $restrictions['password'] = Input::get('password');

        if (Auth::attempt($restrictions)) {
            // Get the role from the user.
            $userRole = Auth::user()->role;

            // Set the permission table to a session.
            $permissionsQuery = Permission::where('user_id', Auth::user()->id)->get();

            Session::push('permission', $permissionsQuery);

            if ($userRole === 2) {
                // Administrator
                $redirectUrl = URL::to('/backend/verhuur');
            } elseif($userRole === 0) {
                // Ouders
                $redirectUrl = URL::to('/backend/ouders');
            } elseif($userRole === 1) {
                // Leiding
                $redirectUrl = URL::to('/backend/takken/update');
            } else {
                // TODO: make route for login view and define it in a variable.
                $redirectUrl = '';
            }

            // Logging instance
            $logging = Lang::get('logging.loggedIn', [
                'user' => Auth::user()->name
            ]);

            Log::info($logging);

            /** @var string, $redirectUrl */
            return Redirect::to($redirectUrl);
        } else {
            return Redirect::to('/login')->withInput();
        }
    }

    /**
     * Try to register the user in the system.
     * Affects user and permission table.
     *
     * @param Registervalidation $input
     */
    public function Register(Registervalidation $input)
    {
        // User insert
        $users           = new User();
        $users->name     = $input->name;
        $users->email    = $input->email;
        $users->password = Hash::make($input->password);

        // ->save(); = save the record.
        $registration = $users->save();
        // Last inserted id: $registration->id;

        // Permissions insert
        $permissions = new Permission();
        $permissions->user_id = $registration->id;

        // ->save(); = save the record.
        $permissions->save();
        // Last inserted id: $permissions->id;

        // Save the values.
        if ($registration && $permissions->save()) {
            $user = User::find($registration->id);

            Mail::send('emails.registration', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email)->subject(Lang::get('emails.subjectRegistration'));
            });

            $loggingData['name']  = $users->name;
            $loggingData['users'] = User::user()->name;

            Log::info(Lang::get('logging.registrationSuccess', $loggingData));

        } else {
            $logging =  Lang::get('logging.registrationError');
            Log::error($logging);
        }

        return Redirect::back();
    }

    /**
     * Throw the user out of the backend.
     *
     * TODO: Needs php unit test case.
     * TODO: Need URL route in routes.php
     */
    public function getLogout() {

        $logging = Lang::get('logging.loggedOut', ['user' => Auth::user()->name]);
        Log::info($logging);

        Auth::logout();

        return Redirect::to('/');
    }

    /**
     * Disable login.
     *
     * @param $id, integer, User id.
     */
    public function blockUser($id)
    {
        $user           = User::find($id);
        $user->blocked  = 1;

        if ($user->save()) {
            $logging = Lang::get('logging.', [
                'name' => Auth::user()->name
            ]);

            Log::warning($logging);
        } else {
            $logging = Lang::get('logging.', [
                'name' => Auth::user()->name
            ]);

            Log::warning($logging);
        }

        return Redirect::back();
    }

    /**
     * Enable login.
     *
     * @link
     * @param $id, integer, user id.
     */
    public function unBlockUser($id)
    {
        $user          = User::find($id);
        $user->blocked = 0;

        if ($user->save()) {
            $logging = Lang::get('logging.unblockUserSuccess', [
                'name' => Auth::user()->name]
            );

            Log::info($logging);
        } else {
            $logging = Lang::get('logging.unblockUserFailure', [
                'name' => Auth::user()->name]
            );

            Log::warning($logging);
        }

        return Redirect::back();
    }

    /**
     * Delete a user out of the system.
     *
     * @link
     * @param $id, integer, user id.
     */
    public function deleteUser($id)
    {
        // Dragons are here! I'm scared.
        // TODO: write delete method.
        // TODO: Affected tables, notifications, user, permissions

        User::destroy($id);
        Permission::where('user_id', $id)->delete();
        Notifications::where('user_id', $id)->delete();

        $logging = Lang::get('', [

        ]);

        Log::info($logging);
    }
}