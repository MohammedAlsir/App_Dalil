<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelAppartment;
use App\Models\Image;
use App\Models\TypeAppartment;
use Illuminate\Http\Request;

class HotelAppartmentController extends Controller
{
    private $uploadPath = "uploads/hotels/appartments";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel_appartment  = HotelAppartment::where('type', 'hotel')->orderBy('id', 'DESC')->get();
        $index = 1;
        return view('hotels.appartments.index', compact('hotel_appartment', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotels = Hotel::where('type', 'hotel')->orderBy('id', 'DESC')->get();
        $types = TypeAppartment::orderBy('id', 'DESC')->get();

        return view('hotels.appartments.create', compact('hotels', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'hotel' => 'required',
            'type' => 'required',
            'night_price' => 'required',
            'photo' => 'max:3', // checks length of array
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'photo.max' => 'عدد الصور اكثر من العدد المحدد'
        ]);
        $hotel_appartment = new HotelAppartment();
        $hotel_appartment->type = "hotel";

        // Is Required
        $hotel_appartment->name_ar = $request->name_ar;
        $hotel_appartment->name_en = $request->name_en;
        $hotel_appartment->hotel_id = $request->hotel;
        $hotel_appartment->type_appartment_id = $request->type;
        $hotel_appartment->night_price = $request->night_price;
        // Is Not Required
        $hotel_appartment->features_ar = $request->features_ar;
        $hotel_appartment->features_en = $request->features_en;
        $hotel_appartment->floor_ar = $request->floor_ar;
        $hotel_appartment->floor_en = $request->floor_en;
        $hotel_appartment->number_of_rooms = $request->number_of_rooms;
        $hotel_appartment->discount = $request->discount;
        $hotel_appartment->save();

        // For Photo
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $index => $imagefile) {
                $image = new Image();
                $fileFinalName = time() . rand(
                    1111,
                    9999
                ) . '.' . $request->file('photo')[$index]->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file('photo')[$index]->move($path, $fileFinalName);
                $image->photo = $fileFinalName;
                $image->appartment_id = $hotel_appartment->id;
                $image->save();
            }
        }
        // For Photo

        toastr()->info('تم اضافة الشقة الفندقية ', 'نجاح');
        return redirect()->route('appartment.index');
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
    public function edit($id)
    {
        $hotels = Hotel::where('type', 'hotel')->orderBy('id', 'DESC')->get();
        $types = TypeAppartment::orderBy('id', 'DESC')->get();
        $appartment = HotelAppartment::find($id);
        return view('hotels.appartments.edit', compact('hotels', 'types', 'appartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'hotel' => 'required',
            'type' => 'required',
            'night_price' => 'required',
            'photo' => 'max:3', // checks length of array
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'location_ar' => '',
            // 'location_en' => ''
        ], [
            'photo.max' => 'عدد الصور اكثر من العدد المحدد'
        ]);
        $hotel_appartment =  HotelAppartment::find($id);
        // Is Required
        $hotel_appartment->name_ar = $request->name_ar;
        $hotel_appartment->name_en = $request->name_en;
        $hotel_appartment->hotel_id = $request->hotel;
        $hotel_appartment->type_appartment_id = $request->type;
        $hotel_appartment->night_price = $request->night_price;
        // Is Not Required
        $hotel_appartment->features_ar = $request->features_ar;
        $hotel_appartment->features_en = $request->features_en;
        $hotel_appartment->floor_ar = $request->floor_ar;
        $hotel_appartment->floor_en = $request->floor_en;
        $hotel_appartment->number_of_rooms = $request->number_of_rooms;
        $hotel_appartment->discount = $request->discount;
        $hotel_appartment->save();

        // For Photo
        $image_count = Image::where('appartment_id', $id)->count();
        if ($image_count >= 3) {
            toastr()->error('الشقة لديها 3 صور سابقة لايمكن اضافة المزيد احذف بعض الصور السابقة اولا', 'خطأ');
            return redirect()->back();
        }

        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $index => $imagefile) {
                $image = new Image();
                $fileFinalName = time() . rand(
                    1111,
                    9999
                ) . '.' . $request->file('photo')[$index]->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file('photo')[$index]->move($path, $fileFinalName);
                $image->photo = $fileFinalName;
                $image->appartment_id = $hotel_appartment->id;
                $image->save();
            }
        }


        toastr()->info('تم تعديل بيانات الشقة الفندقية ', 'نجاح');
        // return redirect()->route('appartment.index');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HotelAppartment::find($id)->delete();
        toastr()->info('تم حذف الشقة الفندقية ', 'نجاح');
        return redirect()->route('appartment.index');
    }
}