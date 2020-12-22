<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'auth.login');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    Route::view('/', 'dashboard');
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    /************** suppliers routes************ */
    Route::group(['prefix' => 'supplier'], function () {

        Route::get('/',[ SupplierController::class, 'index'])->name('supplier');
        Route::get('/create',[ SupplierController::class, 'create'])->name('supplier.create');
        Route::Post('/store',[ SupplierController::class, 'store'])->name('supplier.store');

        Route::get('/show',[ SupplierController::class, 'show'])->name('supplier.show');

        Route::get('edit/{supplier}',[ SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('edit/{supplier}', [SupplierController::class,'update'])->name('supplier.update');

    });/* ****End Routes***** */


    /************** Purchase Routes************ */
    Route::group(['prefix' => 'invoice/purchase'], function () {

        Route::get('/',[ InvoiceController::class, 'index'])->name('purchase');

        Route::get('/create',[ InvoiceController::class, 'create'])->name('supplier.create');
        Route::Post('/store',[ InvoiceController::class, 'store'])->name('supplier.store');

        Route::get('/show',[ InvoiceController::class, 'show'])->name('supplier.show');

        Route::get('edit/{supplier}',[ InvoiceController::class, 'edit'])->name('supplier.edit');
        Route::post('edit/{supplier}', [InvoiceController::class,'update'])->name('supplier.update');

    }); /* ****End Routes***** */



    /************** sales routes************ */
    Route::group(['prefix' => 'invoice/sales'], function () {

        Route::get('/',[ InvoiceController::class, 'index'])->name('sales');
        Route::get('/create',[ InvoiceController::class, 'create'])->name('supplier.create');
        Route::Post('/store',[ InvoiceController::class, 'store'])->name('supplier.store');

        Route::get('/show',[ InvoiceController::class, 'show'])->name('supplier.show');

        Route::get('edit/{supplier}',[ InvoiceController::class, 'edit'])->name('supplier.edit');
        Route::post('edit/{supplier}', [InvoiceController::class,'update'])->name('supplier.update');

    });/* ****End Routes***** */



    /************** customers routes************ */
    Route::group(['prefix' => 'customers'], function () {

        Route::get('/',[ SupplierController::class, 'index'])->name('customers');
        // Route::get('/create',[ SupplierController::class, 'create'])->name('supplier.create');
        // Route::Post('/store',[ SupplierController::class, 'store'])->name('supplier.store');

        // Route::get('/show',[ SupplierController::class, 'show'])->name('supplier.show');

        // Route::get('edit/{supplier}',[ SupplierController::class, 'edit'])->name('supplier.edit');
        // Route::post('edit/{supplier}', [SupplierController::class,'update'])->name('supplier.update');

    });/* ****End Routes***** */




});


