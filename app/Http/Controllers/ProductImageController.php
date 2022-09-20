<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\Product;
use App\Models\Product;
use App\Models\Image;
use App\Http\Requests\Image\CreateRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ProductImageResource;

class ProductImageController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Image::class, 'image');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product, Request $request)
    {
        $page_title = 'Images - ' . $product->name;

        $images = Image::whereHas('product', function ($query) use ($product) {
            $query->where('id',  $product->id);
            return $query;
        })->pimp()->paginate();

        if ($request->is('api/*')) {

            ProductImageResource::collection($images);
            return $this->sendResponse(compact('product', 'images'), "All Record");
        }

        return view('productimages.index', compact('product', 'page_title', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $page_title = 'Images - ' . $product->name;
        return view('productimages.create', compact('product', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, Image $image, CreateRequest $request)
    {

        $image = Image::createUpdateProduct($product, $image, $request);

        $message = "Image added successfully";

        if ($request->is('api/*')) {
            $image = new ProductImageResource($image);
            return $this->sendResponse(compact('image'), $message);
        }

        return redirect(route('products.images.index', $product->id))->with('message', $message);;
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Image $image, Request $request)
    {
        $product->images()->find($image->id)->delete();

        $message = "Image deleted successfully";

        if ($request->is('api/*')) {

            $image = new ProductImageResource($image);
            return $this->sendResponse(compact('image'), $message);
        }

        return redirect(route('products.images.index', $product->id))->with('message', $message);
    }
}
