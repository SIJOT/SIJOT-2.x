<?php

namespace App\Http\Controllers;

use App\Groep;
use App\Http\Requests\emailValidator;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class UserManagement extends Controller
{
    public $ledenbeheer;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ledenbeheer', ['only' => ['getIndex', 'UserProfile']]);
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
    public function userProfile($id)
    {
        $data['title'] = 'Gebruikers profiel';
        $data['active'] = 0;

        $user = User::where('id', $id)->get();

        // Database Query's.
        $data['permission']  = Permission::where('user_id', $id)->get();
        $data['groepen']     = Groep::lists('group', 'id');
        $data['user_groups'] = User::find($id)->groups()->get();

        //$user = User::where('id', $id)->get();

        if (count($user) === 1) {
            foreach ($user as $info) {
                // User info
                $data['username'] = $info->name;
                $data['email']    = $info->email;
                $data['avatar']   = $info->avatar;
                $data['id']       = $info->id;

                // Permission info.
            }
        }

        return View('back-end.profile', $data);
    }

    /**
     * Method: Change the permissions off the user.
     *
     * @param $id
     * @return
     * @internal param Request $request
     *
     * @post("backend/acl/changeCredentails/{id}", as="acl.PermissionsUpdate")
     */
    public function changePermissions($id)
    {
        // The permission values.
        // these will be inserted.
        $db['verhuurbeheer'] = Input::has('verhuurbeheer') ? true : false;
        $db['ledenbeheer']   = Input::has('ledenbeheer')   ? true : false;
        $db['media']         = Input::has('media')         ? true : false;
        $db['cloud']         = Input::has('cloud')         ? true : false;

        // Insert to the database.
        $permission = Permission::find(['user_id' => $id]);
        $permission->fill($db);
        $permission->save();

        // redirect to the previous page.
        return Redirect::back();
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

        // Update method for the user group.
        if (! empty(Input::get('groepen'))) {
            $groupsId = Input::get('groepen');
            $groupUpdate = Auth::user()->groups()->sync($groupsId);
        }

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

        $user->name = Input::get('gebruikers_naam');
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
