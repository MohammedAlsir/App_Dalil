<?php

namespace App\Http\Controllers;

use App\Models\CarRequest;
use App\Models\Hotel_apartment_requests;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    //  All hotel Appartment Request
    public function hotel_appartment_request()
    {
        $index = 1;
        $apprtment_request = Hotel_apartment_requests::where('type', 'hotel')->orderBy('id', 'DESC')->get();
        return view('hotels.appartments.requests.index', compact('apprtment_request', 'index'));
    }

    // for unit appartment Request
    public function unit_appartments_request()
    {
        $index = 1;
        $unit_apprtment_request = Hotel_apartment_requests::where('type', 'unit')->orderBy('id', 'DESC')->get();
        return view('units.appartments.requests.index', compact('unit_apprtment_request', 'index'));
    }

    public function car_request()
    {
        $index = 1;
        $car_request = CarRequest::orderBy('id', 'DESC')->get();
        return view('cars.requests.index', compact('car_request', 'index'));
    }
}
