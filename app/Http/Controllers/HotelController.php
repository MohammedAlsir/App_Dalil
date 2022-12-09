<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HotelController extends Controller
{
    private $uploadPath = "uploads/hotels/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::orderBy('id', 'DESC')->get();
        $index = 1;
        return view('hotels.index', compact('hotels', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotels.create');
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
            // 'photo' => 'image',

        ]);
        $hotel = new Hotel();
        $hotel->name_ar = $request->name_ar;
        $hotel->name_en = $request->name_en;
        $hotel->city_id = $request->city;
        $hotel->stars = $request->stars;
        $hotel->features_ar = $request->features_ar;
        $hotel->features_en = $request->features_en;

        $hotel->location_ar = $request->location_ar;
        $hotel->location_en = $request->location_en;
        $hotel->save();

        // For Photo
        foreach ($request->file('photo') as $imagefile) {
            $image = new Image();
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $imagefile->file('photo')->getClientOriginalExtension();
            $path = $this->uploadPath;
            $imagefile->file('photo')->move($path, $fileFinalName);
            $image->photo = $fileFinalName;
            $image->save();
        }



        // For Photo


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
        return view('hotels.show', compact('hotel', 'index'));
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
        return view('hotels.edit', compact('hotel'));
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
            'photo' => 'max:3', // checks length of array
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'location_ar' => '',
            // 'location_en' => ''
        ], [
            'photo.max' => 'عدد الصور اكثر من العدد المحدد'
        ]);
        $hotel =  Hotel::find($id);
        $hotel->name_ar = $request->name_ar;
        $hotel->name_en = $request->name_en;
        $hotel->city_id = $request->city;
        $hotel->stars = $request->stars;
        $hotel->features_ar = $request->features_ar;
        $hotel->features_en = $request->features_en;

        $hotel->location_ar = $request->location_ar;
        $hotel->location_en = $request->location_en;
        $hotel->save();

        // For Photo
        $image_count = Image::where('hotel_id', $id)->count();
        if ($image_count >= 3) {
            toastr()->error('الفندق لدية 3 صور سابقة لايمكن اضافة المزيد', 'خطأ');
            return redirect()->back();
        } else {
            foreach ($request->file('photo') as $index => $imagefile) {
                $image = new Image();
                $fileFinalName = time() . rand(
                    1111,
                    9999
                ) . '.' . $request->file('photo')[$index]->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file('photo')[$index]->move($path, $fileFinalName);
                $image->photo = $fileFinalName;
                $image->hotel_id = $hotel->id;
                $image->save();
            }
        }


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