<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Image;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    private $uploadPath = "uploads/hotels/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Hotel::where('type', 'unit')->orderBy('id', 'DESC')->get();
        $index = 1;
        return view('units.index', compact('units', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('units.create');
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
            'photo' => 'max:3', // checks length of array
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ], [
            'photo.max' => 'عدد الصور اكثر من العدد المحدد'
        ]);
        $unit = new Hotel();
        $unit->type = 'unit';
        $unit->name_ar = $request->name_ar;
        $unit->name_en = $request->name_en;
        $unit->city_id = $request->city;
        $unit->features_ar = $request->features_ar;
        $unit->features_en = $request->features_en;

        $unit->location_ar = $request->location_ar;
        $unit->location_en = $request->location_en;
        $unit->save();

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
                $image->hotel_id = $unit->id;
                $image->save();
            }
        }
        // For Photo


        toastr()->info('تم اضافة الوحدة السكنية ', 'نجاح');
        return redirect()->route('units.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Hotel::find($id);
        $index = 1;
        return view('units.show', compact('unit', 'index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Hotel::find($id);
        return view('units.edit', compact('unit'));
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
            // 'stars' => 'required',
            'photo' => 'max:3', // checks length of array
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'location_ar' => '',
            // 'location_en' => ''
        ], [
            'photo.max' => 'عدد الصور اكثر من العدد المحدد'
        ]);
        $unit =  Hotel::find($id);
        $unit->name_ar = $request->name_ar;
        $unit->name_en = $request->name_en;
        $unit->city_id = $request->city;
        $unit->stars = $request->stars;
        $unit->features_ar = $request->features_ar;
        $unit->features_en = $request->features_en;

        $unit->location_ar = $request->location_ar;
        $unit->location_en = $request->location_en;
        $unit->save();

        // For Photo
        $image_count = Image::where('hotel_id', $id)->count();


        if ($request->hasFile('photo')) {
            if ($image_count >= 3) {
                toastr()->error('الفندق لدية 3 صور سابقة لايمكن اضافة المزيد احذف بعض الصور السابقة اولا', 'خطأ');
                return redirect()->back();
            }
            foreach ($request->file('photo') as $index => $imagefile) {
                $image = new Image();
                $fileFinalName = time() . rand(
                    1111,
                    9999
                ) . '.' . $request->file('photo')[$index]->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file('photo')[$index]->move($path, $fileFinalName);
                $image->photo = $fileFinalName;
                $image->hotel_id = $unit->id;
                $image->save();
            }
        }


        toastr()->info('تم تعديل بيانات الوحدة السكنية ', 'نجاح');
        // return redirect()->route('hotels.index');
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
        $units =  Hotel::find($id);
        if ($units->appartment->count() > 0) {
            toastr()->error('هذه الوحدة  تحتوي على شقق قم بحذف الشقق اولا', 'خطأ');
            return redirect()->route('appartments.index');
        } else {
            $units->delete();
            toastr()->info('تم حذف الوحدة السكنية ', 'نجاح');
            return redirect()->route('appartments.index');
        }
    }

    // Delete image by ID
    // public function delete_image($id)
    // {
    //     Image::find($id)->delete();
    //     toastr()->info('تم حذف الصورة ', 'نجاح');
    //     return redirect()->back();
    // }
}