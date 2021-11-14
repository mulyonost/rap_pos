<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\AvalanController;
use App\Http\Controllers\PackingController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\AluminiumController;
use App\Http\Controllers\AnodizingController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\AluminiumBaseController;
use App\Http\Controllers\LaporanPackingController;
use App\Http\Controllers\LaporanProduksiController;
use App\Http\Controllers\LaporanAnodizingController;
use App\Http\Controllers\PengambilanBahanController;

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

    Route::get('/master/aluminiumbase/data', [AluminiumBaseController::class, 'data'])->name('aluminiumbase.data');
    Route::resource('/master/aluminiumbase', AluminiumBaseController::class);

    Route::get('/master/aluminium/data', [AluminiumController::class, 'data'])->name('aluminium.data');
    Route::resource('/master/aluminium', AluminiumController::class);

    Route::get('/master/items/data', [ItemsController::class, 'data'])->name('items.data');
    Route::resource('/master/items', ItemsController::class);

    Route::get('/master/avalan/data', [AvalanController::class, 'data'])->name('avalan.data');
    Route::resource('/master/avalan', AvalanController::class);

    Route::get('/master/customers/data', [CustomersController::class, 'data'])->name('customers.data');
    Route::resource('/master/customers', CustomersController::class);

    Route::get('/master/suppliers/data', [SuppliersController::class, 'data'])->name('suppliers.data');
    Route::resource('/master/suppliers', SuppliersController::class);

    // All Input Laporan Routes

    Route::get('/produksi/data', [ProduksiController::class, 'data'])->name('produksi.data');
    Route::resource('/produksi', ProduksiController::class);

    Route::get('/anodizing/data', [AnodizingController::class, 'data'])->name('anodizing.data');
    Route::resource('/anodizing', AnodizingController::class);

    Route::get('/packing/data', [PackingController::class, 'data'])->name('packing.data');
    Route::resource('/packing', PackingController::class);

    Route::get('/laporan/pengambilan/data', [PengambilanBahanController::class, 'data'])->name('pengambilan.data');
    Route::resource('/laporan/pengambilan', PengambilanBahanController::class);


    //All Kas Routes

    Route::get('/kas/data', [KasController::class, 'data'])->name('kas.data');
    Route::resource('/kas', KasController::class);

    // All Pembelian Routes

    Route::get('/pembelian/bahan/data', [PembelianController::class, 'data'])->name('bahan.data');
    Route::resource('/pembelian/bahan', PembelianController::class);



    // All Penjualan Routes

    Route::get('/penjualan/sale/data', [PenjualanController::class, 'data'])->name('sale.data');
    Route::get('/penjualan/sale/cetaksj', [PenjualanController::class, 'cetaksj'])->name('sale.cetaksj');
    Route::get('/penjualan/sale/cetakulangsj/{id}', [PenjualanController::class, 'cetakulangsj'])->name('sale.cetakulangsj');
    Route::resource('/penjualan/sale', PenjualanController::class)->except('cetakulangsj');

    // All Reports Routes

    Route::get('/produksireports', [LaporanProduksiController::class, 'index'])->name('produksireports.index');
    Route::get('/produksireports/date', [LaporanProduksiController::class, 'date'])->name('produksireports.date');

    Route::resource('/anodizingreports', LaporanAnodizingController::class);

    Route::resource('/packingreports', LaporanPackingController::class);
    Route::get('/packingreports/detail', [LaporanPackingController::class, 'detail'])->name('packingreports.detail');
});
