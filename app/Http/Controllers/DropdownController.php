<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use DB;
class DropdownController extends Controller
{
    
        public function index()
        {
            $countries = Country::with("countries")->pluck("name","id");

            return view('dropdown.index',compact('countries'));
        }

        public function getStateList(Request $request)
        {
            $states = State::with("states")
            ->where("country_id",$request->country_id)
            ->pluck("name","id");
            return response()->json($states);
        }

        public function getCityList(Request $request)
        {
            $cities = City::with("cities")
            ->where("state_id",$request->state_id)
            ->pluck("name","id");
            return response()->json($cities);
        }
}
