<?php

namespace App\Http\Controllers;

use App\Verhuring;
use App\Http\Requests;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class apiVerhuurController extends Controller
{
    public $fractal;

    /**
     * apiVerhuurController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth.basic');
        $this->middleware('verhuurbeheer');

        $this->fractal = new Manager();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @get("/api/v1/verhuring")
     *
     */
    public function index()
    {
        $query = Verhuring::paginate();
        $rental = $query->getCollection();

        $resource = new Collection($rental, $this->transformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($query));

        $content = $this->fractal->createData($resource)->toJson();

        $response = response($content, 200);
        $response->header('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @get("/api/v1/verhuring/{id}")
     */
    public function show($id)
    {
        $query = Verhuring::where('id', $id)->get();

        if (count($query) > 0) {
            $resource = new Collection($query, $this->transformer());
            $content = $this->fractal->createData($resource)->toJson();
        } else {
            $content = [
                'errors' => [[
                    'message' => 'Er zijn geen verhuringen gevonden.',
                ]],
            ];
        }

        $response = response($content, 200);
        $response->header('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * transformer.
     *
     * This class is used to structure the data into Json array's.
     * Because api column name's can be hardly changed we need to
     * use a tranformer. The column names can only be changed on
     * major releases.
     *
     * @return \Closure
     */
    private function transformer()
    {
        /**
         * @param  array $rental
         * @return array
         */
        return function($rental) {
            return [
                'id'     => (int) $rental['id'],
                'status' => (int) $rental['Status'],
                'datum'  => [
                    'start' => (string) $rental['Start_Datum'],
                    'eind'  => (string) $rental['Eind_datum'],
                ]
            ];
        };
    }
}
