<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Brand\CreateRequest;
use App\Http\Requests\Brand\EditRequest;
use App\Http\Requests\Brand\CsvRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Excel;
use App\Imports\BrandImport;
use App\Models\Client;

class BrandController extends BaseController
{
    
    public function __construct()
    {
        $this->authorizeResource(Brand::class, 'brand');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Brands';

        $brands = Brand::with(['creater'])->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {
            $brands = BrandResource::collection($brands);
            return $this->sendResponse(compact('page_title', 'brands'), $message);
        }

        return view('Brand.index', compact('page_title', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Brands';
        $page_description = 'Create your Brand';
        $clients = Client::all();
        return view('Brand.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CreateRequest $request)
    {
        $brand = Brand::addUpdatedBrands(new Brand, $request);

        $message = "Brand added successfully";

        if ($request->is('api/*')) {

            $brand = new BrandResource($brand);
            return $this->sendResponse(compact('brand'), $message);
        }
        return redirect(route('brands.index'))->with('message', $message);
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


    public function edit(Brand $brand)
    {
        $page_title = 'Brand';

        $clients = Client::all();

        return view('Brand.edit', compact('page_title', 'brand', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Brand $brand)
    {
        $brand = Brand::addUpdatedBrands($brand, $request);

        $message = "Brand updated successfully";

        if ($request->is('api/*')) {
            // dd($brand);
            $brand = new BrandResource($brand);
            return $this->sendResponse(compact('brand'), $message);
        }
        return redirect()->route('brands.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand, Request $request)
    {
        //
        $brand->delete();

        $message = "Brand deleted successfully";

        if ($request->is('api/*')) {
            $brand = new BrandResource($brand);
            return $this->sendResponse(compact('brand'), $message);
        }
        return redirect()->route('brands.index')->with('message', $message);
    }
    public function importcsv()
    {
        return view('Brand.importcsv');
    }

    public function import(Brand $brand, CsvRequest $request)
    {
        Excel::import(new BrandImport, $request->file);

        $message = "Record are imported successfully";

        return redirect()->route('brands.index')->with('message', $message);
    }
}
