<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockEntryController;
use App\Http\Controllers\StockExitController;
use App\Http\Controllers\SupplierController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Rutas para Productos
    Route::resource('products', ProductController::class);
    
    // Rutas para Proveedores
    Route::resource('suppliers', SupplierController::class);
    
    // Rutas para Clientes
    Route::resource('clients', ClientController::class);
    
    // Rutas para Entradas de Stock
    Route::resource('stock-entries', StockEntryController::class);
    
    // Rutas para Salidas de Stock
    Route::resource('stock-exits', StockExitController::class);
});
