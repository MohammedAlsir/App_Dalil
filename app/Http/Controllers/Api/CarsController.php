<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarRequest;
use App\Models\Like;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CarsController extends Controller
{
    private $uploadPath = "uploads/notice_photo/";

    use ApiMessage;
    public function get_cars(Request $request)
    {
        $cars = Car::with('image');
        if ($request->type)
            $cars->where('type', $request->type);
        if ($request->motion_vector)
            $cars->where('motion_vector', $request->motion_vector);
        if ($request->number_of_passengers)
            $cars->where('number_of_passengers', $request->number_of_passengers);
        if ($request->price_from && $request->price_to)
            $cars->whereBetween('day_price', [$request->price_from, $request->price_to]);

        return $this->returnData('cars', $cars->orderBy('id', 'DESC')->get());
    }

    // Add Like For car
    public function add_like_for_car($car_id)
    {
        if (Car::find($car_id)) {
            if (Like::where('car_id', $car_id)->where('user_id', Auth::user()->id)->first()) {
                return $this->returnMessage(false, 'عفوا انت معجب فعلا بهذه السيارة', 'Sorry, you really like this a car', 200);
            } else {
                $like = new Like();
                $like->user_id = Auth::user()->id;
                $like->car_id = $car_id;
                $like->save();
            }

            return $this->returnMessage(true, 'اعجبني', 'like', 200);
        } else {
            return $this->returnMessage(false, 'عفوا هذه السيارة غير موجود', 'Sorry, this a Car does not exist', 200);
        }
    }

    // حجز  سيارة
    public function car_request(Request $request, $car_id)
    {
        $car = Car::find($car_id);
        if ($car) {
            $validator = Validator::make(
                $request->all(),
                [
                    'from'      => 'required|date',
                    'to'        => 'required|date',
                    'notes'     => '',
                    'driver_price'     => '',
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

            $new_request = new CarRequest();
            // Add by user
            $new_request->from = $request->from;
            $new_request->to = $request->to;
            $new_request->notes = $request->notes;

            // automatic adds
            $new_request->user_id = Auth::user()->id;
            $new_request->car_id = $car->id;
            $new_request->days = $days;
            $new_request->day_price = $car->day_price;
            if ($request->driver_price)
                $new_request->driver_price = $car->driver_price;

            // $new_request->discount = $hotel_appartmen->discount;
            // $new_request->status = '0';
            if ($request->driver_price && $request->driver_price == 1) {
                $new_request->total = $days * ($car->day_price + $car->driver_price);
            } else {
                $new_request->total = $days * ($car->day_price);
            }
            $new_request->save();

            $new_request->car;

            return $this->returnData('new_request', $new_request);
        } else {
            return $this->returnMessage(false, 'عفوا هذه السيارة غير موجود', 'Sorry, this a car does not exist', 200);
        }
    }


    // Request Pay
    public function car_pay(Request $request, $car_id)

    {
        $car_request = CarRequest::find($car_id);
        if ($car_request) {
            if ($car_request->status == 2) {
                return $this->returnMessage(false, 'عفوا تم تاكيد الطلب لا يمكن الدفع مرة اخرى', 'Sorry, the request has been confirmed. You cannot pay again', 200);
            } elseif ($car_request->status != 1) {
                return $this->returnMessage(false, 'عفوا لايمكن الدفع حتي يتم القبول المبدئي للطلب', 'Sorry, payment cannot be made until the initial acceptance of the request', 200);
            }
            $validator = Validator::make(
                $request->all(),
                [
                    'notice_photo'      => 'required|image',
                    'payment_method'     => 'required|in:cash,bank',
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
                if ($car_request->$formFileName) {
                    File::delete($this->uploadPath . $car_request->notice_photo);
                }
                $fileFinalName = time() . rand(
                    1111,
                    9999
                ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file($formFileName)->move($path, $fileFinalName);
            }

            if ($fileFinalName != "") {
                $car_request->$formFileName = $fileFinalName;
            }
            // For Photo

            $car_request->payment_method = $request->payment_method;
            $car_request->save();

            // $new_request['appartment'] = $new_request->appartment;
            return $this->returnMessage(true, 'تم رفع الاشعار ', 'Notice has been raised', 200);

            // return $this->returnData('appartment_request', $appartment_request);
        } else {
            return $this->returnMessage(false, 'عفوا لا يوجد حجز حاليا ', 'Sorry, there are currently no Request', 200);
        }
    }
}