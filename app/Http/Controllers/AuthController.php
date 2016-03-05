<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registervalidation;
use App\Notifications;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Pusher;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // TODO: set named routes.

    public $pusher;
    public $authMiddleware = ['viewLogin', 'verifyLogin', 'getLogout'];
    public $ledenMiddleware = ['deleteUser', 'unBlockUser', 'blockUser', 'Register'];

    /**
     * AuthorizationController constructor.
     */
    public function __construct()
    {
        // Set Real Time Notification. (Pusher)
        $this->pusher = new Pusher(
            env('PUSHER_KEY'),
            env('PUSHER_SECRET'),
            env('PUSHER_ID')
        );

        $this->middleware('auth', ['except' => $this->authMiddleware]);
        $this->middleware('ledenbeheer', ['only' => $this->ledenMiddleware]);
    }

    /**
     * [VIEW] The login page.
     *
     * @Get("/login", as="login.Get")
     */
    public function viewLogin()
    {
        return View('auth.login');
    }

    /**
     * Verify that a user can login into the system.
     *
     * @Post("/login", as="login.Post")
     */
    public function verifyLogin()
    {
        $restrictions['email']    = Input::get('email');
        $restrictions['password'] = Input::get('password');

        if (Auth::attempt($restrictions)) {
            // Get the role from the user.
            $userRole = Auth::user()->role;

            // var_dump(Session::get('permission')->first()->ledenbeheer);

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
            $logging = Lang::get('logging.loggedIn', ['user' => Auth::user()->name]);
            Log::info($logging);

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
     *
     * @Post("/backend/acl/register", as="acl.register")
     */
    public function register(Registervalidation $input)
    {
        // Password random generated string.
        $password = str_random(14);

        // User insert
        $users = new User();
        $users->name = $input->name;
        $users->email = $input->email;
        $users->password = Hash::make($password);
        $users->save();

        $permissions = new Permission();
        $permissions->user_id = $users->id;

        $notifications = new Notifications();
        $notifications->user_id = $users->id;

        // Save the values.
        if ($notifications->save() && $users->save() && $permissions->save()) {
            $user = User::findOrFail($users->id);

            Mail::queue('emails.registration', ['users' => $user], function ($m) use ($user) {
                // Load the sender details, from read operation into the config.
                $m->to($user->email, $user->name)->subject('Registratie St-Joris Turnhout');
                $m->from(config('platform.websiteContact'), config('platform.websiteName'));
            });

            $loggingData['name']  = $users->name;
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
     *
     * @Get("/logout", as="logout")
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
     *
     * @Get("/backend/acl/block/{id}", as="acl.block")
     */
    public function blockUser($id)
    {
        $user = User::find($id);
        $user->blocked = 1;

        if ($user->save()) {
            $logging = Lang::get('logging.', ['name' => Auth::user()->name]);
            Log::info($logging);
        }

        return Redirect::back();
    }

    /**
     * Enable login.
     *
     * @param $id, integer, user id.
     *
     * @Get("/backend/acl/unblock/{id}", as="acl.unblock")
     */
    public function unBlockUser($id)
    {
        $user = User::find($id);
        $user->blocked = 0;

        if ($user->save()) {
            $logging = Lang::get('logging.unblockUserSuccess', ['name' => Auth::user()->name]);
            Log::info($logging);
        }

        return Redirect::back();
    }

    /**
     * Delete a user out of the system.
     *
     * @link
     *
     * @param $id, integer, user id.
     *
     * @Get("/backend/acl/delete/{id}", as="acl.delete")
     */
    public function deleteUser($id)
    {
        // Dragons are here! I'm scared.
        $user = User::find($id);

        if (File::exists($user->avatar)) {
            File::delete($user->avatar);
        }

        User::destroy($id);
        Permission::where('user_id', $id)->delete();
        Notifications::where('user_id', $id)->delete();

        $logging = Lang::get('', ['user' => Auth::user()->name,]);
        Log::info($logging);

        return Redirect::back();
    }
}
