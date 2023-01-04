<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Hotel_apartment_requests;
use App\Models\HotelAppartment;
use App\Models\Like;
use App\Traits\ApiMessage;
use App\Traits\Oprations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    use ApiMessage;
    private $uploadPath = "uploads/notice_photo/";

    // عرض كل الفنادق الموجودة
    public function get_units()
    {
        $units = Hotel::where('type', 'unit')->with('images')->withCount('like')->orderBy('id', 'DESC')->get();
        foreach ($units as $item) {
            $item->city->state;
        }
        return $this->returnData('units', $units);
    }

    // Top 3 Hotels
    public function get_top_units()
    {
        $units = Hotel::where('type', 'unit')->with('images')->withCount('like')->orderBy('id', 'DESC')->take(3)->get();
        foreach ($units as $item) {
            $item->city->state;
            // $item->setAttribute('likes', $item->like->count());
        }
        return $this->returnData('units', $units);
    }

    // get hotel appartments by id
    public function get_unit_appartments_by_id($id)
    {
        if (Hotel::where('type', 'unit')->where('id', $id)->first()) {
            $unit_appartments = HotelAppartment::with('images', 'type_appartment', 'hotel')->withCount('like')->where('type', 'unit')->where('hotel_id', $id)->orderBy('id', 'DESC')->get();
            return $this->returnData('unit_appartments', $unit_appartments);
        } else {
            return $this->returnMessage(false, 'عفوا هذه الوحدة السكنية غير موجودة', 'Sorry, this hotel does not exist', 200);
        }
    }

    // Get appartment by id
    public function get_appartments_by_id($id)
    {
        $unit_appartments = HotelAppartment::with('images', 'type_appartment', 'hotel')->withCount('like')->where('type', 'unit')->where('id', $id)->first();
        if ($unit_appartments) {
            return $this->returnData('unit_appartments', $unit_appartments);
        } else {
            return $this->returnMessage(false, 'عفوا هذه الشقة غير موجودة', 'Sorry, this apartment does not exist', 200);
        }
    }

    // Add Like For Hotel
    public function add_like_for_unit($unit_id)
    {
        if (Hotel::where('type', 'unit')->where('id', $unit_id)->first()) {
            if (Like::where('hotel_id', $unit_id)->where('user_id', Auth::user()->id)->first()) {
                return $this->returnMessage(false, 'عفوا انت معجب فعلا بهذه الوحدة السكنية', 'Sorry, you really like this hotel', 200);
            } else {
                $like = new Like();
                $like->user_id = Auth::user()->id;
                $like->hotel_id = $unit_id;
                $like->save();
            }

            return $this->returnMessage(true, 'اعجبني', 'like', 200);
        } else {
            return $this->returnMessage(false, 'عفوا هذا الوحدة السكنية غير موجودة', 'Sorry, this hotel does not exist', 200);
        }
    }

    // Add Like For appartment
    public function add_like_for_appartment($appartment_id)
    {
        if (HotelAppartment::where('type', 'unit')->where('id', $appartment_id)->first()) {
            if (Like::where('appartment_id', $appartment_id)->where('user_id', Auth::user()->id)->first()) {
                return $this->returnMessage(false, 'عفوا انت معجب فعلا بهذه الشقة', 'Sorry, you really like this appartment', 200);
            } else {
                $like = new Like();
                $like->user_id = Auth::user()->id;
                $like->appartment_id = $appartment_id;
                $like->save();
            }

            return $this->returnMessage(true, 'اعجبني', 'like', 200);
        } else {
            return $this->returnMessage(false, 'عفوا هذه الشقة غير موجود', 'Sorry, this Appartment does not exist', 200);
        }
    }

    // حجز شقة سكنية
    public function appartment_request(Request $request, $appartment_id)
    {
        $hotel_appartmen = HotelAppartment::where('id', $appartment_id)->where('type', 'unit')->first();
        if ($hotel_appartmen) {
            $validator = Validator::make(
                $request->all(),
                [
                    'from'      => 'required|date',
                    'to'        => 'required|date',
                    'notes'     => '',
                ]
            );
            // اذا وجدت مشكلة في التحقق
            if ($validator->fails())
                return $this->returnMessage(false, $validator->errors()->all(), '', 200);

            // Date
            $to = \Carbon\Carbon::parse($request->to);
            $from = \Carbon\Carbon::parse($request->from);
            $days = $to->diffInDays($from);
            if ($from >= $to) {
                return $this->returnMessage(false, 'عفوا الرجاء تحديد التاريخ الصحيح', '', 200);
            }

            $new_request = new Hotel_apartment_requests();
            // Add by user
            $new_request->type = "unit";
            $new_request->from = $request->from;
            $new_request->to = $request->to;
            $new_request->notes = $request->notes;

            // automatic adds
            $new_request->user_id = Auth::user()->id;
            $new_request->appartment_id = $hotel_appartmen->id;
            $new_request->days = $days;

            $new_request->night_price = $hotel_appartmen->night_price;
            $new_request->discount = $hotel_appartmen->discount;
            // $new_request->status = '0';
            $new_request->total = $days * ($hotel_appartmen->night_price - $hotel_appartmen->discount);
            $new_request->save();


            $new_request->appartment->images;

            $new_request->appartment->hotel->city;
            $new_request->appartment->hotel->images;

            // $new_request['appartment'] = $new_request->appartment->hotel;


            return $this->returnData('new_request', $new_request);
        } else {
            return $this->returnMessage(false, 'عفوا هذه الشقة غير موجود', 'Sorry, this Appartment does not exist', 200);
        }
    }

    // Request Pay
    public function appartment_pay(Request $request, $appartment_id)

    {
        $appartment_request = Hotel_apartment_requests::where('id', $appartment_id)->where('type', 'unit')->first();
        if ($appartment_request) {
            if ($appartment_request->status == 2) {
                return $this->returnMessage(false, 'عفوا تم تاكيد الطلب لا يمكن الدفع مرة اخرى', 'Sorry, the request has been confirmed. You cannot pay again', 200);
            } elseif ($appartment_request->status != 1) {
                return $this->returnMessage(false, 'عفوا لايمكن الدفع حتي يتم القبول المبدئي للطلب', 'Sorry, payment cannot be made until the initial acceptance of the request', 200);
            }
            $validator = Validator::make(
                $request->all(),
                [
                    'notice_photo'      => 'required|image',
                ]
            );
            // اذا وجدت مشكلة في التحقق
            if ($validator->fails())
                return $this->returnMessage(false, $validator->errors()->all(), '', 200);


            // For Photo
            $formFileName = "notice_photo";
            $fileFinalName = "";
            if ($request->$formFileName != "") {
                // Delete file if there is a new one
                if ($appartment_request->$formFileName) {
                    File::delete($this->uploadPath . $appartment_request->notice_photo);
                }
                $fileFinalName = time() . rand(
                    1111,
                    9999
                ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file($formFileName)->move($path, $fileFinalName);
            }

            if ($fileFinalName != "") {
                $appartment_request->$formFileName = $fileFinalName;
            }
            // For Photo

            $appartment_request->save();

            // $new_request['appartment'] = $new_request->appartment;
            return $this->returnMessage(true, 'تم رفع الاشعار ', 'Notice has been raised', 200);

            // return $this->returnData('appartment_request', $appartment_request);
        } else {
            return $this->returnMessage(false, 'عفوا لا يوجد حجز حاليا ', 'Sorry, there are currently no Request', 200);
        }
    }
}