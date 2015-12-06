<?php

namespace App\Http\Controllers;

use App\Http\Requests\emailValidator;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class UserManagement extends Controller
{
    public $ledenbeheer;

    public function __construct()
    {
        // $this->middleware('auth');

        // TODO: Need be created.
        // TODO: set middleware
        // TODO: set the ledenbeheer middleware
        $this->middleware('auth');
    }

    /**
     * get the index view for the usermanagement console.
     *
     * @return \Illuminate\View\View
     *
     * @Get("backend/acl", as="acl.index")
     */
    public function getIndex()
    {
        if (Gate::denies('leden-beheer', Auth::user()->permission->ledenbeheer)) {
            return Redirect::back();
        }

        $data['title'] = 'Gebruikers beheer';
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
     *
     * @return \Illuminate\View\View
     *
     * @Get("backend/acl/profile/{id} ", as="acl.index")
     */
    public function UserProfile($id)
    {
        if (Gate::denies('leden-beheer', Auth::user()->permission->ledenbeheer)) {
            return Redirect::back();
        }

        $data['title'] = 'Gebruikers profiel';
        $data['active'] = 0;
        $data['permission'] = Permission::where('user_id', $id)->get();

        $user = User::where('id', $id)->get();

        if (count($user) === 1) {
            foreach ($user as $info) {
                $data['username'] = $info->name;
                $data['email'] = $info->email;
                $data['avatar'] = $info->avatar;
                $data['id'] = $info->id;
            }
        }

        return View('back-end.profile', $data);
    }

    /**
     * Method so change the user his credentials.
     *
     * @param emailValidator $input
     * @param $id
     *
     * @Post("backend/acl/changeCredentials/{id}", as="acl.changeCredentials")
     */
    public function changeCredentials(emailValidator $input, $id)
    {
        $user = User::findOrFail($id);

        if (Input::hasFile('avatar')) {
            //dd(request()->all());
            $file = Input::file('avatar');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);

            $imagePath = public_path('uploads/'.$fileName);
            $image = Image::make($imagePath)->resize(100, 100);
            $image->save();

            $user->avatar = $imagePath;
        }

        $user->name = Input::get('name');
        $user->email = $input->email;

        if (! empty($user->password)) {
            $user->password = Hash::make(Input::get('password'));
        }

        if (! $user->save()) {
            die('cant save');
        }

        // die('saved');
        return Redirect::back();
    }
}
