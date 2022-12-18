<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiMessage;
    private $uploadPath = "uploads/users/";
    private $uploadPathIdentificationPhoto = "uploads/identification/";


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
            return $this->returnMessage(false, 'عفوا , هناك خطأ في كلمة المرور او  البريد الالكتروني  ', 'Sorry, there is an error in the email or password', 200);
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
            return $this->returnMessage(false, $validator->errors()->all(), '', 200);
        // == add new user  ==
        $user = User::create($request->toArray());
        $token = $user->createToken('Token')->accessToken;
        // == return user data with token ==
        return $this->returnData('user', $user, $token);
    }

    // Show Profile
    public function get_profile()
    {
        $user = User::find(Auth::user()->id);
        if ($user)
            return $this->returnData('user', $user);
        else
            return $this->returnMessage(false, 'هذا المستخدم غير موجود', 'This user does not exist', 200);
    }

    // Edit Profile
    public function edit_profile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if (!$user)
            return $this->returnMessage(false, 'هذا المستخدم غير موجود', 'This user does not exist', 200);

        $validator = Validator::make(
            $request->all(),
            [
                'name'      => 'string|max:255',
                'email'     => 'string|email|max:255|unique:users,email,' . $user->id,
                'password'  => 'string|min:8|confirmed',
                'phone'     => 'min:10|max:10',
                // 'photo'     => '',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                'identification' => '',
                // 'identification_photo' => '',
                'identification_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


            ]
        );

        if ($validator->fails())
            return $this->returnMessage(false, $validator->errors()->all(), '', 200);
        // == add new user  ==
        if ($request->name)
            $user->name = $request->name;
        if ($request->email)
            $user->email = $request->email;
        if ($request->password)
            $user->password = $request->password;
        if ($request->phone)
            $user->phone = $request->phone;
        if ($request->identification)
            $user->identification = $request->identification;
        // For Photo
        $formFileName = "photo";
        $fileFinalName = "";
        if ($request->$formFileName != "") {
            // Delete file if there is a new one
            if ($user->$formFileName) {
                File::delete($this->uploadPath . User::find(Auth::user()->id)->photo);
            }
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);
        }

        if ($fileFinalName != "") {
            $user->photo = $fileFinalName;
        }
        // For Photo

        // For identification_Photo
        $form_identification_photo = "identification_photo";
        $file_identification_photo = "";
        if ($request->$form_identification_photo != "") {
            // Delete file if there is a new one
            if ($user->$form_identification_photo) {
                File::delete($this->uploadPathIdentificationPhoto . User::find(Auth::user()->id)->identification_photo);
            }
            $file_identification_photo = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($form_identification_photo)->getClientOriginalExtension();
            $path = $this->uploadPathIdentificationPhoto;
            $request->file($form_identification_photo)->move($path, $file_identification_photo);
        }

        if ($file_identification_photo != "") {
            $user->identification_photo = $file_identification_photo;
        }
        // For identification_Photo
        $user->save();
        // == return user data with token ==
        return $this->returnData('user', $user);
    }
}
