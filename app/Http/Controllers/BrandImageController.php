<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Image;
use App\Http\Requests\Image\CreateRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BrandImageResource;

class BrandImageController extends BaseController
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
    public function index(Brand $brand, Request $request)
    {
        $page_title = 'Images - ' . $brand->name;

        $images = Image::whereHas('brand', function ($query) use ($brand) {
            $query->where('id',  $brand->id);
            return $query;
        })->pimp()->paginate();

        if ($request->is('api/*')) {

            BrandImageResource::collection($images);

            return $this->sendResponse(compact('brand','images'), "All Record");
        }

        return view('brandimages.index', compact('images', 'page_title', 'brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Brand $brand)
    {
        $page_title = 'Images - ' . $brand->name;
        return view('brandimages.create', compact('brand', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Brand $brand, Image $image, CreateRequest $request)
    {
        $image = Image::createUpdateBrand($brand, $image, $request);

        $message = "Image added successfully";

        if ($request->is('api/*')) {
            $image = new BrandImageResource($image);
            return $this->sendResponse(compact('image'), $message);
        }

        return redirect(route('brands.images.index', $brand->id))->with('message', $message);;
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
    public function destroy(Brand $brand, Image $image, Request $request)
    {

        $brand->images()->find($image->id)->delete();

        $message = "Image deleted successfully";

        if ($request->is('api/*')) {

            $image = new BrandImageResource($image);
            return $this->sendResponse(compact('image'), $message);
        }

        return redirect(route('brands.images.index', $brand->id))->with('message', $message);;
    }
}
