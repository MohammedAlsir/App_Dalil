<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Toaster;

class SettingController extends Controller
{
    private $uploadPath = "uploads/setting/";
    private $uploadPath_profile = "uploads/profile/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function settings()
    {
        $setting = Setting::find(1);
        return view('setting.index', compact('setting'));
    }

    public function settings_edit(Request $request)
    {
        $setting = Setting::find(1);

        // Start of Upload Files
        $formFileName = "logo";
        $fileFinalName = "";
        if ($request->$formFileName != "") {
            // Delete file if there is a new one
            if ($setting->$formFileName != "") {
                File::delete($this->uploadPath . $setting->$formFileName);
            }
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);
        }


        if ($fileFinalName != "") {
            $setting->logo = $fileFinalName;
        }

        $setting->name = $request->name;
        $setting->address = $request->address;
        $setting->phone = $request->phone;

        $setting->account_name = $request->account_name;
        $setting->account_number = $request->account_number;
        $setting->bank_name = $request->bank_name;


        $setting->save();
        // toast('???? ?????????????? ??????????', 'success');
        toastr()->info('???? ?????????????? ??????????', '????????');


        // Session::flash('SUCCESS', '????  ??????????????  ??????????');

        return view('setting.index', compact('setting'));
    }


    public function profile()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.index', compact('user'));
    }

    public function profile_edit(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $this->validate($request, array(
            'name'        => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user)],
            'password'        => '',

        ));

        // Start of Upload Files
        $formFileName = "photo";
        $fileFinalName = "";
        if ($request->$formFileName != "") {
            // Delete file if there is a new one
            if ($user->$formFileName != "") {
                File::delete($this->uploadPath_profile . $user->$formFileName);
            }
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath_profile;
            $request->file($formFileName)->move($path, $fileFinalName);
        }


        if ($fileFinalName != "") {
            $user->photo = $fileFinalName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = $request->password;
        }

        $user->save();
        toastr()->info('???? ?????????????? ??????????', '????????');


        // Session::flash('SUCCESS', '????  ??????????????  ??????????');

        return redirect()->route('profile');
    }
}