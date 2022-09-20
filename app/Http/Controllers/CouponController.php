<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Auth;
use App\Http\Requests\Coupon\CreateRequest;
use App\Http\Requests\Coupon\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CouponResource;
use App\Models\Client;

class CouponController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Coupon::class, 'coupon');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Coupons';

        $coupons = Coupon::with(['creater'])->pimp()->paginate();

        if ($request->is('api/*')) {

            $coupons = CouponResource::collection($coupons);
            return $this->sendResponse(compact('coupons'), "All Record");
        }

        return view('coupons.index', compact('coupons', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Coupons';
        $clients = Client::all();
        return view('coupons.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $coupon = Coupon::createUpdate(new Coupon, $request);

        $message = "Coupon added successfully";

        if ($request->is('api/*')) {

            $coupon = new CouponResource($coupon);
            return $this->sendResponse(compact('coupon'), $message);
        }

        return redirect(route('coupons.index'))->with('message', $message);;
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
    public function edit(Coupon $coupon)
    {
        $page_title = 'Coupons';
        $clients = Client::all();
        return view('coupons.edit', compact('coupon', 'page_title', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Coupon $coupon)
    {
        $coupon = Coupon::createUpdate($coupon, $request);

        $message = "Coupon updated successfully";

        if ($request->is('api/*')) {

            $coupon = new CouponResource($coupon);
            return $this->sendResponse(compact('coupon'), $message);
        }

        return redirect(route('coupons.index'))->with('message', $message);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon, Request $request)
    {
        $coupon->delete();

        $message = "Coupon deleted successfully";

        if ($request->is('api/*')) {

            $coupon = new CouponResource($coupon);
            return $this->sendResponse(compact('coupon'), $message);
        }

        return redirect()->route('coupons.index')->with('message', $message);;
    }
}
