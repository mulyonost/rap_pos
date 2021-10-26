<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\AluminiumController;
use App\Http\Controllers\AvalanController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\AnodizingController;
use App\Http\Controllers\LaporanProduksiController;

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

    Route::get('/pembelian/suppliers/data', [SuppliersController::class, 'data'])->name('suppliers.data');
    Route::resource('/pembelian/suppliers', SuppliersController::class);

    Route::get('/pembelian/items/data', [ItemsController::class, 'data'])->name('items.data');
    Route::resource('/pembelian/items', ItemsController::class);

    Route::get('/pembelian/avalan/data', [AvalanController::class, 'data'])->name('avalan.data');
    Route::resource('/pembelian/avalan', AvalanController::class);

    Route::get('/penjualan/customers/data', [CustomersController::class, 'data'])->name('customers.data');
    Route::resource('/penjualan/customers', CustomersController::class);

    Route::get('/penjualan/aluminium/data', [AluminiumController::class, 'data'])->name('aluminium.data');
    Route::resource('/penjualan/aluminium', AluminiumController::class);

    Route::get('/kas/data', [KasController::class, 'data'])->name('kas.data');
    Route::resource('/kas', KasController::class);

    Route::get('/produksi/data', [ProduksiController::class, 'data'])->name('produksi.data');
    Route::resource('/produksi', ProduksiController::class);

    Route::get('/anodizing/data', [AnodizingController::class, 'data'])->name('anodizing.data');
    Route::resource('/anodizing', AnodizingController::class);

    Route::resource('/produksireports', LaporanProduksiController::class);
});
