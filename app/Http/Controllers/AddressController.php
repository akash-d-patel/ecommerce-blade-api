<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Http\Requests\Address\CreateRequest;
use App\Http\Requests\Address\EditRequest;
use App\Http\Resources\AddressResource;
use App\Models\Client;

class AddressController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Address::class, 'address');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Address';

        $addresses = Address::with('creater')->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {

            $addresses = AddressResource::collection($addresses);
            return $this->sendResponse(compact('page_title', 'addresses'), $message);
        }

        return view('address.index', compact('page_title', 'addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Address';
        $page_description = 'Create your address';

        $countries = Country::with("countries")->pluck("name", "id");
        $states = State::all();
        $cities = City::all();
        $clients = Client::all();

        return view('address.create', compact('page_title', 'countries', 'states', 'cities', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $request->validate([

            'mobile_no' => 'required|digits:10|numeric',
            'pin_code' => 'required|digits:6|numeric',
        ]);
        $address = Address::createUpdate(new Address, $request);

        $message = "Address added successfully";

        if ($request->is('api/*')) {

            $address = new AddressResource($address);
            return $this->sendResponse(compact('address'), $message);
        }

        return redirect(route('addresses.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        $page_title = 'Address';
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $clients = Client::all();

        return view('address.edit', compact('page_title', 'address', 'countries', 'states', 'cities', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Address $address)
    {
        $request->validate([

            'mobile_no' => 'required|digits:10|numeric',
            'pin_code' => 'required|digits:6|numeric',
        ]);
        $address = Address::createUpdate($address, $request);

        $message = "Address updated successfully";

        if ($request->is('api/*')) {

            $address = new AddressResource($address);
            return $this->sendResponse(compact('address'), $message);
        }

        return redirect(route('addresses.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address, Request $request)
    {
        $address->delete();

        $message = "Address deleted successfully";

        if ($request->is('api/*')) {
            $address = new AddressResource($address);
            return $this->sendResponse(compact('address'), $message);
        }
        return redirect(route('addresses.index'))->with('message', $message);
    }
}
