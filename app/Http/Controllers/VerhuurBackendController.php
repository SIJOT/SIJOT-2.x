<?php

namespace App\Http\Controllers;

use Pusher;
use App\Verhuring;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']  = 'Verhuur control panel';
        $data['active'] = 8;
        $data['dbData'] = []; // TODO: Setup eloqunet query.

        return View('', $data);
    }

    /**
     * [VIEW] Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * [Method] Store a newly created resource in storage.
     *
     * @param  Requests\RentalValidator $input
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

        if ($rental->save()) {
            $this->pusher->trigger('verhuur_channel', 'verhuur_notification', [
                'class'   => 'info',
                'message' => 'Er is een nieuwe verhuur aanvraag gebeurd',
            ]);
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
