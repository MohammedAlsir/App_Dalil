<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelAppartment;
use App\Models\Like;
use App\Traits\ApiMessage;
use App\Traits\Oprations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    use ApiMessage;
    // عرض كل الفنادق الموجودة
    public function get_hotel()
    {
        $hotels = Hotel::with('images')->orderBy('id', 'DESC')->get();
        foreach ($hotels as $item) {
            $item->city->state;
        }
        return $this->returnData('hotels', $hotels);


        // $hotels = Hotel::withCount('like')->orderBy('id', 'DESC')->get();
        // $hotels = Hotel::orderBy('id', 'DESC')->get();
        // foreach ($hotels as $item) {
        //     // $item->city->state;
        //     $item->liked->count();
        //     // foreach ($item->like_2 as $status) {
        //     //     if ($status->user_id == Auth::user()->id) {
        //     // $item->setAttribute('liked', '');
        //     // } else {
        //     //     $item->setAttribute('sssss', "false");
        //     // }
        //     // }
        // }
        // return $this->returnData('hotels', $hotels);
        // if (auth()->check())
        //     return Auth::user()->name;
        // else
        //     return "false";
    }

    // Top 3 Hotels
    public function get_top_hotel()
    {
        $hotels = Hotel::with('images')->orderBy('stars', 'DESC')->take(3)->get();
        foreach ($hotels as $item) {
            $item->city->state;
            // $item->setAttribute('likes', $item->like->count());
        }
        return $this->returnData('hotels', $hotels);
    }

    // get hotel appartments by id
    public function get_hotel_appartments_by_id($id)
    {
        if (Hotel::find($id)) {
            $appartments = HotelAppartment::with('images')->where('hotel_id', $id)->orderBy('id', 'DESC')->get();
            return $this->returnData('appartments', $appartments);
        } else {
            return $this->returnMessage('error', 'عفوا هذا الفندق غير موجود', 'Sorry, this hotel does not exist', 200);
        }
    }

    // Get appartment by id
    public function get_appartments_by_id($id)
    {
        $appartment = HotelAppartment::with('images')->find($id);
        if ($appartment) {
            return $this->returnData('appartment', $appartment);
        } else {
            return $this->returnMessage('error', 'عفوا هذه الشقة غير موجودة', 'Sorry, this apartment does not exist', 200);
        }
    }

    // Add Like For Hotel
    public function add_like_for_hotel($hotel_id)
    {
        if (Hotel::find($hotel_id)) {
            if (Like::where('hotel_id', $hotel_id)->where('user_id', Auth::user()->id)->first()) {
                return $this->returnMessage('error', 'عفوا انت معجب فعلا بهذا الفندق', 'Sorry, you really like this hotel', 200);
            } else {
                $like = new Like();
                $like->user_id = Auth::user()->id;
                $like->hotel_id = $hotel_id;
                $like->save();
            }

            return $this->returnMessage(true, 'اعجبني', 'like', 200);
        } else {
            return $this->returnMessage('error', 'عفوا هذا الفندق غير موجود', 'Sorry, this hotel does not exist', 200);
        }
    }

    // Add Like For appartment
    public function add_like_for_appartment($appartment_id)
    {
        if (HotelAppartment::find($appartment_id)) {
            if (Like::where('appartment_id', $appartment_id)->where('user_id', Auth::user()->id)->first()) {
                return $this->returnMessage('error', 'عفوا انت معجب فعلا بهذه الشقة', 'Sorry, you really like this appartment', 200);
            } else {
                $like = new Like();
                $like->user_id = Auth::user()->id;
                $like->appartment_id = $appartment_id;
                $like->save();
            }

            return $this->returnMessage(true, 'اعجبني', 'like', 200);
        } else {
            return $this->returnMessage('error', 'عفوا هذه الشقة غير موجود', 'Sorry, this Appartment does not exist', 200);
        }
    }
}