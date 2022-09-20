<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use App\Http\Requests\Tax\CreateRequest;
use App\Http\Requests\Tax\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\TaxResource;
use App\Models\Client;

class TaxController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Tax::class, 'tax');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tax $tax)
    {
        $page_title = 'Tax';

        $taxes = $tax->pimp()->paginate();

        if ($request->is('api/*')) {

            $taxes = TaxResource::collection($taxes);
            return $this->sendResponse(compact('taxes'), "All Record");
        }

        return view('tax.index', compact('page_title', 'taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Tax';
        $page_description = 'Create tax';
        $clients = Client::all();
        return view('tax.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $tax = Tax::addUpdate(new Tax, $request);

        $message = "Tax added successfully";

        if ($request->is('api/*')) {

            $tax = new TaxResource($tax);
            return $this->sendResponse(compact('tax'), $message);
        }

        return redirect(route('tax.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        $page_title = 'Tax';
        $clients = Client::all();
        return view('tax.edit', compact('page_title', 'tax', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Tax $tax)
    {
        $tax = Tax::addUpdate($tax, $request);

        $message = "Tax updated successfully";

        if ($request->is('api/*')) {

            $tax = new TaxResource($tax);
            return $this->sendResponse(compact('tax'), $message);
        }

        return redirect()->route('tax.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax, Request $request)
    {
        $tax->delete();

        $message = "Tax deleted successfully";

        if ($request->is('api/*')) {

            $tax = new TaxResource($tax);
            return $this->sendResponse(compact('tax'), $message);
        }

        return redirect()->route('tax.index')->with('message', $message);
    }
}
