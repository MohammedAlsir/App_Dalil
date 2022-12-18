<?php

namespace App\Http\Controllers;

use App\Models\Hotel_apartment_requests;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    //  All Appartment Request
    public function appartment_request()
    {
        $index = 1;
        $apprtment_request = Hotel_apartment_requests::orderBy('id', 'DESC')->get();
        return view('hotels.appartments.requests.index', compact('apprtment_request', 'index'));
    }
}
