<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelAppartment;
use App\Traits\ApiMessage;
use App\Traits\Oprations;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    use ApiMessage;
    // عرض كل الفنادق الموجودة
    public function get_hotel()
    {
        $hotels = Hotel::orderBy('id', 'DESC')->get();
        foreach ($hotels as $item) {
            $item->city->state;
        }
        return $this->returnData('hotels', $hotels);
    }

    // Top 3 Hotels
    public function get_top_hotel()
    {
        $hotels = Hotel::orderBy('stars', 'DESC')->take(3)->get();
        foreach ($hotels as $item) {
            $item->city->state;
        }
        return $this->returnData('hotels', $hotels);
    }

    // get_hotel_appartments_by_id
    public function get_hotel_appartments_by_id($id)
    {
        if (Hotel::find($id)) {
            $appartments = HotelAppartment::where('hotel_id', $id)->orderBy('id', 'DESC')->get();
            return $this->returnData('appartments', $appartments);
        } else {
            return $this->returnMessage('error', 'عفوا هذا الفندق غير موجود', 200);
        }
    }

    // Get appartment by id
    public function get_appartments_by_id($id)
    {
        $appartment = HotelAppartment::find($id);
        if ($appartment) {
            return $this->returnData('appartment', $appartment);
        } else {
            return $this->returnMessage('error', 'عفوا هذه الشقة غير موجودة', 200);
        }
    }
}