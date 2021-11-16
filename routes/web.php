<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AluminiumBaseController;
use App\Http\Controllers\AluminiumController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\AvalanController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\AvalanSupplierController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\AnodizingController;
use App\Http\Controllers\PackingController;
use App\Http\Controllers\PengambilanBahanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianAvalanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\LaporanProduksiController;
use App\Http\Controllers\LaporanPackingController;
use App\Http\Controllers\LaporanAnodizingController;

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

Route::get('/', fn () => redirect()->route('login'));

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('home');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    // All Masters Routes
    Route::prefix('master')->name('master_')->group(function () {
        Route::get('/aluminiumbase/data', [AluminiumBaseController::class, 'data'])->name('aluminiumbase.data');
        Route::resource('/aluminiumbase', AluminiumBaseController::class);

        Route::get('/aluminium/data', [AluminiumController::class, 'data'])->name('aluminium.data');
        Route::resource('/aluminium', AluminiumController::class);

        Route::get('/items/data', [ItemsController::class, 'data'])->name('items.data');
        Route::resource('/items', ItemsController::class);

        Route::get('/avalan/data', [AvalanController::class, 'data'])->name('avalan.data');
        Route::resource('/avalan', AvalanController::class);

        Route::get('/customers/data', [CustomersController::class, 'data'])->name('customers.data');
        Route::resource('/customers', CustomersController::class);

        Route::get('/suppliers/data', [SuppliersController::class, 'data'])->name('suppliers.data');
        Route::resource('/suppliers', SuppliersController::class);

        Route::get('/avalansupplier/data', [AvalanSupplierController::class, 'data'])->name('avalansupplier.data');
        Route::resource('/avalansupplier', AvalanSupplierController::class);
    });

    // All Input Laporan Routes
    Route::prefix('laporan')->name('laporan_')->group(function () {
        Route::get('/produksi/data', [ProduksiController::class, 'data'])->name('produksi.data');
        Route::resource('/produksi', ProduksiController::class);

        Route::get('/anodizing/data', [AnodizingController::class, 'data'])->name('anodizing.data');
        Route::resource('/anodizing', AnodizingController::class);

        Route::get('/packing/data', [PackingController::class, 'data'])->name('packing.data');
        Route::resource('/packing', PackingController::class);

        Route::get('/pengambilan/data', [PengambilanBahanController::class, 'data'])->name('pengambilan.data');
        Route::resource('/pengambilan', PengambilanBahanController::class);
    });

    // All Pembelian Routes
    Route::prefix('pembelian')->name('pembelian_')->group(function () {
        Route::get('/bahan/data', [PembelianController::class, 'data'])->name('bahan.data');
        Route::resource('/bahan', PembelianController::class);

        Route::get('/avalan/data', [PembelianAvalanController::class, 'data'])->name('avalan.data');
        Route::resource('/avalan', PembelianAvalanController::class);
    });

    // All Penjualan Routes
    Route::prefix('penjualan')->name('penjualan_')->group(function () {
        Route::get('/aluminium/data', [PenjualanController::class, 'data'])->name('aluminium.data');
        Route::get('/aluminium/cetaksj', [PenjualanController::class, 'cetaksj'])->name('aluminium.cetaksj');
        Route::get('/aluminium/cetakulangsj/{id}', [PenjualanController::class, 'cetakulangsj'])->name('aluminium.cetakulangsj');
        Route::resource('/aluminium', PenjualanController::class);
    });

    // All Kas Routes
    Route::prefix('kas')->name('kas.')->group(function () {
        Route::get('/data', [KasController::class, 'data'])->name('data');
        Route::resource('', KasController::class);
    });

    // All Reports Routes
    Route::prefix('reports')->name('reports_')->group(function () {
        Route::get('/produksi', [LaporanProduksiController::class, 'index'])->name('produksi.index');
        Route::get('/produksi/date', [LaporanProduksiController::class, 'date'])->name('produksi.date');

        Route::resource('/anodizing', LaporanAnodizingController::class);

        Route::resource('/packing', LaporanPackingController::class);
        Route::get('/packing/detail', [LaporanPackingController::class, 'detail'])->name('packing.detail');
    });
});
