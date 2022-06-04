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

Route::get('/home', function () {
    return view('layouts.layout');
});

Auth::routes();

Route::post('/register', [RegisterController::class, 'register'])->name('register-klien');

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth']], function(){
    Route::get('/home', [HomeAdminController::class, 'index'])->name('home-admin');
    Route::get('/getData', [HomeAdminController::class, 'getData'])->name('admin-getData');
    Route::get('/create', [HomeAdminController::class, 'create'])->name('admin-create');
    Route::post('/create', [HomeAdminController::class, 'store'])->name('admin-store');
    Route::get('/edit/{id}', [HomeAdminController::class, 'edit'])->name('admin-edit');
    Route::post('/update/{id}', [HomeAdminController::class, 'update'])->name('admin-update');  
    Route::get('/delete/{id}', [HomeAdminController::class, 'delete'])->name('admin-delete');  
});

Route::group(['prefix'=>'klien', 'middleware'=>['isKlien','auth']], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

