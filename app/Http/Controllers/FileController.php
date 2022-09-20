<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Requests\File\CreateRequest;
use App\Http\Requests\File\EditRequest;
use App\Http\Resources\FileResource;
use App\Models\Brand;

class FileController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(File::class, 'file');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Brand $brand, File $file, Request $request)
    {

        $page_title = 'Files - ' . $brand->name;

        $files = File::whereHas('brand', function ($query) use ($brand) {
            $query->where('id',  $brand->id);
            return $query;
        })->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {

            $file = FileResource::collection($files);
            return $this->sendResponse(compact('page_title', 'brand', 'file'), $message);
        }

        return view('files.index', compact('page_title', 'files', 'brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create(Brand $brand, File $file)
    {
        $page_title = 'Files - ' . $brand->name;
        return view('files.create', compact('brand', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Brand $brand, File $file, CreateRequest $request)
    {

        $file = File::createUpdate($brand, $file, $request);

        $message = "File added successfully";

        if ($request->is('api/*')) {
            // dd($file);
            $file = new FileResource($file);
            return $this->sendResponse(compact('file'), $message);
        }

        return redirect(route('files.index', $brand->id))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand, File $file)
    {
        $page_title = 'Files - ' . $brand->name;
        return view('files.edit', compact('brand', 'file', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Brand $brand, File $file, EditRequest $request)
    {
        $files = File::createUpdate($brand, $file, $request);

        $message = "File updated successfully";

        if ($request->is('api/*')) {

            $files = new FileResource($files);
            return $this->sendResponse(compact('files'), $message);
        }

        return redirect(route('files.index', [$brand->id]))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand, File $file, Request $request)
    {
        $file->delete();

        $message = "File deleted successfully";

        if ($request->is('api/*')) {
            $file = new FileResource($file);
            return $this->sendResponse(compact('file'), $message);
        }

        return redirect(route('files.index', $brand->id))->with('message', $message);
    }
}
