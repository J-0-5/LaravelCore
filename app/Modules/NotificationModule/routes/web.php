<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('notificaciones', 'NotificationModule\Controllers\NotificationController')->names('notifications');
});
