<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('config/faculty', 'ConfigModule\Controllers\FacultyController');
    Route::resource('config/programs', 'ConfigModule\Controllers\ProgramsController');
    Route::resource('config', 'ConfigModule\Controllers\ConfigController')->only(['index'])->names('config');
});
