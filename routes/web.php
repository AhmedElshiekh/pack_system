<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'auth.login');
// Route::view('/register', 'auth.login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {


    // Route::view('/register', 'auth.regis');
    Route::view('/', 'dashboard');
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    /************** suppliers routes************ */
    Route::group(['prefix' => 'supplier'], function () {

        Route::get('/', [SupplierController::class, 'index'])->name('supplier');
        Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::Post('/store', [SupplierController::class, 'store'])->name('supplier.store');

        Route::get('/show/{supplier}', [SupplierController::class, 'show'])->name('supplier.show');

        Route::get('edit/{supplier}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('edit/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
    });/* ****End Routes***** */


    /************** customers routes************ */
    Route::group(['prefix' => 'customer'], function () {

        Route::get('/', [CustomerController::class, 'index'])->name('customer');
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::Post('/store', [CustomerController::class, 'store'])->name('customer.store');

        Route::get('/show/{customer}', [CustomerController::class, 'show'])->name('customer.show');

        Route::get('edit/{customer}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('edit/{customer}', [CustomerController::class, 'update'])->name('customer.update');
    });/* ****End Routes***** */



    /************** Purchase Routes************ */
    Route::group(['prefix' => 'invoice/purchase'], function () {

        Route::get('/', [PurchaseController::class, 'index'])->name('purchase');
        Route::post('/filter', [PurchaseController::class, 'index'])->name('purchase.filter');

        Route::get('/create', [PurchaseController::class, 'create'])->name('purchase.create');
        Route::Post('/store', [PurchaseController::class, 'store'])->name('purchase.store');

        Route::get('/show/{invoice}', [PurchaseController::class, 'show'])->name('purchase.show');

        Route::get('edit/{purchase}', [PurchaseController::class, 'edit'])->name('purchase.edit');
        Route::post('edit/{purchase}', [PurchaseController::class, 'update'])->name('purchase.update');

        Route::get('delete/{invoice}', [PurchaseController::class, 'destroy'])->name('invoice.delete');
    }); /* ****End Routes***** */


    /************** sales routes************ */
    Route::group(['prefix' => 'invoice/sales'], function () {

        Route::get('/', [SaleController::class, 'index'])->name('sales');
        Route::post('/filter', [SaleController::class, 'index'])->name('sales.filter');

        Route::get('/create', [SaleController::class, 'create'])->name('sales.create');
        Route::Post('/store', [SaleController::class, 'store'])->name('sales.store');

        Route::get('/show/{invoice}', [SaleController::class, 'show'])->name('sales.show');

        Route::get('edit/{sales}', [SaleController::class, 'edit'])->name('sales.edit');
        Route::post('edit/{sales}', [SaleController::class, 'update'])->name('sales.update');

        Route::get('delete/{invoice}', [SaleController::class, 'destroy'])->name('invoice.sales.delete');
    });/* ****End Routes***** */


    /************** imports routes************ */
    Route::group(['prefix' => 'imports'], function () {

        Route::get('/', [ImportController::class, 'index'])->name('imports');
        Route::post('/filter', [ImportController::class, 'index'])->name('imports.filter');

        Route::get('/create', [ImportController::class, 'create'])->name('imports.create');
        Route::Post('/store', [ImportController::class, 'store'])->name('imports.store');

        Route::get('/show/{voucher}', [ImportController::class, 'show'])->name('imports.show');

        // Route::get('edit/{voucher}', [ImportController::class, 'edit'])->name('imports.edit');
        // Route::post('edit/{voucher}', [ImportController::class, 'update'])->name('imports.update');

        Route::get('delete/{voucher}', [ImportController::class, 'destroy'])->name('imports.delete');
    });/* ****End Routes***** */

    /************** exports routes************ */
    Route::group(['prefix' => 'exports'], function () {

        Route::get('/', [ExportController::class, 'index'])->name('exports');
        Route::post('/filter', [ExportController::class, 'index'])->name('exports.filter');

        Route::get('/create', [ExportController::class, 'create'])->name('exports.create');
        Route::Post('/store', [ExportController::class, 'store'])->name('exports.store');

        Route::get('/show/{voucher}', [ExportController::class, 'show'])->name('exports.show');

        // Route::get('edit/{voucher}', [ExportController::class, 'edit'])->name('exports.edit');
        // Route::post('edit/{voucher}', [ExportController::class, 'update'])->name('exports.update');

        Route::get('delete/{voucher}', [ExportController::class, 'destroy'])->name('exports.delete');
    });/* ****End Routes***** */



    
});
