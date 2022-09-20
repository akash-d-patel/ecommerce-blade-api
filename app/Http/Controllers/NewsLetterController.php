<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use App\Http\Requests\NewsLetter\CreateRequest;
use App\Http\Requests\NewsLetter\EditRequest;
use App\Http\Resources\NewsLetterResource;
use App\Models\Client;

class NewsLetterController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(NewsLetter::class, 'newsLetter');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'News Letter';

        $newsLetters = NewsLetter::with(['creater'])->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {
            $newsLetters = NewsLetterResource::collection($newsLetters);
            return $this->sendResponse(compact('page_title', 'newsLetters'), $message);
        }

        return view('newsLetters.index', compact('page_title', 'newsLetters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'News Letter';
        $page_description = 'Create your news letter';
        $clients = Client::all();
        return view('newsLetters.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $newsLetter = NewsLetter::addUpdate(new NewsLetter, $request);

        $message = "News Letter added successfully";

        if ($request->is('api/*')) {

            $newsLetter = new NewsLetterResource($newsLetter);
            return $this->sendResponse(compact('newsLetter'), $message);
        }

        return redirect(route('newsLetters.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewsLetter  $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function show(NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsLetter  $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsLetter $newsLetter)
    {
        $page_title = 'News Letter';
        $clients = Client::all();
        return view('newsLetters.edit', compact('page_title', 'newsLetter', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewsLetter  $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function update(NewsLetter $newsLetter, EditRequest $request)
    {
        $newsLetter = NewsLetter::addUpdate($newsLetter, $request);

        $message = "News letter updated successfully";

        if ($request->is('api/*')) {

            $newsLetter = new NewsLetterResource($newsLetter);
            return $this->sendResponse(compact('newsLetter'), $message);
        }

        return redirect()->route('newsLetters.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsLetter  $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsLetter $newsLetter, Request $request)
    {
        $newsLetter->delete();

        $message = "News letter deleted successfully";

        if ($request->is('api/*')) {
            $newsLetter = new NewsLetterResource($newsLetter);
            return $this->sendResponse(compact('newsLetter'), $message);
        }

        return redirect()->route('newsLetters.index')->with('message', $message);
    }
}
