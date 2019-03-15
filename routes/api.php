<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['cors'])->group(function () {
    Route::get('restaurant', 'RestaurantController@index');
    Route::get('restaurant/{id}', 'RestaurantController@show');


    Route::post('order', 'OrderController@store');


    Route::get('/seat', 'SeatController@index');
    Route::get('/seat/{id}', 'SeatController@show');
    Route::post('seat', 'SeatController@store');
    Route::put('seat/{id}', 'SeatController@update');
    Route::delete('seat/{id}', 'SeatController@delete');


    Route::get('restaurant/{id}/images', 'RestaurantImageController@index');

//    Route::get('city', 'CityController@index');
//    Route::get('city/{id}', 'CityController@show');
//    Route::post('city', 'CityController@store');
//    Route::put('city/{id}', 'CityController@update');
//    Route::delete('city/{id}', 'CityController@delete');


    Route::post('/create_order', 'GetOrdersController@store');

//menu with request lang
    Route::get('/menu_all', 'PageController@index');
    Route::get('/menu_single/{id}', 'PageController@single');

});




