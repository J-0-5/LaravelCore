<?php

use Illuminate\Support\Facades\Route;

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
//Auth
// Route::post('login', 'Api\AuthController@Login');
// Route::post('logout', 'Api\AuthController@signOut');
// Route::post('forgotPassword', 'Api\AuthController@recovery');
// Route::post('confirmCode', 'Api\AuthController@verifyCode');
// Route::post('restorePassword', 'Api\AuthController@restore');
// Route::post('resendCode', 'Api\AuthController@forward');
// Route::post('customer/signIn', 'Api\AuthController@registerCustomer');

//Parameter values
// Route::get('parameter_values', 'Api\ParameterValueController@getParameterValues');
// Route::get('status_matrix', 'Api\ParameterValueController@getStatusMatrix');

// Route::middleware(['auth:sanctum'])->group(function () {

    // Route::get('customer/show', 'CustomerModule\Controllers\Api\CustomerController@show')->name('customer.show');
    // Route::put('customer/update', 'CustomerModule\Controllers\Api\CustomerController@update')->name('customer.update');

    // Route::get('address', 'Api\AddressController@index')->name('address');
    // Route::post('address/store', 'Api\AddressController@store')->name('address.store');
    // Route::put('address/update/{id}', 'Api\AddressController@update')->name('address.update');
    // Route::delete('address/{id}', 'Api\AddressController@destroy')->name('address.delete');

    // Route::get('messenger/show', 'Api\MessengerController@show')->name('messenger.show');
    // Route::put('messenger/update', 'Api\MessengerController@update')->name('messenger.update');

    // Route::post('order/markAsRead', 'OrderModule\Controllers\Api\OrderController@markAsRead');
    // Route::resource('orders', 'OrderModule\Controllers\Api\OrderController')->names('order');

    // Route::post('guide/update-additional-information', 'GuideModule\Controllers\Api\GuideController@updateAdditionalInformation');
    // Route::post('guide/markAsRead', 'GuideModule\Controllers\Api\GuideController@markAsRead');
    // Route::resource('guides', 'GuideModule\Controllers\Api\GuideController')->names('guides');
    // Route::put('guide/changeStatus', 'GuideModule\Controllers\Api\GuideController@changeStatus')->name('guide.changeStatus');

    // Route::resource('hours', 'Api\PickupHourController')->names('hours');
// });
