<?php

use App\Http\Controllers\Admin\HomeAdminController ;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

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
    return view('layouts.layout');
});

Auth::routes();

Route::post('/register', [RegisterController::class, 'register'])->name('register-klien');

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth']], function(){
    Route::get('/home', [HomeAdminController::class, 'index'])->name('home-admin');
});

Route::group(['prefix'=>'klien', 'middleware'=>['isKlien','auth']], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

