<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Review;
use App\Http\Requests\Review\CreateRequest;
use App\Http\Requests\Review\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ReviewResource;

class NewsReviewController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Review::class, 'review');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(News $news,Request $request, Review $review)
    {

        $page_title = 'Reviews - '. $news->title;

        $reviews = Review::whereHas('news', function($query) use ($news) {
            $query->where('id',  $news->id);
            return $query;
        })->pimp()->paginate();

        if ($request->is('api/*')) {

            $reviews = ReviewResource::collection($reviews);
            return $this->sendResponse(compact('news','reviews'), "All Record");
        }

        return view('newsReviews.index', compact('page_title', 'reviews', 'news'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(News $news,Review $review)
    {
        $page_title = 'Reviews - '. $news->title;
        return view('newsReviews.create', compact('news', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(News $news, Review $review, CreateRequest $request)
    {
        $review = Review::createUpdateNews($news, $review, $request);

        $message = "Review added successfully";

        if ($request->is('api/*')) {
            $review = new ReviewResource($review);
            return $this->sendResponse(compact('review'), $message);
        }

        return redirect(route('news.reviews.index',$news->id))->with('message',$message);
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
    public function edit(News $news,Review $review)
    {
        $page_title = 'Reviews - '. $news->title;
        return view('newsReviews.edit', compact('news', 'review', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(News $news,Review $review ,EditRequest $request)
    {
        $review = Review::createUpdateNews($news, $review, $request);

        $message = "Review updated successfully";

        if ($request->is('api/*')) {

            $review = new ReviewResource($review);
            return $this->sendResponse(compact('review'), $message);
        }

        return redirect(route('news.reviews.index',$news->id))->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news,Review $review, Request $request) 
    {
        $review->delete();

        $message = "Review deleted successfully";

        if ($request->is('api/*')) {

            $review = new ReviewResource($review);
            return $this->sendResponse(compact('review'), $message);
        }

        return redirect(route('news.reviews.index',$news->id))->with('message',$message);
    }
}
