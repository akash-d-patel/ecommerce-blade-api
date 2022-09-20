<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Image;
use App\Http\Requests\Image\CreateRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CategoryImageResource;

class CategoryImageController extends BaseController
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
    public function index(Category $category, Request $request)
    {
        $page_title = 'Images - ' . $category->name;

        $images = Image::whereHas('category', function ($query) use ($category) {
            $query->where('id',  $category->id);
            return $query;
        })->pimp()->paginate();

        if ($request->is('api/*')) {

            CategoryImageResource::collection($images);
            return $this->sendResponse(compact('category','images'), "All Record");
        }

        return view('categoryimages.index', compact('images', 'category', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $page_title = 'Images - ' . $category->name;
        return view('categoryimages.create', compact('category', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category, Image $image, CreateRequest $request)
    {
        $image = Image::createUpdateCategory($category, $image, $request);

        $message = "Image added successfully";

        if ($request->is('api/*')) {
            $image = new CategoryImageResource($image);
            return $this->sendResponse(compact('image'), $message);
        }

        return redirect(route('categories.images.index', $category->id))->with('message', $message);;
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
    public function destroy(Category $category, Image $image, Request $request)
    {
        $category->images()->find($image->id)->delete();

        $message = "Image deleted successfully";

        if ($request->is('api/*')) {

            $image = new CategoryImageResource($image);
            return $this->sendResponse(compact('image'), $message);
        }

        return redirect(route('categories.images.index', $category->id))->with('message', $message);
    }
}
