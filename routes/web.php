<?php

use App\Http\Controllers\{
    CategoryProductController,
    CustomerController,
    ProductController,
    PurchaseTransactionController,
    SupplierController,
    UserController,
    SalesTransactionController
};
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function() {
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
    Route::get('editor-product/{id?}', [ProductController::class, 'editorProduct'])->name('editor.product');

    Route::resource('category-product', CategoryProductController::class);
    Route::get('editor-category-product/{id?}', [CategoryProductController::class, 'editorCategoryProduct'])->name('editor.category-product');

    Route::resource('customer', CustomerController::class);
    Route::get('editor-customer/{id?}', [CustomerController::class, 'editorCustomer'])->name('editor.customer');

    Route::resource('supplier', SupplierController::class);
    Route::get('editor-supplier/{id?}', [SupplierController::class, 'editorSupplier'])->name('editor.supplier');

    Route::resource('purchase-transaction', PurchaseTransactionController::class);
    Route::get('editor-purchase-transaction/{id?}', [PurchaseTransactionController::class, 'editorPurchaseTransaction'])->name('editor.purchase.transaction');

    Route::resource('sales-transaction', SalesTransactionController::class);
    Route::get('editor-sales-transaction/{id?}', [SalesTransactionController::class, 'editorSalesTransaction'])->name('editor.sales.transaction');
});
