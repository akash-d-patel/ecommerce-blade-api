<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Requests\State\CreateRequest;
use App\Http\Requests\State\EditRequest;
use App\Http\Resources\StateResource;
use App\Models\Country;
use App\Models\Client;

class StateController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(State::class, 'state');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'States';

        $states = State::with('creater')->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {

            $states = StateResource::collection($states);
            return $this->sendResponse(compact('page_title', 'states'), $message);
        }

        return view('state.index', compact('page_title', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'States';
        $page_description = 'Create your state';
        $countries = Country::all();
        $clients = Client::all();
        return view('state.create', compact('page_title', 'countries', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $state = State::createUpdate(new State, $request);

        $message = "State added successfully";

        if ($request->is('api/*')) {

            $state = new StateResource($state);
            return $this->sendResponse(compact('state'), $message);
        }
        return redirect(route('states.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $page_title = 'States';
        $countries = Country::all();
        $clients = Client::all();
        return view('state.edit', compact('page_title', 'state', 'countries', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, State $state)
    {

        $state = State::createUpdate($state, $request);

        $message = "State updated successfully";

        if ($request->is('api/*')) {
            $state = new StateResource($state);
            return $this->sendResponse(compact('state'), $message);
        }

        return redirect(route('states.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state, Request $request)
    {
        $state->delete();

        $message = "State deleted successfully";

        if ($request->is('api/*')) {
            $state = new StateResource($state);
            return $this->sendResponse(compact('state'), $message);
        }
        return redirect(route('states.index'))->with('message', $message);
    }

    public function getStateList(Request $request)
    {
        $states = State::where("country_id", $request->country_id)
            ->pluck("name", "id");

        return response()->json($states);
    }
}
