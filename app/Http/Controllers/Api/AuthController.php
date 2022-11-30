<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiMessage;
    /*
        == Login function ==
        == Receive email & password  ==
    */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'     => 'required',
            'password'  => 'required|min:8'
        ]);

        // == begin attempt ==
        if (Auth::attempt($data)) {
            // == Create Token ==
            $token = Auth::guard()->user()->createToken('Token')->accessToken;
            //  == return user data with token ==
            // return $this->returnData('user', Auth::guard('agents')->user(), $token);
            return $this->returnData('user', Auth::guard()->user(), $token);
        } else
            // == there is error ==
            return $this->returnMessage(false, 'عفوا , هناك خطأ في كلمة المرور او  اسم المستخدم ', 200);
        // == end attempt ==
    }


    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'      => 'required|string|max:255',
                'email'     => 'required|string|email|max:255|unique:users',
                'password'  => 'required|string|min:8|confirmed',
                'phone'     => 'required|min:10|max:10',
            ]
        );
        // == check data ==
        if ($validator->fails())
            return $this->returnMessage(false, $validator->errors()->all(), 422);
        // == add new user  ==
        $user = User::create($request->toArray());
        $token = $user->createToken('Token')->accessToken;
        // == return user data with token ==
        return $this->returnData('user', $user, $token);
    }
}