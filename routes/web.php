<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EntradaController;

Route::get('/', function () {
    return redirect()->route('productos.index');
});

// Rutas para productos
Route::resource('productos', ProductoController::class);

// Rutas para la papelera de productos
Route::get('/productos/papelera', [ProductoController::class, 'papelera'])->name('productos.papelera');
Route::put('/productos/{producto}/restaurar', [ProductoController::class, 'restaurar'])->name('productos.restaurar');
Route::delete('/productos/{producto}/eliminar-permanente', [ProductoController::class, 'eliminarPermanente'])->name('productos.eliminar-permanente');

// Rutas para proveedores
Route::resource('proveedores', ProveedorController::class);

// Rutas para entradas
Route::resource('entradas', EntradaController::class);
