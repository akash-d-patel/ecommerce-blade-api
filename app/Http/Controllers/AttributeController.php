<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Requests\Attribute\CreateRequest;
use App\Http\Requests\Attribute\EditRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Client;


class AttributeController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Attribute::class, 'attribute');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Attributes';

        $attributes = Attribute::with(['creater'])->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {
            $attributes = AttributeResource::collection($attributes);
            return $this->sendResponse(compact('page_title', 'attributes'), $message);
        }

        return view('attributes.index', compact('page_title', 'attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Attributes';
        $clients = Client::all();
        return view('attributes.create', compact('page_title', 'clients'));
    }

    public function store(CreateRequest $request)
    {
        $attribute = Attribute::createUpdate(new Attribute, $request);

        $message = "Attribute added successfully";

        if ($request->is('api/*')) {

            $attribute = new AttributeResource($attribute);
            return $this->sendResponse(compact('attribute'), $message);
        }

        return redirect(route('attributes.index'))->with('message', $message);
    }

    public function show($id)
    {
        //
        //Attribute::create($request->all());
        //return view('attributes.show',compact('attribute'));
    }

    public function edit(Attribute $attribute)
    {
        $page_title = 'attributes';
        $clients = Client::all();
        return view('attributes.edit', compact('page_title', 'attribute', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Attribute $attribute)
    {
        $attribute = Attribute::createUpdate($attribute, $request);

        $message = "Attribute updated successfully";

        if ($request->is('api/*')) {

            $attribute = new AttributeResource($attribute);
            return $this->sendResponse(compact('attribute'), $message);
        }

        return redirect(route('attributes.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute, Request $request)
    {
        //
        $attribute->delete();

        $message = "Attribute deleted successfully";

        if ($request->is('api/*')) {
            $attribute = new AttributeResource($attribute);
            return $this->sendResponse(compact('attribute'), $message);
        }

        return redirect()->route('attributes.index')->with('message', $message);
    }
}
