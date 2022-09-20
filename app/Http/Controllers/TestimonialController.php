<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Requests\Testimonial\CreateRequest;
use App\Http\Requests\Testimonial\EditRequest;
use App\Http\Resources\TestimonialResource;
use App\Models\Client;

class TestimonialController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Testimonial::class, 'testimonial');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = "Testimonials";

        $testimonials = Testimonial::with(['creater'])->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {

            $testimonials = TestimonialResource::collection($testimonials);
            return $this->sendResponse(compact('page_title', 'testimonials'), $message);
        }

        return view('testimonials.index', compact('page_title', 'testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Testimonial";
        $clients = Client::all();
        return view('testimonials.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:50'
        ]);
        $testimonial = Testimonial::createUpdate(new Testimonial, $request);

        $message = "Testimonial added successfully";

        if ($request->is('api/*')) {

            $testimonial = new TestimonialResource($testimonial);
            return $this->sendResponse(compact('testimonial'), $message);
        }

        return redirect(route('testimonials.index'))->with('message', $message);
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
    public function edit(Testimonial $testimonial)
    {
        $page_title = 'testimonial';
        $clients = Client::all();
        return view('testimonials.edit', compact('page_title', 'testimonial', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Testimonial $testimonial)
    {
        $testimonial = Testimonial::createUpdate($testimonial, $request);

        $message = "Testimonial updated successfully";

        if ($request->is('api/*')) {

            $testimonial = new TestimonialResource($testimonial);
            return $this->sendResponse(compact('testimonial'), $message);
        }

        return redirect(route('testimonials.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial, Request $request)
    {
        //
        $testimonial->delete();

        $message = "Testimonial deleted successfully";

        if ($request->is('api/*')) {
            $testimonial = new TestimonialResource($testimonial);
            return $this->sendResponse(compact('testimonial'), $message);
        }

        return redirect()->route('testimonials.index')->with('message', $message);
    }
}
