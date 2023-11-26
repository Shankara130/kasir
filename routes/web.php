<?php

use App\Http\Controllers\Namacontroller;
use Illuminate\Support\Facades\Route;

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

Route::view('/kasir', 'kasir.index')->name('kasir');
Route::view('/login', 'login')->name('login');
Route::view('/produk', 'produk.index')->name('produk');
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/pagess',  [Namacontroller::class, 'index'])->name('page');
