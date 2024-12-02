<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\TransaksiController;
use App\Models\City;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AlamatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

// create route for user controller dengan middleware istoko
Route::middleware('auth')->resource('user', 'App\Http\Controllers\UserController');

// create route for produk controller
Route::middleware('auth')->resource('produk', 'App\Http\Controllers\ProdukController');
 
Route::get('alamat/sync_province', [AlamatController::class, 'sync_province'])->name('alamat.sync-province');

Route::get('alamat/sync_cities', [AlamatController::class, 'sync_cities'])->name('alamat.sync-cities');
Route::resource('alamat', 'App\Http\Controllers\AlamatController');
Route::resource('province', 'App\Http\Controllers\ProvinceController');
Route::resource('city', 'App\Http\Controllers\CityController');
Route::get('province/sync/data', [ProvinceController::class, 'sync'])->name('province.sync');
Route::get('city/sync/data', [CityController::class, 'sync'])->name('city.sync');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/dologin', [AuthController::class, 'dologin'])->name('dologin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->get('/home', [HomeController::class, 'index'])->name('home.index');
Route::middleware(['auth', 'KONSUMEN'])->get(
    '/transaksi/daftar_produk',
    [TransaksiController::class, 'daftar_produk']
)->name('transaksi.daftar.produk');

Route::middleware(['auth', 'KONSUMEN'])->get(
    '/transaksi/produk/{id}',
    [TransaksiController::class, 'produk']
);

Route::middleware(['auth', 'KONSUMEN'])->post(
    '/transaksi/get-ongkir',
    [TransaksiController::class, 'get_ongkir']
    )->name('transaksi.get-ongkir');

Route::middleware(['auth', 'KONSUMEN'])->post(
    '/transaksi/checkout',
    [TransaksiController::class, 'checkout']
)->name('transaksi.checkout');

Route::middleware(['auth', 'KONSUMEN'])->post(
    '/transaksi/get-ongkir',
    [TransaksiController::class, 'get_ongkir']
)->name('transaksi.get-ongkir');

Route::middleware(['auth', 'KONSUMEN'])->post(
    '/transaksi/checkout',
    [TransaksiController::class, 'checkout']
)->name('transaksi.checkout');

Route::middleware(['auth', 'KONSUMEN'])->get(
    '/transaksi/keranjang',
    [TransaksiController::class, 'keranjang']
)->name('transaksi.keranjang');

Route::middleware(['auth', 'KONSUMEN'])->delete(
    '/transaksi/hapus-keranjang/{transaksi}',
    [TransaksiController::class, 'hapus_keranjang']
)->name('transaksi.hapus-keranjang');

Route::middleware(['auth', 'KONSUMEN'])->get(
    '/transaksi/bayar',
    [TransaksiController::class, 'bayar']
)->name('transaksi.bayar');


