<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Models\Seo;
use Illuminate\Http\Request;
use App\Http\Requests\Seo\CreateRequest;
use App\Http\Requests\Seo\EditRequest;
use App\Http\Resources\CategorySeoResource;

class CategorySeoController extends BaseController
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
    public function index(Category $category, Seo $seo, Request $request)
    {
        $page_title = 'SEO';
        $seo = Seo::with(['creater']);
        $seo = $category->seo;
        return view('category.seo.edit', compact('page_title', 'seo','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category, Seo $seo)
    {
        $page_title = $category->name;
        $page_description = 'Create SEO';
        return view('category.seo.create', compact('page_title','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category, Seo $seo, CreateRequest $request)
    {
        $seo = Seo::addUpdate(new Seo ,$request); 

        $category->seo()->save($seo);

        $message = "SEO added successfully";
        
        if( $request->is('api/*')){
            // dd($seo);
            $seo = new CategorySeoResource($seo);
            return $this->sendResponse(compact('seo'),$message);
        }
        
        return redirect(route('categories.index'))->with('message', $message);
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
    public function edit(Category $category, Seo $seo)
    {
        $page_title = $category->name;
        $seo = Seo::find($seo->id);
        return view('category.seo.edit', compact('page_title', 'seo','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Seo $seo, EditRequest $request)
    {
        $seo = Seo::addUpdate($seo, $request);

        $message = "SEO updated successfully";

        if( $request->is('api/*')){

            $seo = new CategorySeoResource($seo);
            return $this->sendResponse(compact('seo'), $message);
        }

        return redirect()->route('categories.index',$category)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
