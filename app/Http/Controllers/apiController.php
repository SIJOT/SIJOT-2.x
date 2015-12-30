<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class apiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @get("/api/v1/")
     */
    public function index()
    {
        $content = [
            'name' => 'SIJOT API',
            'bugs' => 'https://github.com/SIJOT/SIJOT-2.x',
            'developer' => [[
                'name_developer' => 'Tim Joosten',
                'email' => 'Topairy@gmail.com',
                'twitter' => '@X0rif',
            ]]
        ];

        return response($content, 200)
            ->header('Conten-Type', 'application/json');
    }
}
