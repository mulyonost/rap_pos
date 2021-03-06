<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
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
use App\Http\Controllers\LaporanAvalanController;
use App\Http\Controllers\AvalanSupplierController;
use App\Http\Controllers\LaporanPackingController;
use App\Http\Controllers\LaporanProduksiController;
use App\Http\Controllers\PembelianAvalanController;
use App\Http\Controllers\LaporanAnodizingController;
use App\Http\Controllers\LaporanBahanController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\PengambilanBahanController;

use App\Models\PembelianAvalan;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Carbon\Carbon;

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
    $pav = PembelianAvalan::where('due_date', '<', Carbon::now()->addDays(3))->where('status', 0)->with('supplier')->orderBy('due_date')->get();
    $pb = Pembelian::where('due_date', '<', Carbon::now()->addDays(3))->where('status', 0)->with('supplier')->get();
    $tpav = PembelianAvalan::sum('total_nota');
    $tpb = Pembelian::sum('total');
    $tj = Penjualan::sum('total_akhir');
    $utangavalan = PembelianAvalan::where('status', 0)->sum('total_nota');
    $utangbahan = Pembelian::where('status', 0)->sum('total');
    return view('home', compact('pav', 'pb', 'tpb', 'tpav', 'tj', 'utangavalan', 'utangbahan'));
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
        Route::get('/bahan/pelunasan', [PembelianController::class, 'index_pelunasan'])->name('bahan.pelunasan');
        Route::get('/bahan/pelunasan/data', [PembelianController::class, 'pelunasan'])->name('bahan.pelunasan.data');
        Route::post('/bahan/payment/', [PembelianController::class, 'payment'])->name('bahan.payment');
        Route::get('/bahan/paymentDelete/{id?}', [PembelianController::class, 'paymentDelete'])->name('bahan.paymentDelete');
        Route::resource('/bahan', PembelianController::class);

        Route::get('/avalan/data', [PembelianAvalanController::class, 'data'])->name('avalan.data');
        Route::get('/avalan/pelunasan', [PembelianAvalanController::class, 'index_pelunasan'])->name('avalan.pelunasan');
        Route::get('/avalan/pelunasan/data', [PembelianAvalanController::class, 'pelunasan'])->name('avalan.pelunasan.data');
        Route::post('/avalan/payment/', [PembelianAvalanController::class, 'payment'])->name('avalan.payment');
        Route::get('/avalan/paymentDelete/{id?}', [PembelianAvalanController::class, 'paymentDelete'])->name('avalan.paymentDelete');
        Route::get('/avalan/selesai', [PembelianAvalanController::class, 'selesai'])->name('avalan.selesai');
        Route::get('/avalan/cetak/', [PembelianAvalanController::class, 'cetak'])->name('avalan.cetak');
        Route::get('/avalan/cetakulang/{id?}', [PembelianAvalanController::class, 'cetakulang'])->name('avalan.cetakulang');
        Route::resource('/avalan', PembelianAvalanController::class);
    });

    // All Penjualan Routes
    Route::prefix('penjualan')->name('penjualan_')->group(function () {
        Route::get('/aluminium/data', [PenjualanController::class, 'data'])->name('aluminium.data');
        Route::get('/aluminium/selesai', [PenjualanController::class, 'selesai'])->name('aluminium.selesai');
        Route::get('/aluminium/cetaksj', [PenjualanController::class, 'cetaksj'])->name('aluminium.cetaksj');
        Route::get('/aluminium/cetaknota', [PenjualanController::class, 'cetaknota'])->name('aluminium.cetaknota');
        Route::get('/aluminium/cetakulangsj/{id?}', [PenjualanController::class, 'cetakulangsj'])->name('aluminium.cetakulangsj');
        Route::get('/aluminium/cetakulangnota/{id?}', [PenjualanController::class, 'cetakulangnota'])->name('aluminium.cetakulangnota');

        Route::get('/aluminium/pelunasan', [PenjualanController::class, 'index_pelunasan'])->name('aluminium.pelunasan');
        Route::get('/aluminium/pelunasan/data', [PenjualanController::class, 'pelunasan'])->name('aluminium.pelunasan.data');
        Route::post('/aluminium/payment', [PenjualanController::class, 'payment'])->name('aluminium.payment');
        Route::get('/aluminium/payment/{id}', [PenjualanController::class, 'showpayment'])->name('aluminium.showpayment');
        Route::get('/aluminium/paymentDelete/{id?}', [PenjualanController::class, 'paymentDelete'])->name('aluminium.paymentDelete');
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
        Route::get('/produksi/search', [LaporanProduksiController::class, 'search'])->name('produksi.search');
        Route::get('/produksi/date', [LaporanProduksiController::class, 'date'])->name('produksi.date');

        Route::get('/anodizing', [LaporanAnodizingController::class, 'index'])->name('anodizing.index');
        Route::get('/anodizing/items', [LaporanAnodizingController::class, 'index_group'])->name('anodizing.index_group');
        Route::get('/anodizing/data', [LaporanAnodizingController::class, 'data'])->name('anodizing.data');

        Route::resource('/packing', LaporanPackingController::class);
        Route::get('/packing/detail', [LaporanPackingController::class, 'detail'])->name('packing.detail');

        Route::get('/avalan', [LaporanAvalanController::class, 'index'])->name('avalan.index');
        Route::get('avalan/search', [LaporanAvalanController::class, 'search'])->name('avalan.search');
        Route::get('/avalan/data_avalan', [LaporanAvalanController::class, 'data_avalan'])->name('penjualan.data_avalan');
        Route::get('/avalan/data_supplier', [LaporanAvalanController::class, 'data_supplier'])->name('penjualan.data_supplier');
        Route::get('/avalan/data_avalan_group', [LaporanAvalanController::class, 'data_avalan_group'])->name('penjualan.data_avalan_group');

        Route::resource('/bahan', LaporanBahanController::class);

        Route::get('/penjualan', [LaporanPenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('/penjualan/customer', [LaporanPenjualanController::class, 'customer'])->name('penjualan.customer');
        Route::get('/penjualan/items', [LaporanPenjualanController::class, 'items'])->name('penjualan.items');

        Route::get('penjualan/search', [LaporanPenjualanController::class, 'search'])->name('penjualan.search');
        Route::get('/penjualan/data_items', [LaporanPenjualanController::class, 'data_items'])->name('penjualan.data_items');
        Route::get('/penjualan/data_customer', [LaporanPenjualanController::class, 'data_customer'])->name('penjualan.data_customer');
        Route::get('/penjualan/data_items_group', [LaporanPenjualanController::class, 'data_items_group'])->name('penjualan.data_items_group');
    });
});
