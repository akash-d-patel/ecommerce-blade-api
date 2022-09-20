<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Image;
use App\Http\Requests\Image\CreateRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\NewsImageResource;


class NewsImageController extends BaseController
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
    public function index(News $news, Request $request)
    {
        $page_title = 'Images - ' . $news->title;

        $images = Image::whereHas('news', function ($query) use ($news) {
            $query->where('id',  $news->id);
            return $query;
        })->pimp()->paginate();

        if ($request->is('api/*')) {

            NewsImageResource::collection($images);
            return $this->sendResponse(compact('news','images'), "All Record");
        }

        return view('newsimages.index', compact('images', 'news', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(News $news)
    {
        $page_title = 'Images - ' . $news->title;
        return view('newsimages.create', compact('news', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(News $news, Image $image, CreateRequest $request)
    {

        $image = Image::createUpdateNews($news, $image, $request);

        $message = "Image added successfully";

        if ($request->is('api/*')) {
            $image = new NewsImageResource($image);
            return $this->sendResponse(compact('image'), $message);
        }

        return redirect(route('news.images.index', $news->id))->with('message', $message);;
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
    public function destroy(News $news, Image $image, Request $request)
    {
        $news->images()->find($image->id)->delete();

        $message = "Image deleted successfully";

        if ($request->is('api/*')) {

            $image = new NewsImageResource($image);
            return $this->sendResponse(compact('image'), $message);
        }

        return redirect(route('news.images.index', $news->id))->with('message', $message);;
    }
}
