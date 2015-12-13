<?php

namespace App\Http\Controllers;

use App\Activiteiten;
use App\Groep;
use App\Http\Requests;
use App\Info;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Pusher;

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
     * @return \Illuminate\View\View
     *
     * @Get("takken", as="groups.all")
     */
    public function takAll()
    {
        $data['title'] = 'De Takken';
        $data['active'] = 1;

        // Get Tak info out of the MySQL DB.
        $data['takken']      = Info::all();
        $data['kapoenen']    = Info::getGroup('kapoenen')->get();
        $data['welpen']      = Info::getGroup('welpen')->get();
        $data['jongGivers']  = Info::getGroup('jong-givers')->get();
        $data['givers']      = Info::getGroup('givers')->get();
        $data['jins']        = Info::getGroup('jins')->get();
        $data['leiding']     = Info::getGroup('leiding')->get();

        return View('front-end.takken', $data);
    }

    /**
     * Get the group information.
     *
     * @param $fragment
     *
     * @return \Illuminate\View\View
     *
     * @Get("takken/{fragment}", as="groups.specific")
     */
    public function tak($fragment)
    {
        $data['title'] = 'De Leiding';
        $data['active'] = 1;

        $data['Activiteiten'] = Activiteiten::where('URI_fragment', '=', $fragment)->get();
        $data['Beschrijving'] = Info::getGroup($fragment)->get();

        return View('front-end.tak', $data);
    }

    /**
     * [VIEW] Update the group.
     *
     * @return \Illuminate\View\View
     *
     * @internal param $fragment
     *
     * @Get("/backend/takken/update", as="groups.groups.getUpdate")
     */
    public function getUpdate()
    {
        $data['title'] = 'Update tak';
        $data['active'] = 1;

        // Get Tak info out of the MySQL DB.
        $data['kapoenen']   = Info::getGroup('kapoenen')->get();
        $data['welpen']     = Info::getGroup('welpen')->get();
        $data['jongGivers'] = Info::getGroup('jong-givers')->get();
        $data['givers']     = Info::getGroup('givers')->get();
        $data['jins']       = Info::getGroup('jins')->get();
        $data['leiding']    = Info::getGroup('leiding')->get();

        return View('back-end.group-update', $data);
    }

    /**
     * [METHOD] Update group description.
     *
     * @param Requests\TakkenValidator $input
     *
     * @return Redirect
     *
     * @Post("/backend/takken/update", as="groups.postUpdate")
     */
    public function postUpdate(Requests\TakkenValidator $input)
    {
        // Database insert (eloquent).
        $group = new Info();
        $group->Title = $input->title;
        $group->Sub_title = $input->subTitle;
        $group->Beschrijving = $input->description;

        // Check if it can be updated in the MySQL database.
        // If not, Make a flash session. And kick my ass back to the system.

        // TODO: lang files support.
        if (! $group->save()) {
            $this->pusher->trigger('channel_takken', 'takken_notification', [
                'class'   => 'error',
                'message' => 'Wij konden de gegevens niet aanpassen.',
            ]);
        } elseif ($group->save()) {
            $this->pusher->trigger('channel_takken', 'takken_notification', [
                'class'   => 'info',
                'message' => 'De tak gegevens zijn geupdate.',

            ]);
        }

        // Redirect to the previous page.
        return Redirect::back();
    }

    public function activateGroups()
    {
        $tak = new Groep();

        // Scouts en gidsen vlaanderen
        $tak->segvl_kapoenen = Input::has('kapoenen')     ? true : false;
        $tak->segvl_welpen = Input::has('welpen')         ? true : false;
        $tak->segvl_jonggivers = Input::has('jongGivers') ? true : false;
        $tak->segvl_givers = Input::has('givers')         ? true : false;
        $tak->segvl_jins = Input::has('jins')             ? true : false;
        $tak->segvl_leiding = Input::has('leiding')       ? true : false;

        // FOS Scouting
        $tak->bevers = Input::has('Bevers')               ? true : false;
        $tak->zeehonden = Input::has('zeehouden')         ? true : false;

        // Les Scouts
        $tak->ls_baladins = Input::has('baladins')        ? true : false;
        $tak->ls_louveteaux = Input::has('louveteaux')    ? true : false;
        $tak->ls_eclaireurs = Input::has('eclaireurs')    ? true : false;
        $tak->ls_poinniers = input::has('pionniers')      ? true : false;

        if ($tak->save()) {
        }
    }

    public function getAllgroups($id)
    {
        return View('', $data);
    }
}
