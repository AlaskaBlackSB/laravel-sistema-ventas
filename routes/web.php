<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
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

//Muestra todos los productos
Route::get('shop', [ShopController::class, 'index'])->middleware(['auth'])->name('shop.products.index');

// Realiza la venta
Route::post('shop', [ShopController::class, 'store'])->middleware(['auth'])->name('shop.sale.store');

// CRUD de productos
Route::get('shop/create/product', [ProductController::class, 'index'])->middleware(['auth'])->name('products.index');
Route::post('shop/create/product', [ProductController::class, 'store'])->middleware(['auth'])->name('products.store');
Route::get('shop/product/{product_id}/', [ProductController::class, 'edit'])->middleware(['auth'])->name('products.edit');
Route::put('shop/product/{product_id}', [ProductController::class, 'update'])->middleware(['auth'])->name('products.update');
Route::delete('shop/product/{product_id}', [ProductController::class, 'destroy'])->middleware(['auth'])->name('products.destroy');

//Muestra todas las facturas hechas y por hacer
Route::get('admin/invoices', [InvoiceController::class, 'index'])->middleware(['auth'])->name('invoice.index');

// Muestra el resumen de la factura
Route::get('admin/invoices/{invoice_id}', [InvoiceController::class, 'show'])->middleware(['auth'])->name('invoice.show');

// Genera todas las facturas faltantes
Route::post('admin/invoices', [InvoiceController::class, 'store'])->middleware(['auth'])->name('invoice.generate');

