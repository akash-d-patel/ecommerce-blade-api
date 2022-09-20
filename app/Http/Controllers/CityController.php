<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\State;
use App\Http\Requests\City\CreateRequest;
use App\Http\Requests\City\EditRequest;
use App\Http\Resources\CityResource;
use App\Models\Country;
use App\Models\Client;

class CityController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(City::class, 'city');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Cities';

        $cities = City::with('creater')->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {

            $cities = CityResource::collection($cities);
            return $this->sendResponse(compact('page_title', 'cities'), $message);
        }
        return view('city.index', compact('page_title', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Cities';

        $countries = Country::with("countries")->pluck("name", "id");

        $states = State::all();

        $clients = Client::all();

        return view('city.create', compact('page_title', 'countries', 'states', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $city = City::createUpdate(new City, $request);

        $message = "City added successfully";

        if ($request->is('api/*')) {

            $city = new CityResource($city);

            return $this->sendResponse(compact('city'), $message);
        }
        return redirect(route('cities.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city, Request $request)
    {
        $page_title = 'Cities';

        $countries = Country::all();

        $states = State::where('country_id', $city->state->country_id)->get();

        $clients = Client::all();

        return view('city.edit', compact('page_title', 'city', 'states', 'countries', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, City $city)
    {
        $city = City::createUpdate($city, $request);

        $message = "City updated successfully";

        if ($request->is('api/*')) {

            $city = new CityResource($city);

            return $this->sendResponse(compact('city'), $message);
        }

        return redirect(route('cities.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city, Request $request)
    {
        $city->delete();

        $message = "City deleted successfully";

        if ($request->is('api/*')) {

            $city = new CityResource($city);

            return $this->sendResponse(compact('city'), $message);
        }

        return redirect(route('cities.index'))->with('message', $message);
    }

    public function getCityList(Request $request)
    {
        $cities = City::where("state_id", $request->state_id)
            ->pluck("name", "id");

        return response()->json($cities);
    }
}
