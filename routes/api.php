<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api'], function () {

    Route::post('login', 'AuthController@login'); // == Login ==
    Route::post('register', 'AuthController@register'); // == Login ==

    Route::get('hotels', 'HotelController@get_hotel'); // == get All Hotels ==
    Route::get('hotels/top', 'HotelController@get_top_hotel'); // == get Top 3  Hotels ==

    Route::get('hotels/{id}/appartments', 'HotelController@get_hotel_appartments_by_id'); // == get All Appartments by hotel ID ==
    Route::get('appartment/{id}', 'HotelController@get_appartments_by_id'); // == get one Appartment by appartment ID ==

    // Get Public Data
    Route::get('states', 'GetController@get_state'); // == get all State ==
    Route::get('state/{id}/cities', 'GetController@get_cities'); // == get all cities by state id ==
    Route::get('state/city/{id}/hotels', 'GetController@get_hotels'); // == get all hotels by city id ==


    // For Authentication
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('profile', 'AuthController@get_profile');
        Route::post('profile', 'AuthController@edit_profile');
        // Like
        Route::post('like/hotel/{hotel_id}', 'HotelController@add_like_for_hotel');
        Route::post('like/appartment/{appartments_id}', 'HotelController@add_like_for_appartment');
    });



    // Route::group(
    //     [
    //         'prefix' => LaravelLocalization::setLocale(),
    //         'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    //     ],
    //     function () {
    //         // == This routes user must be logged in ==
    //         Route::group(['middleware' => ['auth:api']], function () {
    //         });
    //     }
    // );
});