<?php

use App\Http\Controllers\Auth\LoginController;
use App\Modules\UserModule\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

// Route::get('/', function () {
//     return view('auth.login');
// });
// Route::get('/clientes', function () {
//     return view('customers.index');
// })->name('customer.index');
Route::get('/login/{drive}/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/login/{drive}/callback', [LoginController::class, 'validationLoginGoogle']);
Auth::routes();
// Route::get('test-user-model', 'UserModule\Controllers\ProfileController@test')->name('user.test');
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'role'], function () {

    });

    Route::get('{page}', 'PageController@index')->name('page.index');
});

