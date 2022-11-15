<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role'], function () {
        Route::resource('usuarios', 'UserModule\Controllers\UserController')->names('users');
        // Route::get('legal-guardian-by-user/{id}', 'UserModule\Controllers\LegalGuardianController@getLegalGuardianByUser');
    });
    Route::resource('perfil', 'UserModule\Controllers\ProfileController')->names('profile');
    Route::put('update-password/{id}', 'UserModule\Controllers\ProfileController@updatePassword')->name('profile.update-password');
    Route::put('update-photo/{id}', 'UserModule\Controllers\ProfileController@updatePhoto')->name('profile.update-photo');
});
Route::get('test-user-model', 'UserModule\Controllers\ProfileController@test');
