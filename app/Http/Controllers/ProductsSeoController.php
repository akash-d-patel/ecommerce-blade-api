<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Seo\CreateRequest;
use App\Http\Requests\Seo\EditRequest;
use App\Http\Resources\ProductSeoResource;
use App\Models\Product;
use App\Models\Seo;
use Illuminate\Http\Request;

class ProductsSeoController extends BaseController
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
    public function index(Product $product, Seo $seo, Request $request)
    {
        $page_title = 'SEO';
        $seo = Seo::with(['creater']);
        $seo = $product->seo;
        return view('product.seo.edit', compact('page_title', 'seo','product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product, Seo $seo)
    {
        $page_title = $product->name;
        $page_description = 'Create SEO';
        return view('product.seo.create', compact('page_title','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, Seo $seo, CreateRequest $request)
    {
        $seo = Seo::addUpdate(new Seo ,$request); 

        $product->seo()->save($seo);

        $message = "SEO added successfully";
        
        if( $request->is('api/*')){
            // dd($seo);
            $seo = new ProductSeoResource($seo);
            return $this->sendResponse(compact('seo'),$message);
        }
        
        return redirect(route('products.index'))->with('message', $message);
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
    public function edit(Product $product, Seo $seo)
    {
        $page_title = $product->name;
        $seo = Seo::find($seo->id);
        return view('product.seo.edit', compact('page_title', 'seo','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Seo $seo, EditRequest $request)
    {
        $seo = Seo::addUpdate($seo, $request);

        $message = "SEO updated successfully";

        if( $request->is('api/*')){

            $seo = new ProductSeoResource($seo);
            return $this->sendResponse(compact('seo'), $message);
        }

        return redirect()->route('products.index',$product)->with('message', $message);
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
