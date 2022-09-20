<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\Image\CreateRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BannerImageResource;

class BannerImageController extends BaseController
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
    public function index(Banner $banner, Request $request)
    {
        $page_title = 'Images - ' . $banner->name;

        $images = Image::whereHas('banner', function ($query) use ($banner) {
            $query->where('id',  $banner->id);
            return $query;
        })->pimp()->paginate();

        if ($request->is('api/*')) {

            BannerImageResource::collection($images);
            return $this->sendResponse(compact('banner', 'images'), "All Record");
        }

        return view('bannerimages.index', compact('banner', 'images', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Banner $banner)
    {
        $page_title = 'Images - ' . $banner->name;
        return view('bannerimages.create', compact('banner', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Banner $banner, Image $image, CreateRequest $request)
    {

        $image = Image::createUpdateBanner($banner, $image, $request);

        $message = "Image added successfully";

        if ($request->is('api/*')) {
            $image = new BannerImageResource($image);
            return $this->sendResponse(compact('image'), $message);
        }

        return redirect(route('banners.images.index', $banner->id))->with('message', $message);
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
    public function destroy(Banner $banner, Image $image, Request $request)
    {
        $banner->images()->find($image->id)->delete();

        $message = "Image deleted successfully";

        if ($request->is('api/*')) {

            $image = new BannerImageResource($image);
            return $this->sendResponse(compact('image'), $message);
        }

        return redirect(route('banners.images.index', $banner->id))->with('message', $message);
    }
}
