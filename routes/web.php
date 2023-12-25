<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DiskonController;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/', [AuthController::class, 'login'])->name('login');
});
Route::get('/home', function () {
    return redirect('/admin');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin', [HomeController::class, 'index'])->name('admin');
    Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
    Route::resource('/kategori', KategoriController::class);

    Route::get('/shopping-cart', [ProdukController::class, 'productCart'])->name('shopping.cart');
    Route::get('/produk/{id}', [ProdukController::class, 'addProducttoCart'])->name('addproduct.to.cart');
    Route::patch('/update-shopping-cart', [ProdukController::class, 'updateCart'])->name('update.shopping.cart');
    Route::delete('/delete-cart-product', [ProdukController::class, 'deleteProduct'])->name('delete.cart.product');

    Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
    Route::post('/produk/delete-selected', [ProdukController::class, 'deleteSelected'])->name('produk.delete_selected');
    Route::resource('/produk', ProdukController::class);

    Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
    Route::post('/transaksi/store', [PenjualanController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');

    Route::get('/transaksi', [PenjualanController::class, 'index'])->name('transaksi.data');
    Route::resource('/transaksi', DetailPenjualanController::class)
        ->except('create', 'show', 'edit');

    Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

    Route::get('/stok/data', [StokController::class, 'data'])->name('stok.data');
    Route::resource('/stok', StokController::class);

    Route::get('/diskon/data', [DiskonController::class, 'data'])->name('diskon.data');
    Route::resource('/diskon', DiskonController::class);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
    Route::get('/laporan/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('laporan.export_pdf');
});
