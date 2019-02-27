<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');


    //delivery routes
    Route::get('/productOrders', 'AdminDeliveryController@orders')->name('admin.product_orders');
    Route::get('/getNewOrders', 'AdminDeliveryController@getNewOrders');
    Route::get('/setStatus', 'AdminDeliveryController@setStatus');
    Route::get('/test', 'AdminDeliveryController@test');


    //Product routes
    Route::get('/insert/products', 'AdminProductController@index');
    Route::get('/product/create', 'AdminProductController@create');
    Route::post('/product', 'AdminProductController@store');
    Route::get('/product/{id}/edit', 'AdminProductController@edit');
    Route::put('/product/{id}', 'AdminProductController@update');
    Route::delete('/product/{id}', 'AdminProductController@delete');


    //restaurant image routes
    Route::get('/insert/images', 'AdminRestaurantImageController@all');
    Route::get('/restaurant_image/create', 'AdminRestaurantImageController@create');
    Route::post('/restaurant_image', 'AdminRestaurantImageController@store');
    Route::get('/restaurant_image/{id}/edit', 'AdminRestaurantImageController@edit');
    Route::put('/restaurant_image/{id}', 'AdminRestaurantImageController@update');
    Route::delete('/restaurant_image/{id}', 'AdminRestaurantImageController@delete');


    //Page routes
    Route::get('/page/{p}', 'AdminCreatePageController@index');
    Route::get('/pages/create', 'AdminCreatePageController@create');
    Route::get('/pages', 'AdminCreatePageController@all');
    Route::get('/page/{p}/edit', 'AdminCreatePageController@edit');
    Route::post('/pages', 'AdminCreatePageController@store');
    Route::put('/page/{id}', 'AdminCreatePageController@update');
    Route::delete('/page/{id}', 'AdminCreatePageController@delete');
    Route::delete('/pages/delete', 'AdminCreatePageController@truncate');


    //mail message notification
    Route::get('/read_message', 'AdminController@read_message');
    Route::post('/clear_messages', 'AdminController@clear_messages');


    //user setting routes
    Route::get('/register_user', 'AdminUserController@registerForm');




    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::get('/contact_us', 'ContactMailController@index');
Route::post('contact_us', ['as' => 'contact.store', 'uses' => 'ContactMailController@store']);



