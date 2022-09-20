<?php

namespace App\Http\Controllers;

use App\Models\Timezone;
use Illuminate\Http\Request;
use App\Http\Requests\Timezone\CreateRequest;
use App\Http\Requests\Timezone\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\TimezoneResource;
use App\Models\Client;

class TimezoneController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Timezone::class, 'timezone');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Timezone $timezone)
    {
        $page_title = 'Timezone';

        $timezones = $timezone->pimp()->paginate();

        if ($request->is('api/*')) {

            $timezones = TimezoneResource::collection($timezones);
            return $this->sendResponse(compact('timezones'), "All Record");
        }

        return view('timezone.index', compact('page_title', 'timezones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Timezone';
        $page_description = 'Create Timezone';
        $clients = Client::all();
        return view('timezone.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $timezone = Timezone::addUpdate(new Timezone, $request);

        $message = "Timezone added successfully";

        if ($request->is('api/*')) {

            $timezone = new TimezoneResource($timezone);
            return $this->sendResponse(compact('timezone'), $message);
        }

        return redirect(route('timezone.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timezone  $timezone
     * @return \Illuminate\Http\Response
     */
    public function show(Timezone $timezone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timezone  $timezone
     * @return \Illuminate\Http\Response
     */
    public function edit(Timezone $timezone)
    {
        $page_title = 'Timezone';
        $clients = Client::all();
        return view('timezone.edit', compact('page_title', 'timezone', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timezone  $timezone
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Timezone $timezone)
    {
        $timezone = Timezone::addUpdate($timezone, $request);

        $message = "Timezone updated successfully";

        if ($request->is('api/*')) {

            $timezone = new TimezoneResource($timezone);
            return $this->sendResponse(compact('timezone'), $message);
        }
        return redirect()->route('timezone.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timezone  $timezone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timezone $timezone, Request $request)
    {
        $timezone->delete();

        $message = "Timezone deleted successfully";

        if ($request->is('api/*')) {

            $timezone = new TimezoneResource($timezone);
            return $this->sendResponse(compact('timezone'), $message);
        }
        return redirect()->route('timezone.index')->with('message', $message);
    }
}
