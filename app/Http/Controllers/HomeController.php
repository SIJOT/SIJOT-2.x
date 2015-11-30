<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @Get("/", as="index")
     */
    public function index()
    {
        $data['title'] = 'Index';
        $data['active'] = 0;

        return View('front-end.home', $data);
    }
}
