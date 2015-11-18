<?php

namespace App\Http\Controllers;

use App\Events\VerhuurBroadCast;
use App\Notifications;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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

        // TODO: create and register rental middlware?
        // $this->middleware('auth');
        // $this->middleware('rental')
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
                $pusherData['class']   = '';
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

            // Requester mailing method.
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
     * @link: [GET] www.domain.tld/rental/option
     * @middleware Rental, Admin
     * @param $id, integer, The id of the rental request.
     */
    public function option($id)
    {
        $status          = Verhuring::find($id);
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
        $pdf = App::make('dompdf.wrapper');
        $pdfStream = $pdf->loadView('pdf.verhuurContract', []);

        return $pdfStream->download('verhuurContract.pdf');
    }

    /**
     * Set rental to confirmed.
     *
     * @link: [GET] www.domain.tld/rental/confirm.
     * @middleware, Rental, Admin.
     * @param $id, int, The id of the rental request.
     */
    public function confirmed($id)
    {
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
     * @link        [POST] www.domain.tld/rental/update.
     * @middleware  Rental, admin
     * @param       \Illuminate\Http\Request  $request
     * @param       int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
     * TODO:  create laravel cronjonb for this.
     *
     * @link       [GET] www.domain.tld/rental/remove
     * @middleware Rental, Admin
     * @param      int  $id, The rental id.
     *
     * @return     \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Verhuring::destroy($id);

        $logging = Lang::get('logging.rentalDelete', [
            'user' => Auth::user()->user
        ]);
        Log::info($logging);

        return Redirect::back();
    }
}
