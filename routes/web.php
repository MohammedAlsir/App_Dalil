<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::namespace('App\Http\Controllers')->middleware(['auth'])->group(function () {
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('profile', 'SettingController@profile')->name('profile');
    Route::put('profile', 'SettingController@profile_edit')->name('profile_edit');

    Route::get('settings', 'SettingController@settings')->name('settings');
    Route::put('settings', 'SettingController@settings_edit')->name('settings_edit');

    Route::resource('hotels', 'HotelController');
    Route::resource('hotel/appartment', 'HotelAppartmentController');
});