<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SalesOrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::post('/login', [AuthController::class, 'login']);

Route::get('/home', [InventoryController::class, 'index'])->name('home');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{id}', [InventoryController::class, 'show'])->name('inventory.show');
Route::get('/inventory/update/{id}', [InventoryController::class, 'update'])->name('inventory.update');
Route::get('/inventory/delete/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');


Route::get('/sales-order', [SalesOrderController::class, 'index'])->name('sales');
Route::post('/sales-order', [SalesOrderController::class, 'store'])->name('sales.store');
Route::get('/sales-order/{id}', [SalesOrderController::class, 'show'])->name('sales.show');
Route::get('/sales-order/update/{id}', [SalesOrderController::class, 'update'])->name('sales.update');


Route::get('/purchase-order', [PurchaseOrderController::class, 'index'])->name('purchase');
Route::post('/purchase-order', [PurchaseOrderController::class, 'store'])->name('purchase.store');
Route::get('/purchase-order/{id}', [PurchaseOrderController::class, 'show'])->name('purchase.show');
Route::get('/purchase-order/update/{id}', [PurchaseOrderController::class, 'update'])->name('purchase.update');


Route::get('/penerimaan', [PenerimaanController::class, 'index'])->name('penerimaan');
Route::post('/penerimaan', [PenerimaanController::class, 'store'])->name('penerimaan.store');
// Route::get('/penerimaan/{id}', [PenerimaanController::class, 'show'])->name('penerimaan.show');
Route::get('/penerimaan/update/{id}', [PenerimaanController::class, 'update'])->name('penerimaan.update');