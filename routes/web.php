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


// Login routes
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

// Password reset routes
Route::post('admin/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin/password/reset', 'Auth\AdminResetPasswordController@reset');
Route::get('admin/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');


Route::group(['prefix' => 'admin',
    'middleware' => [
        'auth:admin',
        'isActive'
    ],
], function () {

    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');


    //delivery routes
    Route::get('/delivery', 'AdminDeliveryController@orders')->name('admin.product_orders');
    Route::get('/getNewOrders', 'AdminDeliveryController@getNewOrders');//ajax
    Route::get('/setStatus', 'AdminDeliveryController@setStatus'); //ajax
    Route::get('/test', 'AdminDeliveryController@test'); //ajax


    //restaurant routes
    Route::get('/restaurants', 'AdminRestaurantController@index')->name('admin.restaurants');
    Route::get('/restaurant/{id}', 'AdminRestaurantController@show')->name('admin.show.restaurant');
    Route::get('/create/restaurant', 'AdminRestaurantController@create')->name('admin.restaurant.create');
    Route::post('/restaurant', 'AdminRestaurantController@store')->name('admin.create.restaurant');
    Route::get('/restaurant/{id}/edit', 'AdminRestaurantController@edit')->name('admin.edit.restaurant');
    Route::put('/restaurant/{id}', 'AdminRestaurantController@update')->name('admin.update.restaurant');


    //Product routes
    Route::get('/products', 'AdminProductController@index')->name('admin.products');
    Route::get('create/product', 'AdminProductController@create')->name('admin.product.create');
    Route::post('/products', 'AdminProductController@store')->name('admin.product.store');
    Route::get('/product/{id}/edit', 'AdminProductController@edit')->name('admin.edit.product');
    Route::put('/product/{id}', 'AdminProductController@update')->name('admin.update.product');
    Route::get('/product/{id}', 'AdminProductController@show')->name('admin.show.product');
    Route::get('/products/change_status', 'AdminProductController@productStatus'); //ajax


    //restaurant image routes
    Route::get('restaurant-images', 'AdminRestaurantImageController@index')->name('admin.images');
    Route::get('/restaurant-image/create', 'AdminRestaurantImageController@create')->name('admin.restaurant_image.create');
    Route::post('/restaurant-images', 'AdminRestaurantImageController@store')->name('admin.store.images');
    Route::get('/restaurant-image/{id}/edit', 'AdminRestaurantImageController@edit')->name('admin.restaurant_image.edit');
    Route::put('/restaurant-image/{id}', 'AdminRestaurantImageController@update')->name('admin.restaurant_image.update');
    Route::delete('/restaurant-image/{id}', 'AdminRestaurantImageController@delete')->name('admin.restaurant_image.delete');
    Route::get('/restaurant-images/gallery/{category}', 'AdminRestaurantImageController@gallery')->name('admin.restaurant_images.gallery');


    //Menus
    Route::get('menus', 'AdminMenuController@index')->name('admin.menus');
    Route::post('/menu-store', 'AdminMenuController@store')->name('admin.menus.store');
    Route::get('menu-update', 'AdminMenuController@change_name')->name('admin.menus.update');


    //Page routes
    Route::get('/page/{p}', 'AdminCreatePageController@index')->name('admin.page.single');
    Route::get('/pages/create', 'AdminCreatePageController@create')->name('admin.create.page');
    Route::get('/pages', 'AdminCreatePageController@all')->name('admin.pages');
    Route::get('/page/{p}/edit', 'AdminCreatePageController@edit')->name('admin.edit.page');
    Route::post('/pages', 'AdminCreatePageController@store')->name('admin.store.page');
    Route::put('/page/{id}', 'AdminCreatePageController@update')->name('admin.update.page');
    Route::delete('/page/{id}', 'AdminCreatePageController@delete')->name('admin.delete.page');


    //mail message notification
    Route::get('/read-message', 'AdminMessageController@read_message')->name('admin.message.read');
    Route::post('/answer-message/{id}', 'AdminMessageController@answer_message')->name('admin.message.answer');
    Route::get('/set_messages_read', 'AdminMessageController@set_messages_read');//ajax
    Route::get('/contact-us/history/{id}', 'AdminMessageController@history')->name('admin.dialog.history');
    Route::post('/contact-us/dialog/{id}', 'AdminMessageController@answer_message')->name('admin.dialog.answer');


    //user setting routes
    Route::get('/register-form', 'AdminUserController@registerForm')->name('admin.user.register.form');
    Route::post('/register-user', 'AdminUserController@register')->name('admin.user.store');
    Route::get('/user/settings', 'AdminUserController@settings')->name('admin.user.settings');
    Route::delete('/users/delete/{id}', 'AdminUserController@deleteUser')->name('delete.admin.user');
    Route::get('/users/edit/{id}', 'AdminUserController@editUser')->name('edit.admin.user');
    Route::put('/users/update/{id}', 'AdminUserController@updateUser')->name('update.admin.user');
    Route::get('/users/changePassword/{id}', 'AdminUserController@changePassword')->name('admin.user.changePassword');
    Route::put('/users/password/update/{id}', 'AdminUserController@updatePassword')->name('admin.user.password.update');
    Route::get('/users/change_status', 'AdminUserController@userStatus');//ajax


    //profile routes
    Route::get('/admin/user/profile', 'AdminProfileController@adminUserProfile')->name('admin.user.profile');
    Route::post('/admin/user/{id}/update', 'AdminProfileController@updateProfile')->name('admin.user.profile.update');


    //error route
    Route::get('/error', function () {
        return view('admin.error');
    })->name('admin.error');
});

Route::get('/contact_us', 'ContactMailController@index')->name('contact_us');
Route::post('contact_us', ['as' => 'contact_us.store', 'uses' => 'ContactMailController@store']);



Route::any('{query}',
    function() { return redirect(route('welcome')); })
    ->where('query', '.*');

