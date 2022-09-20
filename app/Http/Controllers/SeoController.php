<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use Illuminate\Http\Request;
use App\Http\Requests\Seo\CreateRequest;
use App\Http\Requests\Seo\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\SeoResource;

class SeoController extends BaseController
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
    public function index(Request $request)
    {
        $page_title = 'SEO';

        $Seo = Seo::with(['creater'])->pimp()->paginate();

       if ($request->is('api/*')) {

            $seos= SeoResource::collection($Seo);
            return $this->sendResponse(compact('Seo'), "All Record");
        }

        return view('seo.index', compact('page_title', 'Seo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'SEO';
        $page_description = 'Create SEO';
        return view('seo.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $seo = Seo::addUpdate(new Seo, $request);

        $message = "SEO added successfully";

        if ($request->is('api/*')) {

            $seo = new SeoResource($seo);
            return $this->sendResponse(compact('seo'), $message);
        }

        return redirect(route('seo.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function show(Seo $seo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function edit(Seo $seo)
    {
        $page_title = 'SEO';
        return view('seo.edit', compact('page_title', 'seo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Seo $seo)
    {
        $seo = Seo::addUpdate($seo, $request);

        $message = "SEO updated successfully";

        if ($request->is('api/*')) {

            $tax = new SeoResource($seo);
            return $this->sendResponse(compact('seo'), $message);
        }

        return redirect()->route('seo.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seo $seo, Request $request)
    {
        $seo->delete();

        $message = "SEO deleted successfully";

        if ($request->is('api/*')) {

            $seo = new SeoResource($seo);
            return $this->sendResponse(compact('seo'), $message);
        }

        return redirect()->route('seo.index')->with('message', $message);
    }
}
