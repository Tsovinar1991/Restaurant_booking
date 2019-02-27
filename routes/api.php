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

Route::get('restaurant', 'RestaurantController@index');
Route::get('restaurant/{id}', 'RestaurantController@show');
Route::post('restaurant', 'RestaurantController@store');
Route::put('restaurant/{id}', 'RestaurantController@update');
Route::delete('restaurant/{id}', 'RestaurantController@delete');



Route::get('order', 'OrderController@index');
Route::get('order/{id}', 'OrderController@show');
Route::post('order', 'OrderController@store');
Route::put('order/{id}', 'OrderController@update');
Route::delete('order/{id}', 'OrderController@delete');



Route::get('/seat', 'SeatController@index');
Route::get('/seat/{id}', 'SeatController@show');
Route::post('seat', 'SeatController@store');
Route::put('seat/{id}', 'SeatController@update');
Route::delete('seat/{id}', 'SeatController@delete');



Route::get('restaurant_image', 'RestaurantImageController@index');
Route::get('restaurant_image/{id}', 'RestaurantImageController@show');
Route::post('restaurant_image', 'RestaurantImageController@store');
Route::put('restaurant_image/{id}', 'RestaurantImageController@update');
Route::delete('restaurant_image/{id}', 'RestaurantImageController@delete');



Route::get('city', 'CityController@index');
Route::get('city/{id}', 'CityController@show');
Route::post('city', 'CityController@store');
Route::put('city/{id}', 'CityController@update');
Route::delete('city/{id}', 'CityController@delete');


Route::post('/create_order', 'GetOrdersController@store');








