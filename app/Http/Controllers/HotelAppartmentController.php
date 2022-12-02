<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelAppartment;
use App\Models\TypeAppartment;
use Illuminate\Http\Request;

class HotelAppartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel_appartment  = HotelAppartment::orderBy('id', 'DESC')->get();
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
        $hotels = Hotel::orderBy('id', 'DESC')->get();
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
        ]);
        $hotel_appartment = new HotelAppartment();
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
        $hotels = Hotel::orderBy('id', 'DESC')->get();
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

        toastr()->info('تم تعديل بيانات الشقة الفندقية ', 'نجاح');
        return redirect()->route('appartment.index');
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