<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    private $uploadPath = "uploads/cars/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $cars = Car::orderBy('id', 'DESC')->get();
        return view('cars.index', compact('cars', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
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
            'type' => 'required',
            'number_of_passengers' => 'required',
            'number_of_doors' => 'required',
            'day_price' => 'required',
            'features_ar' => 'required',
            'features_en' => 'required',
            'motion_vector' => 'required',
            // 'photo' => 'max:3', // checks length of array
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ], [
            // 'photo.max' => 'عدد الصور اكثر من العدد المحدد'
        ]);
        $car = new Car();
        $car->name_ar = $request->name_ar;
        $car->name_en = $request->name_en;
        $car->type = $request->type;
        $car->number_of_passengers = $request->number_of_passengers;
        $car->number_of_doors = $request->number_of_doors;
        $car->day_price = $request->day_price;
        $car->driver_price = $request->driver_price;
        $car->motion_vector = $request->motion_vector;
        $car->features_ar = $request->features_ar;
        $car->features_en = $request->features_en;
        $car->save();

        // For Photo
        if ($request->hasFile('photo')) {
            // foreach ($request->file('photo') as $index => $imagefile) {
            $image = new Image();
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file('photo')->move($path, $fileFinalName);
            $image->photo = $fileFinalName;
            $image->car_id = $car->id;
            $image->save();
            // }
        }
        // For Photo


        toastr()->info('تم اضافة السيارة ', 'نجاح');
        return redirect()->route('cars.index');
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
        $car = Car::find($id);
        return view('cars.edit', compact('car'));
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
            'type' => 'required',
            'number_of_passengers' => 'required',
            'number_of_doors' => 'required',
            'day_price' => 'required',
            'features_ar' => 'required',
            'features_en' => 'required',
            'motion_vector' => 'required',
            // 'photo' => 'max:3', // checks length of array
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ], [
            // 'photo.max' => 'عدد الصور اكثر من العدد المحدد'
        ]);
        $car =  Car::find($id);
        $car->name_ar = $request->name_ar;
        $car->name_en = $request->name_en;
        $car->type = $request->type;
        $car->number_of_passengers = $request->number_of_passengers;
        $car->number_of_doors = $request->number_of_doors;
        $car->day_price = $request->day_price;
        $car->driver_price = $request->driver_price;
        $car->motion_vector = $request->motion_vector;
        $car->features_ar = $request->features_ar;
        $car->features_en = $request->features_en;
        $car->save();

        // For Photo
        if ($request->hasFile('photo')) {
            // foreach ($request->file('photo') as $index => $imagefile) {
            $image =  Image::where('car_id', $car->id)->first();
            // Delete file if there is a new one
            if ($image) {
                File::delete($this->uploadPath . $image->photo);
            }
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file('photo')->move($path, $fileFinalName);
            if ($image) {
                $image->photo = $fileFinalName;
                // $image->car_id = $car->id;
                $image->save();
            } else {
                $new_image = new Image();
                $new_image->photo = $fileFinalName;
                $new_image->car_id = $car->id;
                $new_image->save();
            }

            // }
        }
        // For Photo


        toastr()->info('تم تعديل بيانات السيارة ', 'نجاح');
        return redirect()->route('cars.edit', $car->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car =  Car::find($id)->delete();
        toastr()->info('تم حذف السيارة ', 'نجاح');
        return redirect()->route('cars.index');
    }
}