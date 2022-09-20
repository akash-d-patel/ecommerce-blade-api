<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Brand;
use App\Http\Requests\Seo\CreateRequest;
use App\Http\Requests\Seo\EditRequest;
use App\Http\Resources\BrandSeoResource;
use App\Models\Seo;
use Illuminate\Http\Request;

class BrandsSeoController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Seo::class, 'seo');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Brand $brand, Seo $seo, Request $request)
    {
        $page_title = 'SEO';
        $seo = Seo::with(['creater']);
        $seo = $brand->seo;
        return view('Brands.Seo.edit', compact('page_title', 'seo','brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Brand $brand, Seo $seo)
    {
        $page_title = $brand->name;
        $page_description = 'Create SEO';
        return view('Brand.Seo.create', compact('page_title','brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Brand $brand, Seo $seo, CreateRequest $request)
    {
        $seo = Seo::addUpdate(new Seo ,$request); 

        $brand->seo()->save($seo);

        $message = "SEO added successfully";
        
        if( $request->is('api/*')){
            // dd($seo);
            $seo = new BrandSeoResource($seo);
            return $this->sendResponse(compact('seo'),$message);
        }
        
        return redirect(route('brands.index'))->with('message', $message);
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
    public function edit(Brand $brand, Seo $seo)
    {
        $page_title = $brand->name;
        $seo = Seo::find($seo->id);
        return view('Brand.Seo.edit', compact('page_title', 'seo','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Brand $brand, Seo $seo, EditRequest $request)
    {
        $seo = Seo::addUpdate($seo, $request);

        $message = "SEO updated successfully";

        if( $request->is('api/*')){

            $seo = new BrandSeoResource($seo);
            return $this->sendResponse(compact('seo'), $message);
        }

        return redirect()->route('brands.index',$brand)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seo $seo)
    {
       //
    }
}
