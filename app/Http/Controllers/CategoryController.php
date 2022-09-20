<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\EditRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use App\Models\Client;

class CategoryController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $page_title = 'Categories';

        $categories = Category::with(['creater'])->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {
            $categories = CategoryResource::collection($categories);
            return $this->sendResponse(compact('page_title', 'categories'), $message);
        }

        return view('category.index', compact('page_title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Categories';
        $page_description = 'Create your Category';

        $categories = Category::all();
        $clients = Client::all();

        return view('category.create', compact('page_title', 'categories', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $category = Category::createUpdate(new Category, $request);
        $message = "Category added successfully";

        if ($request->is('api/*')) {

            $category = new CategoryResource($category);
            return $this->sendResponse(compact('category'), $message);
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
    public function edit(Category $category)
    {
        $page_title = 'Categories';
        $categories = Category::all();
        $clients = Client::all();
        return view('category.edit', compact('page_title', 'categories', 'category', 'clients'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Category $category)
    {
        $category = Category::createUpdate($category, $request);

        $message = "Category updated successfully";

        if ($request->is('api/*')) {

            $category = new CategoryResource($category);
            return $this->sendResponse(compact('category'), $message);
        }

        return redirect(route('categories.index'))->with('message', $message);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {

        $category->delete();

        $message = "Category deleted successfully";

        if ($request->is('api/*')) {
            $category = new CategoryResource($category);
            return $this->sendResponse(compact('category'), $message);
        }

        return redirect(route('categories.index'))->with('message', $message);
    }
}
