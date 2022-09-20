<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\EditRequest;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Exports\ProductExport;
use Excel;
use PDF;
use App\Models\Client;

class ProductController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Products';

        $products = Product::with(['creater'])->pimp()->paginate();

        $message = "All Records";

        if ($request->is('api/*')) {
            $products = ProductResource::collection($products);
            return $this->sendResponse(compact('page_title', 'products'), $message);
        }

        return view('product.index', compact('page_title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Products';
        $page_description = 'Create your Product';
        $brands = Brand::all();
        $clients = Client::all();
        return view('product.create', compact('page_title', 'brands', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $product = Product::createUpdate(new Product, $request);

        $message = "Product added successfully";

        if ($request->is('api/*')) {

            $product = new ProductResource($product);
            return $this->sendResponse(compact('product'), $message);
        }

        return redirect(route('products.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $page_title = 'Product';
        $brands = Brand::all();
        $clients = Client::all();
        return view('product.edit', compact('page_title', 'product', 'brands', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Product $product)
    {
        $product = Product::createUpdate($product, $request);

        $message = "Product updated successfully";

        if ($request->is('api/*')) {
            $product = new ProductResource($product);
            return $this->sendResponse(compact('product'), $message);
        }

        return redirect(route('products.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        $product->delete();

        $message = "Product deleted successfully";

        if ($request->is('api/*')) {
            $product = new ProductResource($product);
            return $this->sendResponse(compact('product'), $message);
        }

        return redirect(route('products.index'))->with('message', $message);
    }


    public function export(Request $request)
    {
        switch ($request->type) {
            case 'csv':
                return Excel::download(new ProductExport, 'products.csv');
                break;
            case 'excel':
                return Excel::download(new ProductExport, 'products.xlsx');
                break;
            case 'pdf':
                echo "PDF logic here..";
                break;
            default:
                echo "Invalid Type";
                exit;
        }
    }

    public function generatePDF()
    {
        $products = Product::all();

        $products = view()->share('product.index', compact('products'));

        $pdf = PDF::loadView('product', $products);

        return $pdf->download('products.pdf');
    }
}
