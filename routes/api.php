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
    Route::get('units', 'UnitController@get_units'); // == get All Units ==
    Route::get('hotels/top', 'HotelController@get_top_hotel'); // == get Top 3  Hotels ==
    Route::get('units/top', 'UnitController@get_top_units'); // == get Top 3  units ==


    // For Hotles
    Route::get('hotels/{id}/appartments', 'HotelController@get_hotel_appartments_by_id'); // == get All Appartments by hotel ID ==
    Route::get('appartment/{id}', 'HotelController@get_appartments_by_id'); // == get one Appartment by appartment ID ==
    // For Units
    Route::get('units/{id}/appartments', 'UnitController@get_unit_appartments_by_id'); // == get All Appartments by unit ID ==
    Route::get('unit_appartments/{id}', 'UnitController@get_appartments_by_id'); // == get one Appartment by appartment ID ==

    // كل السيارات حسب التصنيفات
    Route::post('cars', 'CarsController@get_cars'); // == get All Cars ==

    // Get Public Data
    Route::get('states', 'GetController@get_state'); // == get all State ==
    Route::get('state/{id}/cities', 'GetController@get_cities'); // == get all cities by state id ==
    Route::get('state/city/{id}/hotels', 'GetController@get_hotels'); // == get all hotels by city id ==
    Route::get('state/city/{id}/units', 'GetController@get_units'); // == get all hotels by city id ==


    // For Authentication
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('profile', 'AuthController@get_profile');
        Route::post('profile', 'AuthController@edit_profile');
        // Like
        Route::post('like/hotel/{hotel_id}', 'HotelController@add_like_for_hotel');
        Route::post('like/unit/{unit_id}', 'UnitController@add_like_for_unit');
        Route::post('like/appartment/{appartments_id}', 'HotelController@add_like_for_appartment');
        Route::post('like/unit_appartment/{appartments_id}', 'UnitController@add_like_for_appartment');
        // Apartment Request --> hotel
        Route::post('appartment/{id}/request', 'HotelController@appartment_request');
        Route::post('appartment/{id}/pay', 'HotelController@appartment_pay');
        // Apartment Request --> unit
        Route::post('unit_appartment/{id}/request', 'UnitController@appartment_request');
        Route::post('unit_appartment/{id}/pay', 'UnitController@appartment_pay');

        // Cars Request
        Route::post('cars/{id}/request', 'CarsController@car_request');
        Route::post('cars/{id}/pay', 'CarsController@car_pay');
        Route::post('like/car/{car_id}', 'CarsController@add_like_for_car');
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
