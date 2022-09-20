<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\Banner\CreateRequest;
use App\Http\Requests\Banner\EditRequest;
use App\Http\Resources\BannerResource;
use App\Http\Controllers\Api\BaseController;
use App\Models\Client;

class BannerController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Banner::class, 'banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Banners';

        $banners = Banner::with('creater')->pimp()->paginate();

        if ($request->is('api/*')) {
            //dd($users);
            $banners = BannerResource::collection($banners);
            return $this->sendResponse(compact('banners'), "All Record");
        }

        return view('banner.index', compact('page_title', 'banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Banners';
        $banners = Banner::all();
        $clients = Client::all();
        return view('banner.create', compact('page_title', 'banners', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $banner = Banner::CreateUpdate(new Banner, $request);

        if ($request->is('api/*')) {

            $banner = new BannerResource($banner);
            return $this->sendResponse(compact('banner'),'Banner added successfully');
        }

        return redirect(route('banners.index'))->with('message', 'Banner added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $page_title = 'Banners';
        $banners = Banner::all();
        $clients = Client::all();
        return view('banner.edit', compact('page_title', 'banners', 'banner', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Banner $banner)
    {
        $banner = Banner::createUpdate($banner, $request);

        if ($request->is('api/*')) {

            $banner = new BannerResource($banner);
            return $this->sendResponse(compact('banner'),'Banner updated successfully');
        }

        return redirect(route('banners.index'))->with('message', 'Banner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner, Request $request)
    {
        $banner->delete();

        if ($request->is('api/*')) {

            $banner = new BannerResource($banner);
            return $this->sendResponse(compact('banner'),'Banner deleted successfully');
        }

        return redirect(route('banners.index'))->with('message', 'Banner deleted successfully');
    }
}
