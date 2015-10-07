<?php

namespace App\Http\Controllers;

use Pusher;
use App\Info;
use App\Activiteiten;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TakkenViewController extends Controller
{
    public $pusher;

    /**
     * Constructor class.
     *
     * Just to set the middleware
     */
    public function __construct()
    {
        // $this->middleware('auth');

        // Set Real Time Notification. (Pusher)
        $this->pusher = new Pusher(
            env('PUSHER_KEY'),
            env('PUSHER_SECRET'),
            env('PUSHER_ID')
        );
    }

    /**
     * Get All the groups.
     *
     * @link   {GET} /takken
     * @return \Illuminate\View\View
     */
    public function TakAll()
    {
        $data['title']  = 'De Takken';
        $data['active'] = 1;

        return View('front-end.tak', $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function Tak($fragment)
    {
        $data['title']  = 'De Leiding';
        $data['active'] = 1;
        $data['Activiteiten'] = Activiteiten::where('URI_fragment', '=', $fragment)->get();
        $data['Beschrijving'] = Info::where('URI_fragment', '=', $fragment)->get();

        return View('front-end.tak', $data);
    }

    /**
     * [VIEW] Update the group.
     *
     * @link   {GET} /backend/takken/update/{fragment}
     * @param  $fragment
     * @return \Illuminate\View\View
     */
    public function getUpdate($fragment)
    {
        $data['title']     = 'Update tak';
        $data['active']    = 1;
        $data['groupData'] = Info::where('URI_fragment', '=', $fragment)->get();

        return View('back-end.group-update' , $data);
    }

    /**
     * [METHOD] Update group description.
     *
     * @link   {POST} /backend/takken/update
     * @param  Requests\TakkenValidator $input
     * @return Redirect
     */
    public function postUpdate(Requests\TakkenValidator $input)
    {
        // Database insert (eloquent).
        $group               = new Info();
        $group->Title        = $input->title;
        $group->Sub_title    = $input->subTitle;
        $group->Beschrijving = $input->description;


        // Check if it can be updated in the MySQL database.
        // If not, Make a flash session. And kick my ass back to the shithole.
        if (! $group->save) {
            $this->pusher->trigger('channel_takken', 'takken_notification', [
                'class'   => 'error',
                'message' => 'Wij konden de gegevens niet aanpassen.'
            ]);
        } elseif ($group->save()) {
            $this->pusher->trigger('channel_takken', 'takken_notification', [
                'class'   => 'info',
                'message' => 'De tak gegevens zijn geupdate.'

            ]);
        }

        // Redirect to the previous page.
        return Redirect::back();
    }
}
