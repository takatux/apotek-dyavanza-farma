<?php

use App\Http\Controllers\Admin\HomeAdminController ;
use App\Http\Controllers\Klien\HomeKlienController;
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
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/register', [RegisterController::class, 'register'])->name('register-klien');

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth']], function(){
    Route::get('/home', [HomeAdminController::class, 'index'])->name('home-admin');
    Route::get('/getData', [HomeAdminController::class, 'getData'])->name('admin-getData');
    Route::get('/create', [HomeAdminController::class, 'create'])->name('admin-create');
    Route::post('/create', [HomeAdminController::class, 'store'])->name('admin-store');
    Route::get('/edit/{id}', [HomeAdminController::class, 'edit'])->name('admin-edit');
    Route::post('/update/{id}', [HomeAdminController::class, 'update'])->name('admin-update');  
    Route::get('/delete/{id}', [HomeAdminController::class, 'delete'])->name('admin-delete');  
    Route::get('/pesanan', [HomeAdminController::class, 'pesanan'])->name('admin-pesanan');
    Route::get('/getDataPemesan', [HomeAdminController::class, 'getDataPemesan'])->name('admin-getDataPemesan');
    Route::get('/acc/{id}', [HomeAdminController::class, 'accPemesanan'])->name('admin-acc-pemesanan');
});

Route::group(['prefix'=>'klien', 'middleware'=>['isKlien','auth']], function(){
    Route::get('/home', [HomeKlienController::class, 'index'])->name('home-klien');
    Route::get('/getData', [HomeKlienController::class, 'getData'])->name('klien-getData');
    Route::get('/detail/{id}', [HomeKlienController::class, 'show'])->name('klien-detail');
    Route::post('/detail/{id}', [HomeKlienController::class, 'pemesanan'])->name('klien-pemesanan');
    Route::get('/keranjang', [HomeKlienController::class, 'keranjang'])->name('klien-keranjang');
});

