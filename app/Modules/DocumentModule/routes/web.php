<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('documentos/descargar/{id}', 'DocumentModule\Controllers\DocumentController@download')->name('documents.download');
    Route::resource('documentos', 'DocumentModule\Controllers\DocumentController');
});
