<?php

use App\Http\Controllers\DebtController;
use App\Http\Controllers\FishermenController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SackController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MasterTransaksiOperasionalController;
use App\Http\Controllers\TransaksiOperasionalController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->middleware(['auth'])->group(function() {
    Route::get('/fishermen', [FishermenController::class, 'index'])->name('fishermen.index');
    Route::get('/fishermen/create', [FishermenController::class, 'create'])->name('fishermen.create');
    Route::post('/fihsermen/store', [FishermenController::class, 'store'])->name('fishermen.store');
    Route::get('/fishermen/list', [FishermenController::class, 'list'])->name('fishermen.list');
    Route::get('/fishermen/show/{id}', [FishermenController::class, 'show'])->name('fishermen.show');

    // Master Location
    Route::get('/locations', [LocationController::class, 'index'])->name('location.index');
    Route::post('/locations/store', [LocationController::class, 'store'])->name('location.store');
    Route::patch('/locations/update/{slug}', [LocationController::class, 'update'])->name('location.update');
    Route::delete('/locations/destroy/{slug}', [LocationController::class, 'destroy'])->name('location.destroy');

    // Master Produk
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('product.store');
    Route::patch('/products/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::prefix('/transactionsoperasional')->group(function() {
        Route::get('/', [MasterTransaksiOperasionalController::class, 'index2'])->name('tr.index2');
        Route::get('/transactionoperasional', [MasterTransaksiOperasionalController::class, 'form'])->name('operasional.form');
        Route::post('/transactionoperasional', [MasterTransaksiOperasionalController::class, 'store'])->name('masteroperasional.store');
        Route::patch('/transactionoperasional/update/{id}', [MasterTransaksiOperasionalController::class, 'update'])->name('masteroperasional.update');
        Route::delete('/transactionoperasional/destroy/{id}', [MasterTransaksiOperasionalController::class, 'destroy'])->name('masteroperasional.destroy');
        Route::post('/transactionoperasional/show', [MasterTransaksiOperasionalController::class, 'show'])->name('masteroperasional.show');
        // untuk transaksi operasional
        Route::get('/transaksi', [TransaksiOperasionalController::class, 'index'])->name('transoperasional.index');
        // Transaksi Pembelian Produk
        Route::get('/purchase/form', [PurchaseController::class, 'form'])->name('purchase.form');
        Route::get('/purchase/get-fishermen', [PurchaseController::class, 'get_fishermen'])->name('purchase.get-fishermen');
        Route::get('/purchase/code-product-price', [PurchaseController::class, 'code_product_price'])->name('purchase.code-product-price');
        // Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store');

        // Get total qty
        Route::get('/get-qty', [PurchaseController::class, 'get_qty'])->name('get_qty');

        // Transaksi Pending
        Route::get('/purchase/pending', [PurchaseController::class, 'pending'])->name('purchase.pending');
        Route::patch('/purchase/upload-receipt/{id}', [PurchaseController::class, 'upload_receipt'])->name('purchase.upload-receipt');

        //Transaksi Selesai
        Route::get('/purchase/success', [PurchaseController::class, 'success'])->name('purchase.success');

        // Data Transaksi
        Route::get('/purchase/list', [PurchaseController::class, 'list'])->name('purchase.list');

    });

    // Tansaksi produk
    Route::prefix('/transactions')->group(function() {
        Route::get('/', [TransactionController::class, 'index'])->name('tr.index');
         // ini yang saya rubah mas

        // Transaksi Pembelian Produk
        Route::get('/purchase/form', [PurchaseController::class, 'form'])->name('purchase.form');
        Route::get('/purchase/get-fishermen', [PurchaseController::class, 'get_fishermen'])->name('purchase.get-fishermen');
        Route::get('/purchase/code-product-price', [PurchaseController::class, 'code_product_price'])->name('purchase.code-product-price');
        // Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store');

        // Get total qty
        Route::get('/get-qty', [PurchaseController::class, 'get_qty'])->name('get_qty');

        // Transaksi Pending
        Route::get('/purchase/pending', [PurchaseController::class, 'pending'])->name('purchase.pending');
        Route::patch('/purchase/upload-receipt/{id}', [PurchaseController::class, 'upload_receipt'])->name('purchase.upload-receipt');

        //Transaksi Selesai
        Route::get('/purchase/success', [PurchaseController::class, 'success'])->name('purchase.success');

        // Data Transaksi
        Route::get('/purchase/list', [PurchaseController::class, 'list'])->name('purchase.list');

    });

    // Get Data Select For Ajax
    Route::get('/location-get', [LocationController::class, 'get_location'])->name('location.get');
    Route::get('/fishermen-get', [FishermenController::class, 'get_fishermen'])->name('fishermen.get');
    Route::get('/product-get', [ProductController::class, 'get_product'])->name('product.get');


    // Kasbon
    Route::get('/kasbon/form', [DebtController::class, 'form'])->name('debt.form');
    Route::get('/kasbon/put-fishermen', [DebtController::class, 'put_fishermen'])->name('debt.put-fishermen');
    Route::post('/kasbon', [DebtController::class, 'store'])->name('debt.store');
    Route::post('/kasbon/pembayaran', [DebtController::class, 'debt_payment'])->name('debt.payment');

    //Karung
    Route::get('/karung/form', [SackController::class, 'form'])->name('sack.form');
    Route::get('karung/check-sack-fishermen', [SackController::class, 'checkSackFishermen'])->name('sack.check');
    Route::post('/karung', [SackController::class, 'store'])->name('sack.store');

});
