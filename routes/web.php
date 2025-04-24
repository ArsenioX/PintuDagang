<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PembelianController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Auth
Auth::routes();

// Home
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/admin/Home', [HomeController::class, 'adminHome'])->name('adminHome');
});

// Produk (Admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});

// Transaksi & Cart
Route::middleware(['auth'])->group(function () {
    // Halaman transaksi & cart
    Route::get('/transaksi', [PembelianController::class, 'transaksiIndex'])->name('transaksi.transaksi');
    Route::get('/transaksi/manager', [PembelianController::class, 'transaksiIndexManager'])->name('transaksi.transaksiManager');
    Route::get('/cart', [PembelianController::class, 'transaksiCart'])->name('transaksi.cart');

    // Aksi pembelian
    Route::post('/beli', [PembelianController::class, 'beli'])->name('transaksi.beli');

    // Aksi cart
    Route::delete('/cart/{id}', [PembelianController::class, 'clearCart'])->name('transaksi.clearcart');  // Menggunakan DELETE

    // Route untuk menghapus transaksi
    Route::delete('/transaksi/clear/{id}', [PembelianController::class, 'clear'])->name('transaksi.clear');

    // Aksi transaksi
    Route::post('/bayar', [PembelianController::class, 'bayar'])->name('transaksi.bayar');
    Route::delete('/transaksi/{id}', [PembelianController::class, 'hapus'])->name('transaksi.hapus');
    Route::delete('/transaksi/user/{id}', [PembelianController::class, 'clear'])->name('transaksi.clear');
    Route::post('/transaksi/konfirmasi/{id}', [PembelianController::class, 'konfirmasiStatus'])->name('transaksi.konfirmasi');
   Route::get('/transaksi/cetak/{id}', [PembelianController::class, 'generatePdf'])->name('transaksi.cetak');

    //Kategori
    Route::resource('kategori', KategoriController::class);
});
