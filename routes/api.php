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
    Route::get('hotels/top', 'HotelController@get_all_hotel_appartment'); // == get Top 3  Hotels ==

    Route::get('hotels/{id}/appartments', 'HotelController@get_hotel_appartments_by_id'); // == get All Appartments by hotel ID ==
    Route::get('appartment/{id}', 'HotelController@get_appartments_by_id'); // == get one Appartment by appartment ID ==



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