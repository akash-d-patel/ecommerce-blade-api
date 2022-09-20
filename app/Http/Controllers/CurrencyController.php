<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Requests\Currency\CreateRequest;
use App\Http\Requests\Currency\EditRequest;
use App\Http\Resources\CurrencyResource;
use App\Http\Controllers\Api\BaseController;
use App\Models\Client;

class CurrencyController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Currency::class, 'currency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Currency $currency)
    {
        $page_title = 'Currency';

        $currencies = $currency->pimp()->paginate();

        if ($request->is('api/*')) {

            $currencies = CurrencyResource::collection($currencies);
            return $this->sendResponse(compact('currencies'), "All Record");
        }

        return view('currency.index', compact('page_title', 'currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Currency';
        $page_description = 'Create Currency';
        $clients = Client::all();
        return view('currency.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $currency = Currency::addUpdate(new Currency, $request);

        $message = "Currency added successfully";

        if ($request->is('api/*')) {

            $currency = new CurrencyResource($currency);
            return $this->sendResponse(compact('currency'), $message);
        }

        return redirect(route('currency.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        $page_title = 'Currency';
        $clients = Client::all();
        return view('currency.edit', compact('page_title', 'currency', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Currency $currency)
    {
        $currency = Currency::addUpdate($currency, $request);

        $message = "Currency updated successfully";

        if ($request->is('api/*')) {

            $currency = new CurrencyResource($currency);
            return $this->sendResponse(compact('currency'), $message);
        }

        return redirect()->route('currency.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency, Request $request)
    {
        $currency->delete();

        $message = "Currency deleted successfully";

        if ($request->is('api/*')) {

            $currency = new CurrencyResource($currency);
            return $this->sendResponse(compact('currency'), $message);
        }

        return redirect()->route('currency.index')->with('message', $message);
    }
}
