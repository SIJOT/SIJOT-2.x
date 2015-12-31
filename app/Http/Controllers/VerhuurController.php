<?php

namespace App\Http\Controllers;

class VerhuurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @Get("/verhuur", as="rental.Client")
     */
    public function index()
    {
        $data['title'] = 'Verhuur';

        return view('front-end.verhuurIndex', $data);
    }

    /**
     * [VIEW] Show the form for creating a new resource. - Client.
     *
     * @link   [GET] www.domain.tld/rental/new
     *
     * @return \Illuminate\Http\Response
     *
     * @Get("/verhuur/aanvragen", as="rental.request")
     */
    public function aanvragen()
    {
        $data['title'] = 'Verhuur | Aanvraag';

        return view('front-end.verhuurAanvraag', $data);
    }

    /**
     * [VIEW] Rental view fot the date's.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @Get("/verhuur/bereikbaarheid", as="rental.route")
     */
    public function bereikbaarheid()
    {
        $data['title'] = 'Verhuur | Bereikbaarheid';

        return view('front-end.verhuurBereikbaarheid', $data);
    }
}
