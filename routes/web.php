<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradaController;

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

// Rutas para Proveedores
Route::resource('proveedores', ProveedorController::class);
Route::get('proveedores-trash', [ProveedorController::class, 'trash'])->name('proveedores.trash');
Route::patch('proveedores/{id}/restore', [ProveedorController::class, 'restore'])->name('proveedores.restore');
Route::delete('proveedores/{id}/force-delete', [ProveedorController::class, 'forceDelete'])->name('proveedores.force-delete');

// Rutas para Productos
Route::resource('productos', ProductoController::class);
Route::get('productos-trash', [ProductoController::class, 'trash'])->name('productos.trash');
Route::patch('productos/{id}/restore', [ProductoController::class, 'restore'])->name('productos.restore');
Route::delete('productos/{id}/force-delete', [ProductoController::class, 'forceDelete'])->name('productos.force-delete');

// Rutas para Entradas de Inventario
Route::resource('entradas', EntradaController::class)->except(['edit', 'update', 'destroy']);
Route::get('entradas/{entrada}/factura', [EntradaController::class, 'factura'])->name('entradas.factura');
Route::get('entradas/{entrada}/pdf', [EntradaController::class, 'generarPdf'])->name('entradas.pdf');
Route::get('get-productos-by-proveedor', [EntradaController::class, 'getProductosByProveedor'])->name('get.productos.by.proveedor');

// Rutas para Salidas de Inventario
Route::resource('salidas', App\Http\Controllers\SalidaInventarioController::class)->except(['destroy']); // Excluir destroy si no se implementa o se maneja de otra forma
// Si necesitas rutas adicionales para SalidaInventario, añádelas aquí.
