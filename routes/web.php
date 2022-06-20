<?php

use App\Http\Controllers\InvoiceController;
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

//Muestra todas las facturas hechas y por hacer
Route::get('admin/invoces', [InvoiceController::class, 'index'])->middleware(['auth'])->name('invoice.index');

// Genera todas las facturas faltantes
Route::post('admin/invoces', [InvoiceController::class, 'store'])->middleware(['auth'])->name('invoice.generate');

