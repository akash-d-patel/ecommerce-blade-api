<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Http\Requests\Review\CreateRequest;
use App\Http\Requests\Review\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ReviewResource;

class ReviewController extends BaseController
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
    public function index(Product $product, Request $request)
    {

        $page_title = 'Reviews - ' . $product->name;

        $reviews = Review::whereHas('product', function ($query) use ($product) {
            $query->where('id', $product->id);
            return $query;
        })->pimp()->paginate();

        if ($request->is('api/*')) {

            $reviews = ReviewResource::collection($reviews);
            return $this->sendResponse(compact('product', 'reviews'), "All Record");
        }

        return view('reviews.index', compact('page_title', 'reviews', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product, Review $review)
    {
        $page_title = 'Reviews - ' . $product->name;
        return view('reviews.create', compact('product', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Product $product, Review $review, CreateRequest $request)
    {
        $review = Review::createUpdate($product, $review, $request);

        $message = "Review added successfully";

        if ($request->is('api/*')) {
            $review = new ReviewResource($review);
            return $this->sendResponse(compact('review'), $message);
        }


        return redirect(route('reviews.index', $product->id))->with('message', $message);
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
    public function edit(Product $product, Review $review)
    {
        $page_title = 'Reviews - ' . $product->name;
        return view('reviews.edit', compact('product', 'review', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Review $review, EditRequest $request)
    {
        $review = Review::createUpdate($product, $review, $request);

        $message = "Review updated successfully";

        if ($request->is('api/*')) {

            $review = new ReviewResource($review);
            return $this->sendResponse(compact('review'), $message);
        }
        return redirect(route('reviews.index', [$product->id]))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Review $review, Request $request)
    {
        $review->delete();

        $message = "Review deleted successfully";

        if ($request->is('api/*')) {

            $review = new ReviewResource($review);
            return $this->sendResponse(compact('review'), $message);
        }

        return redirect(route('reviews.index', $product->id))->with('message', $message);
    }
}
