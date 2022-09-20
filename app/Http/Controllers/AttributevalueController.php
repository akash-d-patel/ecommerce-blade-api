<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\Attribute;
use App\Http\Requests\AttributeValue\CreateRequest;
use App\Http\Requests\AttributeValue\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\AttributevalueResource;

class AttributevalueController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(AttributeValue::class);
        $this->getMiddleware();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Attribute $attribute, Request $request)
    {
        $page_title = 'Attributes - ' . $attribute->name;

        $attributeValues = AttributeValue::whereHas('attribute', function ($query) use ($attribute) {
            $query->where('id',  $attribute->id);
            return $query;
        })->pimp()->paginate();

        if ($request->is('api/*')) {

            AttributevalueResource::collection($attributeValues);
            return $this->sendResponse(compact('attribute', 'attributeValues'), "All Record");
        }

        return view('attribute_values.index', compact('page_title', 'attribute', 'attributeValues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Attribute $attribute)
    {
        $page_title = 'Attributes - ' . $attribute->name;
        return view('attribute_values.create', compact('attribute', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Attribute $attribute, CreateRequest $request)
    {
        $validated = $request->validate([
            'value' => 'required|min:3|max:50'
        ]);
        $attributevalue = AttributeValue::createUpdate($attribute, new AttributeValue, $request);

        $message = "Value added successfully";

        if ($request->is('api/*')) {

            $attributevalue = new AttributevalueResource($attributevalue);
            return $this->sendResponse(compact('attributevalue'), $message);
        }

        return redirect(route('attribute-value.index', $attribute->id))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
    public function edit(Attribute $attribute, AttributeValue $attributeValue)
    {
        $attributeValue = AttributeValue::find($attributeValue->id);
        $page_title = 'Attributes - ' . $attribute->name;

        return view('attribute_values.edit', compact('page_title', 'attribute', 'attributeValue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Attribute $attribute, EditRequest $request, AttributeValue $attributeValue)
    {

        $attributeValue = AttributeValue::createUpdate($attribute, $attributeValue, $request);

        $message = "Value updated successfully";

        if ($request->is('api/*')) {

            $attributeValue = new AttributevalueResource($attributeValue);
            return $this->sendResponse(compact('attributeValue'), $message);
        }

        return redirect(route('attribute-value.index', $attribute))->with('message',  $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute, AttributeValue $attributeValue, Request $request)
    {
        $attributeValue->delete();

        $message = "Value deleted successfully";

        if ($request->is('api/*')) {

            $attributeValue = new AttributevalueResource($attributeValue);
            return $this->sendResponse(compact('attributeValue'), $message);
        }

        return redirect(route('attribute-value.index', compact('attributeValue', 'attribute')))->with('message', $message);
    }
}
