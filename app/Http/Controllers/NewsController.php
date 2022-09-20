<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Http\Resources\NewsResource;
use App\Models\Client;

class NewsController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(News::class, 'news');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'News';

        $News = News::with(['creater'])->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {
            $news = NewsResource::collection($News);
            return $this->sendResponse(compact('page_title', 'News'), $message);
        }
        return view('news.index', compact('page_title', 'News'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'News';
        $page_description = 'Create your news';
        $clients = Client::all();
        return view('news.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $news = News::addUpdatenews(new News, $request);

        $message = "News added successfully";

        if ($request->is('api/*')) {

            $news = new NewsResource($news);
            return $this->sendResponse(compact('news'), $message);
        }

        return redirect(route('news.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $page_title = 'News';
        $clients = Client::all();
        return view('news.edit', compact('page_title', 'news', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, News $news)
    {
        $news = News::addUpdatenews($news, $request);

        $message = "News updated successfully";

        if ($request->is('api/*')) {

            $news = new NewsResource($news);
            return $this->sendResponse(compact('news'), $message);
        }

        return redirect()->route('news.index')->with('message', $message);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news, Request $request)
    {
        $news->delete();

        $message = "News deleted successfully";

        if ($request->is('api/*')) {
            $news = new NewsResource($news);
            return $this->sendResponse(compact('news'), $message);
        }

        return redirect()->route('news.index')->with('message', $message);
    }
}
