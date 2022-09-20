<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\ProductDescription;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductDescription\CreateRequest;
use App\Http\Requests\ProductDescription\EditRequest;
use App\Http\Resources\ProductDescriptionResource;

class ProductDescriptionController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(ProductDescription::class);
        $this->getMiddleware();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product, Request $request)
    {
        $page_title = 'Descriptions - '. $product->name;

        $productDescriptions = ProductDescription::whereHas('product', function ($query) use ($product) {
            $query->where('id', $product->id);
            return $query;
        })->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {
            
            $productDescriptions = ProductDescriptionResource::collection($productDescriptions);

            return $this->sendResponse(compact('page_title', 'product', 'productDescriptions'), $message);
        }

        return view('product_descriptions.index',compact('page_title','productDescriptions','product'));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $page_title = 'Descriptions - '. $product->name;

        return view('product_descriptions.create',compact('product','page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, ProductDescription $productDescription, CreateRequest $request)
    {
        
        $productDescription = ProductDescription::createUpdate($product, $productDescription, $request);

        $message = "Description added successfully";

        if( $request->is('api/*')){
            // dd($file);
            $productDescription = new ProductDescriptionResource($productDescription);

            return $this->sendResponse(compact('productDescription'),$message);
        }

        return redirect(route('product_description.index',$product->id))->with('message', $message);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductDescription  $productDescription
     * @return \Illuminate\Http\Response
     */
    public function show(ProductDescription $productDescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductDescription  $productDescription
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, ProductDescription $productDescription)
    {
        $productDescription = ProductDescription::find($productDescription->id);

        $page_title = 'Descriptions - '. $product->name;

        return view('product_descriptions.edit', compact('page_title','product','productDescription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductDescription  $productDescription
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, EditRequest $request, ProductDescription $productDescription)
    {
        $productDescription = ProductDescription::createUpdate($product,$productDescription, $request);

        $message = "Description updated successfully";

        if($request->is('api/*')){

            $productDescription = new ProductDescriptionResource($productDescription);

            return $this->sendResponse(compact('productDescription'),$message);
        }

        return redirect(route('product_description.index',$product))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductDescription  $productDescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, ProductDescription $productDescription, Request $request)
    {
        $productDescription->delete();

        $message = "Description deleted successfully";

        if($request->is('api/*')){

            $productDescription = new ProductDescriptionResource($productDescription);

            return $this->sendResponse(compact('productDescription'), $message);
        }

        return redirect(route('product_description.index',compact('productDescription','product')))->with('message', $message);
    }
}
