<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('users', UsersController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('kamar', KamarController::class);
Route::resource('transaksi', TransaksiController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('kategori/{id}/kamars', [KategoriController::class, 'getKamars'])->name('kategori.kamars');
Route::get('/kategori/{kategori}/kamars', [TransaksiController::class, 'getKamars'])->name('kategori.kamars');
Route::post('transaksi/{transaksi}/tempatkan', [TransaksiController::class, 'tempatkan'])->name('transaksi.tempatkan');
Route::post('transaksi/{transaksi}/checkout', [TransaksiController::class, 'checkout'])->name('transaksi.checkout');
