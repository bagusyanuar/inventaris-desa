<?php

use Illuminate\Support\Facades\Route;

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
Route::match(['post', 'get'], '/', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

Route::group(['prefix' => 'admin'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\AdminController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\AdminController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\AdminController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\AdminController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\AdminController::class, 'destroy']);
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\KategoriController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\KategoriController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\KategoriController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\KategoriController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\KategoriController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\KategoriController::class, 'destroy']);
});

Route::group(['prefix' => 'barang'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\BarangController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\BarangController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\BarangController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\BarangController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\BarangController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\BarangController::class, 'destroy']);
});

Route::group(['prefix' => 'peminjaman'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PeminjamanController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\PeminjamanController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\PeminjamanController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\PeminjamanController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\PeminjamanController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\PeminjamanController::class, 'destroy']);
    Route::get( '/list', [\App\Http\Controllers\Admin\PeminjamanController::class, 'detail_data']);
    Route::post( '/append-list', [\App\Http\Controllers\Admin\PeminjamanController::class, 'append_detail']);
});

