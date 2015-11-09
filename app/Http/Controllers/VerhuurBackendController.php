<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Pusher;
use App\Verhuring;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;


class verhuurBackendController extends Controller
{
    public $pusher;

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
        // todo: add button to enable and disable notifications.
        // todo: add ownload button and method
        // todo: add search form and method.

        $data['title']  = 'Verhuur control panel';
        $data['active'] = 8;
        $data['dbData'] = Verhuring::all();

        return View('back-end.rentalIndex', $data);
    }

    /**
     * [VIEW] Show the form for creating a new resource. - Client
     *
     * @link   [GET] www.domain.tld/rental/new
     * @return \Illuminate\Http\Response
     */
    public function createClient()
    {
        $data['title']  = '';
        $data['active'] = 8;

        return View('front-end.verhuur-aanvraag', $data);
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
        $rental              = new Verhuring();
        $rental->Start_datum = $input->StartDatum;
        $rental->Eind_datum  = $input->EindDatum;
        $rental->Groep       = $input->Groep;
        $rental->Email       = $input->Email;
        $rental->GSM         = $input->Gsm;
        $rental->Status      = 0;

        if ($rental->save()) {
            $this->pusher->trigger('verhuur_channel', 'verhuur_notification', [
                'class'   => 'info',
                'message' => 'Er is een nieuwe verhuur aanvraag gebeurd',
            ]);

            // TODO: Write mailing logic.
            // TODO: One to the requester.
            // TODO: One to every person that activated the notification system.

            $notificationMembers = Notifications::where('verhuring', 1)->get();

            foreach($notificationMembers as $person) {

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
        $data['MySQL'] = Verhuring::where()->get();

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
        $status         = Verhuring::find($id);
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
        $verhuring = Verhuring::find($id);

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
    }
}
