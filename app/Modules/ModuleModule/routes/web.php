<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/', 'ModuleModule\Controllers\ModuleController')->names('home');
});
