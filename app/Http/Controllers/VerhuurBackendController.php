<?php

namespace App\Http\Controllers;

use App\Events\VerhuurBroadCast;
use App\Notifications;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Pusher;
use App\Verhuring;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;


class verhuurBackendController extends Controller
{
    public $pusher;

    // todo: set $m->from from hardcoded to dynamic with the config facade - Mailing.

    /**
     * Class constructor.
     */
    public function __construct()
    {
        // Set Real Time Notification. (Pusher)
        $this->pusher = new Pusher(
            env('PUSHER_KEY'),
            env('PUSHER_SECRET'),
            env('PUSHER_ID')
        );

        $this->middleware('auth', ['except' => [
            'store', 'getCalendar'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * Covers the following things:
     *
     * - Creation
     * - Delete
     * - Modify
     * - Option setter
     * - Confirm setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('verhuur-beheer', Auth::user()->permission->verhuurbeheer)) {
            return Redirect::back();
        }

        // todo: add download method
        // todo: add search  method.

        $data['title']  = 'Verhuur control panel';
        $data['active'] = 8;
        $data['dbData'] = Verhuring::all();

        $notificationsQuery = Notifications::where('user_id', Auth::user()->id)
            ->get();

        if (count($notificationsQuery) == 1) {
            foreach($notificationsQuery as $notification) {
                $data['notificationStatus'] = $notification->verhuring;
            }
        } else {
            $data['notificationStatus'] = 3;
        }

        return View('back-end.rentalIndex', $data);
    }

    /**
     * [Method] Store a newly created resource in storage.
     *
     * @link    [POST] www.domain.tld/rental/new
     * @param   Requests\RentalValidator $input
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\RentalValidator $input)
    {
        $old_sep = ["/","-"];
        $new_sep = ".";
        // Values
        $Start = str_replace($old_sep, $new_sep, $input->StartDatum);
        $Eind  = str_replace($old_sep, $new_sep, $input->EindDatum);

        $rental              = new Verhuring();
        $rental->Start_datum = strtotime($Start);
        $rental->Eind_datum  = strtotime($Eind);
        $rental->Groep       = $input->Groep;
        $rental->Email       = $input->Email;
        // $rental->GSM         = $input->Gsm;
        $rental->Status      = 0;

        if ($rental->save()) {
            if (! Auth::check()) {
                Mail::send('emails.verhuurAanvraag', ['data' => $input], function ($m) use ($input) {
                    $m->to($input->Email)->subject('Aanvraag verhuur | St-joris Turnhout');
                    $m->from('topairy@gmail.com', 'Tim Joosten');
                });

                Log::info('Verhuur bevestiging is naar de aanvrager verzonden.');
            }

            if (Config::get('platform.broadcast') === true) {
                $pusherData['class']   = 'alert alert-success';
                $pusherData['message'] = 'Er is een nieuwe verhuring aangevraagd.';

                $this->pusher->trigger('channel_verhuur', 'verhuur_notification', $pusherData);
            }

            $notificationMembers = Notifications::where('verhuring', 1)->get();

            foreach($notificationMembers as $person) {
                $user = User::find($person->id);

                Mail::send('emails.verhuurNotificatie', ['data' => $input], function ($m) use ($user) {
                    $m->to($user->email, $user->name)->subject('Notificatie verhuur | St-joris Turnhout');
                    $m->from('topairy@gmail.com', 'Tim Joosten');
                });

                Log::info('Verhuur notificatie mail is verzonden.');
            }

        }

        return Redirect::back();
    }

    /**
     * Display the confirmed dates..
     *
     * @return \Illuminate\Http\Response
     */
    public function getCalendar()
    {
        // General values.
        $data['title']  = '';
        $data['active'] = ''; // Integer

        // MySQL Database
        //
        // SELECT * FROM Verhuur; <- MySQL Query
        $data['MySQL'] = Verhuring::all();

        return View('front-end.verhuur-kalender', $data);
    }

    /**
     * Set rental to an option
     *
     * TODO: Implement acl.
     *
     * @link: [GET] www.domain.tld/rental/option
     * @middleware Rental, Admin
     * @param $id, integer, The id of the rental request.
     */
    public function option($id)
    {
        if (Gate::denies('verhuur-beheer', Auth::user()->permission->verhuurbeheer)) {
            return Redirect::back();
        }

        $status          = Verhuring::findOrNew($id);
        $status->status  = 1;

        if ($status->save()) {
            $logging = Lang::get('rental.optionSucces', [
                'user' => Auth::user()->name
            ]);

            Log::info($logging);
        } else {
            $logging = Lang::get('rental.optionFailure', [
                'user' => Auth::user()->name
            ]);

            Log::warning($logging);
        }

        return Redirect::back();
    }

    public function downloadContract()
    {
        if (Gate::denies('verhuur-beheer', Auth::user()->permission->verhuurbeheer)) {
            return Redirect::back();
        }

        $pdf = App::make('dompdf.wrapper');
        $pdfStream = $pdf->loadView('pdf.verhuurContract', []);

        return $pdfStream->download('verhuurContract.pdf');
    }

    /**
     * Set rental to confirmed.
     *
     * TODO: implement ACL
     *
     * @link: [GET] www.domain.tld/rental/confirm.
     * @middleware, Rental, Admin.
     * @param $id, int, The id of the rental request.
     */
    public function confirmed($id)
    {
        if (Gate::denies('verhuur-beheer', Auth::user()->permission->verhuurbeheer)) {
            return Redirect::back();
        }

        $status         = Verhuring::findOrNew($id);
        $status->status = 2;

        if ($status->save()) {
            $logging = Lang::get('logging.RentalSuccess');
            Log::info($logging, [
                'user' => Auth::user()->name
            ]);
        } else {
            $logging = Lang::get('logging.RentalFailure');
            Log::info($logging, [
                'user' => Auth::user()->name
            ]);
        }

        return Redirect::back();
    }

    /**
     * Update the specified resource in storage.
     *
     * TODO: Implement acl.
     *
     * @link        [POST] www.domain.tld/rental/update.
     * @middleware  admin
     * @param       \Illuminate\Http\Request  $request
     * @param       int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('verhuur-beheer', Auth::user()->permission->verhuurbeheer)) {
            return Redirect::back();
        }

        $verhuring = Verhuring::findOrNew($id);

        if ($verhuring->save()) {
            $logging = Lang::get(':user changed a rental', [
                'user' => Auth::user()->name
            ]);

            Log::info($logging);
        } else {
            $logging = Lang::get(':user tried to change a rental', [
                'user' => Auth::user()->name
            ]);

            Log::info($logging);
        }

        return Redirect::back();
    }

    /**
     * Remove a rental with a soft delete.
     *
     * TODO:  create laravel cronjonb for this.
     * TODO:  Add if else with the gate function.
     * TODO:  Implement ACL.
     *
     * @link       [GET] www.domain.tld/rental/remove
     * @middleware Auth
     * @param      int  $id, The rental id.
     *
     * @return     \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('verhuur-beheer', Auth::user()->permission->verhuurbeheer)) {
            return Redirect::back();
        }

        Verhuring::destroy($id);

        $logging = Lang::get('logging.rentalDelete', [
            'user' => Auth::user()->user
        ]);

        Log::info($logging);

        return Redirect::back();
    }
}
