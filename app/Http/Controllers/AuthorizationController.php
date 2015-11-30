<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registervalidation;
use App\Notifications;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Pusher;

class AuthorizationController extends Controller
{
    public $pusher;
    public $authMiddleware = ['viewLogin', 'verifyLogin', 'getLogout'];
    public $ledenbeheer;

    public function __construct()
    {
        // Set Real Time Notification. (Pusher)
        $this->pusher = new Pusher(
            env('PUSHER_KEY'),
            env('PUSHER_SECRET'),
            env('PUSHER_ID')
        );

        if (Auth::check()) {
            $this->permissionQuery = Permission::where('user_id', Auth::user()->id)->get();

            foreach ($this->permissionQuery as $output) {
                $this->ledenbeheer = $output->ledenbeheer;
                $this->verhuurbeheer = $output->verhuurbeheer;
            }
        } else {
            $this->permission = 0;
        }

        $this->middleware('auth', ['except' => $this->authMiddleware]);
    }

    /**
     * [VIEW] The login page.
     *
     * @Get("")
     */
    public function viewLogin()
    {
        return View('auth.login');
    }

    /**
     * Verify that a user can login into the system.
     *
     * TODO: Pusher integration. For welcome message.
     *
     * @Get("")
     */
    public function verifyLogin()
    {
        $restrictions['email'] = Input::get('email');
        $restrictions['password'] = Input::get('password');

        if (Auth::attempt($restrictions)) {
            // Get the role from the user.
            $userRole = Auth::user()->role;

            // var_dump(Session::get('permission')->first()->ledenbeheer);
            // die();

            if ($userRole === 2) {
                // Administrator
                $redirectUrl = URL::to('/backend/verhuur');
            } elseif ($userRole === 0) {
                // Ouders
                $redirectUrl = URL::to('/backend/ouders');
            } elseif ($userRole === 1) {
                // Leiding
                $redirectUrl = URL::to('/backend/takken/update');
            } else {
                // TODO: make route for login view and define it in a variable.
                $redirectUrl = '';
            }

            // Logging instance
            $logging = Lang::get('logging.loggedIn', [
                'user' => Auth::user()->name,
            ]);

            Log::info($logging);

            // Set user_id to the session.

            /* @var string, $redirectUrl */
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
        if (Gate::denies('leden-beheer', $this->ledenbeheer)) {
            return Redirect::back();
        }

        // User insert
        $users = new User();
        $users->name = $input->name;
        $users->email = $input->email;
        $users->password = Hash::make('sijot');
        $users->save();

        $permissions = new Permission();
        $permissions->user_id = $users->id;

        $notifications = new Notifications();
        $notifications->user_id = $users->id;

        // Save the values.
        if ($notifications->save() && $users->save() && $permissions->save()) {
            $user = User::findOrFail($users->id);

            // dd($user);

            Mail::send('emails.registration', ['users' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Registratie St-Joris Turnhout');
                $m->from('topairy@gmail.com', 'Tim Joosten');
            });

            $loggingData['name'] = $users->name;
            $loggingData['users'] = Auth::user()->name;

            Log::info(Lang::get('logging.registrationSuccess', $loggingData));
        } else {
            $logging = Lang::get('logging.registrationError');
            Log::error($logging);
        }

        return Redirect::back();
    }

    /**
     * Throw the user out of the backend.
     */
    public function getLogout()
    {
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
        if (Gate::denies('leden-beheer', Auth::user()->permission->ledenbeheer)) {
            return Redirect::back();
        }

        $user = User::find($id);
        $user->blocked = 1;

        if ($user->save()) {
            $logging = Lang::get('logging.', [
                'name' => Auth::user()->name,
            ]);

            Log::warning($logging);
        } else {
            $logging = Lang::get('logging.', [
                'name' => Auth::user()->name,
            ]);

            Log::warning($logging);
        }

        return Redirect::back();
    }

    /**
     * Enable login.
     *
     * @link
     *
     * @param $id, integer, user id.
     */
    public function unBlockUser($id)
    {
        if (Gate::denies('leden-beheer', Auth::user()->permission->ledenbeheer)) {
            return Redirect::back();
        }

        $user = User::find($id);
        $user->blocked = 0;

        if ($user->save()) {
            $logging = Lang::get('logging.unblockUserSuccess', [
                'name' => Auth::user()->name, ]
            );

            Log::info($logging);
        } else {
            $logging = Lang::get('logging.unblockUserFailure', [
                'name' => Auth::user()->name, ]
            );

            Log::warning($logging);
        }

        return Redirect::back();
    }

    /**
     * Delete a user out of the system.
     *
     * @link
     *
     * @param $id, integer, user id.
     */
    public function deleteUser($id)
    {
        // Dragons are here! I'm scared.
        if (Gate::denies('leden-beheer', $this->ledenbeheer)) {
            return Redirect::back();
        }

        $user = User::find($id);

        if (File::exists($user->avatar)) {
            File::delete($user->avatarr);
        }

        User::destroy($id);
        Permission::where('user_id', $id)->delete();
        Notifications::where('user_id', $id)->delete();

        $logging = Lang::get('', [
            'user' => Auth::user()->name,
        ]);

        Log::info($logging);

        return Redirect::back();
    }
}
