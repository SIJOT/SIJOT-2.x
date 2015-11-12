<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VerhuurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Verhuur';

        return view('front-end.verhuurIndex', $data);
    }

    public function aanvragen()
    {
        $data['title'] = 'Verhuur | Aanvraag';

        return view('front-end.verhuurAanvraag', $data);
    }

    public function bereikbaarheid()
    {
       $data['title'] = 'Verhuur | Bereikbaarheid';

        return view('front-end.verhuurBereikbaarheid', $data);
    }

    public function kalender()
    {

    }
}
