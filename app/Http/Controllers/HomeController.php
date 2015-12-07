<?php

namespace App\Http\Controllers;

use Hopp\DbUtil\Facades\DbUtil;
use Illuminate\Support\Facades\Auth;

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
        dd(DbUtil::exists('users','default'));
        $data['title'] = 'Index';
        $data['active'] = 0;

        return View('front-end.home', $data);
    }
}
