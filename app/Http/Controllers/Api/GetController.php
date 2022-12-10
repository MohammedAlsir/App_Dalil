<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Hotel;
use App\Models\State;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;

class GetController extends Controller
{
    use ApiMessage;

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
        $hotels = Hotel::where('city_id', $city_id)->orderBy('id', 'DESC')->get();
        foreach ($hotels as $item) {
            $item->city->state;
            $item->setAttribute('likes', $item->like->count());
        }
        return $this->returnData('hotels', $hotels);
    }
}