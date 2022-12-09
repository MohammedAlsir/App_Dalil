<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class StateCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $state = State::orderBy('id', 'DESC')->get();
        $city = City::orderBy('id', 'DESC')->get();
        $index_state = 1;
        $index_city = 1;
        return view('state&city.index', compact(
            'state',
            'city',
            'index_state',
            'index_city'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type == "state") {
            $state = new State();
            $state->name_ar = $request->state_name_ar;
            $state->name_en = $request->state_name_en;
            $state->save();
            toastr()->info('تم اضافة الولاية ', 'نجاح');
            return redirect()->route('city.index');
        } elseif ($request->type == "city") {
            $city = new City();
            $city->name_ar = $request->city_name_ar;
            $city->name_en = $request->city_name_en;
            $city->state_id = $request->state_id;
            $city->save();
            toastr()->info('تم اضافة المدينة ', 'نجاح');
            return redirect()->route('city.index');
        }
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
        //
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
        if ($request->type == "state_edit") {
            $state =  State::find($id);
            $state->name_ar = $request->state_name_ar;
            $state->name_en = $request->state_name_en;
            $state->save();
            toastr()->info('تم تعديل بيانات الولاية ', 'نجاح');
            return redirect()->route('city.index');
        } elseif ($request->type == "city_edit") {
            $city =  City::find($id);
            $city->name_ar = $request->city_name_ar;
            $city->name_en = $request->city_name_en;
            $city->state_id = $request->state_id;
            $city->save();
            toastr()->info('تم تعديل بيانات المدينة ', 'نجاح');
            return redirect()->route('city.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->type == "delete_state") {
            if (State::find($id)->cities()->count() == 0) {
                State::find($id)->delete();
                toastr()->info('تم حذف الولاية ', 'نجاح');
                return redirect()->route('city.index');
            } else {
                toastr()->error('هذه الولاية تحتوي على مدن قم بحذف المدن المتعلقة بها اولا', 'خطأ');
                return redirect()->route('city.index');
            }
        } elseif ($request->type == "delete_city") {
            if (City::find($id)->hotel()->count() == 0) {
                City::find($id)->delete();
                toastr()->info('تم حذف المدينة ', 'نجاح');
                return redirect()->route('city.index');
            } else {
                toastr()->error('هذه المدينة تحتوي على فنادق قم بحذف الفنادق المتعلقة بها اولا', 'خطأ');
                return redirect()->route('city.index');
            }
        } else {
            toastr()->info('قم بتحديد ولاية او مدينة لحذفها', 'خطأ');
            return redirect()->route('city.index');
        }
    }
}