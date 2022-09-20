<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests\Language\CreateRequest;
use App\Http\Requests\Language\EditRequest;
use App\Http\Resources\LanguageResource;
use App\Http\Controllers\Api\BaseController;
use App\Models\Client;

class LanguageController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Language::class, 'language');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Language $language)
    {
        $page_title = 'Languages';

        $languages = $language->pimp()->paginate();

        if ($request->is('api/*')) {

            $languages = LanguageResource::collection($languages);
            return $this->sendResponse(compact('languages'), "All Record");
        }

        return view('languages.index', compact('page_title', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Languages';
        $clients = Client::all();
        return view('languages.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $language = Language::addUpdate(new Language, $request);

        $message = "Language added successfully";

        if ($request->is('api/*')) {

            $language = new LanguageResource($language);
            return $this->sendResponse(compact('language'), $message);
        }

        return redirect(route('languages.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        $page_title = 'Languages';
        $clients = Client::all();
        return view('languages.edit', compact('page_title', 'language', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Language $language)
    {
        $language = Language::addUpdate($language, $request);

        $message = "Language updated successfully";

        if ($request->is('api/*')) {

            $language = new LanguageResource($language);
            return $this->sendResponse(compact('language'), $message);
        }

        return redirect()->route('languages.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language, Request $request)
    {
        $language->delete();

        $message = "Language deleted successfully";

        if ($request->is('api/*')) {

            $language = new LanguageResource($language);
            return $this->sendResponse(compact('language'), $message);
        }

        return redirect()->route('languages.index')->with('message', $message);
    }
}
