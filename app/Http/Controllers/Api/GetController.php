<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarRequest;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Hotel_apartment_requests;
use App\Models\Setting;
use App\Models\State;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GetController extends Controller
{
    use ApiMessage;

    public function get_data() // Get All State
    {
        $data = Setting::where('id', 1)->get();
        return $this->returnData('data', $data);
    }

    public function get_state() // Get All State
    {
        $states = State::orderBy('id', 'DESC')->get();
        return $this->returnData('states', $states);
    }

    public function get_cities($state_id) // Get All cities by state id
    {
        $cities = City::where('state_id', $state_id)->orderBy('id', 'DESC')->get();
        return $this->returnData('cities', $cities);
    }

    public function get_hotels($city_id) // Get All hotels by city id
    {
        $hotels = Hotel::with('images')->withCount('like')->where('type', 'hotel')->where('city_id', $city_id)->orderBy('id', 'DESC')->get();
        foreach ($hotels as $item) {
            $item->city->state;
            // $item->setAttribute('likes', $item->like->count());
        }
        return $this->returnData('hotels', $hotels);
    }

    public function get_units($city_id) // Get All units by city id
    {
        $units = Hotel::with('images')->withCount('like')->where('type', 'unit')->where('city_id', $city_id)->orderBy('id', 'DESC')->get();
        foreach ($units as $item) {
            $item->city->state;
            // $item->setAttribute('likes', $item->like->count());
        }
        return $this->returnData('units', $units);
    }

    public function get_request(Request $request) // Get All units by city id
    {
        $validator = Validator::make(
            $request->all(),
            [
                'type'      => 'required',
            ]
        );
        if ($validator->fails())
            return $this->returnMessage(false, $validator->errors()->all(), '', 200);
        $all_requests = Hotel_apartment_requests::with('appartment')->where('user_id', Auth::user()->id)->where('type', $request->type);
        if ($request->status != "")
            $all_requests->where('status', $request->status);

        $format_request = $all_requests->orderBy('id', 'DESC')->get();


        foreach ($format_request as $item) {
            $item->appartment->images;
            $item->appartment->type_appartment;
            $item->appartment->hotel->city->state;
            $item->appartment->hotel->images;
        }
        return $this->returnData('all_requests', $format_request);
    }


    public function get_request_car(Request $request) // Get All units by city id
    {
        $all_requests = CarRequest::with('car')->where('user_id', Auth::user()->id);
        if ($request->status != "")
            $all_requests->where('status', $request->status);

        $format_request = $all_requests->orderBy('id', 'DESC')->get();


        foreach ($format_request as $item) {
            $item->car->image;
        }



        return $this->returnData('all_requests', $format_request);
    }
}