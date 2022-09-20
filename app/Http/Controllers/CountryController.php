<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\Country\CreateRequest;
use App\Http\Requests\Country\EditRequest;
use App\Http\Resources\CountryResource;
use App\Models\Client;

class CountryController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Country::class, 'country');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Counties';

        $countries = Country::with('creater')->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {

            $countries = CountryResource::collection($countries);

            return $this->sendResponse(compact('page_title', 'countries'), $message);
        }

        return view('country.index', compact('page_title', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title = 'Counties';

        $countries = Country::all();

        $clients = Client::all();

        return view('country.create', compact('page_title', 'countries', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $country = Country::createUpdate(new Country, $request);

        $message = "Country added successfully";
        
        if( $request->is('api/*')){
            
            $country = new CountryResource($country);

            return $this->sendResponse(compact('country'), $message);
        }

        return redirect(route('countries.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $page_title = 'Counties';

        $countries = Country::all();

        $clients = Client::all();

        return view('country.edit', compact('page_title', 'countries', 'country', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Country $country)
    {
        $country = Country::createUpdate($country, $request);

        $message = "Country updated successfully";

        if ($request->is('api/*')) {

            $country = new CountryResource($country);

            return $this->sendResponse(compact('country'), $message);
        }

        return redirect(route('countries.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country, Request $request)
    {
        $country->delete();

        $message = "Country deleted successfully";

        if ($request->is('api/*')) {

            $country = new CountryResource($country);

            return $this->sendResponse(compact('country'), $message);
        }

        return redirect(route('countries.index'))->with('message', $message);
    }
}
