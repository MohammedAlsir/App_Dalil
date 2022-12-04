<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::orderBy('id', 'DESC')->get();
        $index = 1;
        return view('Hotels.index', compact('hotels', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Hotels.create');
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
            'state' => 'required',
            'city' => 'required',
            'stars' => 'required',
        ]);
        $hotel = new Hotel();
        $hotel->name_ar = $request->name_ar;
        $hotel->name_en = $request->name_en;
        $hotel->city_id = $request->city;
        $hotel->location = $request->location;
        $hotel->stars = $request->stars;
        $hotel->features_ar = $request->features_ar;
        $hotel->features_en = $request->features_en;
        $hotel->save();

        toastr()->info('تم اضافة الفندق ', 'نجاح');
        return redirect()->route('hotels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel = Hotel::find($id);
        $index = 1;
        return view('Hotels.show', compact('hotel', 'index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::find($id);
        return view('Hotels.edit', compact('hotel'));
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
            'state' => 'required',
            'city' => 'required',
            'stars' => 'required',
        ]);
        $hotel =  Hotel::find($id);
        $hotel->name_ar = $request->name_ar;
        $hotel->name_en = $request->name_en;
        $hotel->city_id = $request->city;
        $hotel->location = $request->location;
        $hotel->stars = $request->stars;
        $hotel->features_ar = $request->features_ar;
        $hotel->features_en = $request->features_en;
        $hotel->save();

        toastr()->info('تم تعديل بيانات الفندق ', 'نجاح');
        return redirect()->route('hotels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel =  Hotel::find($id);
        if ($hotel->appartment->count() > 0) {
            toastr()->error('هذا الفندق يحتوي على شقق قم بحذف الشقق اولا', 'خطأ');
            return redirect()->route('hotels.index');
        } else {
            $hotel->delete();
            toastr()->info('تم حذف الفندق ', 'نجاح');
            return redirect()->route('hotels.index');
        }
    }
}
