<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('gestion-documental', 'DocManagementModule\Controllers\DocManagementModuleController@index')->name('docManagement.index');
});
