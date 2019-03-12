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
})->name('welcome');



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


    //restaurant routes
    Route::get('/insert/restaurants', 'AdminRestaurantController@index')->name('admin.restaurants');
    Route::get('/restaurant/{id}', 'AdminRestaurantController@show')->name('admin.show.restaurant');
    Route::get('/create/restaurant', 'AdminRestaurantController@create')->name('admin.restaurant.create');
    Route::post('/restaurant', 'AdminRestaurantController@store')->name('admin.create.restaurant');
    Route::get('/restaurant/{id}/edit', 'AdminRestaurantController@edit')->name('admin.edit.restaurant');
    Route::put('/restaurant/{id}', 'AdminRestaurantController@update')->name('admin.update.restaurant');



    //Product routes
    Route::get('/insert/products', 'AdminProductController@index')->name('admin.products');
    Route::get('/product/create', 'AdminProductController@create');
    Route::post('/product', 'AdminProductController@store');
    Route::get('/product/{id}/edit', 'AdminProductController@edit');
    Route::put('/product/{id}', 'AdminProductController@update');
    Route::get('/product/{id}', 'AdminProductController@show');
    Route::get('/products/change_status', 'AdminProductController@productStatus');


    //restaurant image routes
    Route::get('/insert/images', 'AdminRestaurantImageController@all')->name('admin.images');
    Route::get('/restaurant_image/create', 'AdminRestaurantImageController@create')->name('admin.restaurant_image.create');
    Route::post('/restaurant_image', 'AdminRestaurantImageController@store');
    Route::get('/restaurant_image/{id}/edit', 'AdminRestaurantImageController@edit');
    Route::put('/restaurant_image/{id}', 'AdminRestaurantImageController@update');
    Route::delete('/restaurant_image/{id}', 'AdminRestaurantImageController@delete');
    Route::get('/restaurant_images/gallery/{category}', 'AdminRestaurantImageController@gallery');


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
    Route::get('/read_message', 'AdminMessageController@read_message')->name('admin.message.read');
    Route::get('/set_messages_read', 'AdminMessageController@set_messages_read');


    //user setting routes
    Route::get('/register_form', 'AdminUserController@registerForm')->name('admin.user.register.form');
    Route::post('/register_user', 'AdminUserController@register');
    Route::get('/user/settings', 'AdminUserController@settings')->name('admin.user.settings');
    Route::delete('/users/delete/{id}', 'AdminUserController@deleteUser')->name('delete.admin.user');
    Route::get('/users/edit/{id}', 'AdminUserController@editUser')->name('edit.admin.user');
    Route::put('/users/update/{id}', 'AdminUserController@updateUser')->name('update.admin.user');
    Route::get('/users/changePassword/{id}', 'AdminUserController@changePassword')->name('admin.user.changePassword');
    Route::put('/users/password/update/{id}', 'AdminUserController@updatePassword')->name('admin.user.password.update');
    Route::get('/users/change_status', 'AdminUserController@userStatus');


    //profile routes
    Route::get('/admin/user/profile', 'AdminProfileController@adminUserProfile')->name('admin.user.profile');



    //error route
    Route::get('/error', function(){
        return view('admin.error');
    })->name('admin.error');


    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::get('/contact_us', 'ContactMailController@index')->name('contact_us');
Route::post('contact_us', ['as' => 'contact_us.store', 'uses' => 'ContactMailController@store']);


Route::any('{query}',
    function() { return redirect(route('welcome')); })
    ->where('query', '.*');

