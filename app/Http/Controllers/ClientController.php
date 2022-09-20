<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Requests\Client\CreateRequest;
use App\Http\Requests\Client\EditRequest;
use App\Http\Resources\ClientResource;
use App\Http\Controllers\Api\BaseController;

class ClientController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Client::class, 'client');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Clients';

        $clients = Client::with(['creater'])->pimp()->paginate();

        if ($request->is('api/*')) {

            $clients = ClientResource::collection($clients);
            return $this->sendResponse(compact('clients'), "All Record");
        }

        return view('client.index', compact('page_title', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Client';
        return view('client.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $client = Client::createUpdate(new Client, $request);

        $message = "Client added successfully";

        if ($request->is('api/*')) {

            $client = new ClientResource($client);
            return $this->sendResponse(compact('client'), $message);
        }

        return redirect(route('clients.index'))->with('message', $message);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $page_title = 'Client';
        return view('client.edit', compact('page_title', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Client $client)
    {
        $client = Client::createUpdate($client, $request);

        $message = "Client updated successfully";

        if ($request->is('api/*')) {
            $client = new ClientResource($client);
            return $this->sendResponse(compact('client'), $message);
        }

        return redirect(route('clients.index'))->with($message);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client, Request $request)
    {
        $client->delete();

        $message = "Client deleted successfully";

        if ($request->is('api/*')) {
            $client = new ClientResource($client);
            return $this->sendResponse(compact('client'), $message);
        }

        return redirect()->route('clients.index')->with('message', $message);;
    }
}
