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

Route::group(['prefix' => 'peminjam'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PeminjamController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\PeminjamController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\PeminjamController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\PeminjamController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\PeminjamController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\PeminjamController::class, 'destroy']);
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
    Route::get( '/list', [\App\Http\Controllers\Admin\PeminjamanController::class, 'detail_data']);
    Route::post( '/append-list', [\App\Http\Controllers\Admin\PeminjamanController::class, 'append_detail']);
    Route::post( '/destroy-list', [\App\Http\Controllers\Admin\PeminjamanController::class, 'destroy_detail']);
    Route::get( '/detail/{id}', [\App\Http\Controllers\Admin\PeminjamanController::class, 'detail_page']);
    Route::get( '/cetak/{id}', [\App\Http\Controllers\Admin\PeminjamanController::class, 'cetak']);
});

Route::group(['prefix' => 'pengembalian'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PengembalianController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\PengembalianController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\PengembalianController::class, 'create']);
    Route::get( '/detail/{id}', [\App\Http\Controllers\Admin\PengembalianController::class, 'detail_page']);
    Route::get( '/cetak/{id}', [\App\Http\Controllers\Admin\PengembalianController::class, 'cetak']);
});

Route::group(['prefix' => 'laporan-peminjaman'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'peminjaman_page']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'peminjaman_data']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'peminjaman_cetak']);
});

Route::group(['prefix' => 'laporan-pengembalian'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'pengembalian_page']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'pengembalian_data']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'pengembalian_cetak']);
});

Route::group(['prefix' => 'laporan-barang-pinjam'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'barang_dipinjam_page']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'barang_dipinjam_data']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'barang_dipinjam_cetak']);
});

Route::group(['prefix' => 'laporan-barang'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'barang_page']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'barang_data']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'barang_cetak']);
});

