<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductoController extends Controller
{
    /**
     * Mostrar un listado de productos.
     */
    public function index(): View
    {
        $productos = Producto::with('proveedor')->latest()->paginate(10);
        return view('productos.index', compact('productos'));
    }

    /**
     * Mostrar el formulario para crear un nuevo producto.
     */
    public function create(): View
    {
        $proveedores = Proveedor::all();
        return view('productos.create', compact('proveedores'));
    }

    /**
     * Almacenar un nuevo producto en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'proveedor_id' => 'required|exists:proveedors,id',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Mostrar un producto específico.
     */
    public function show(Producto $producto): View
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Mostrar el formulario para editar un producto.
     */
    public function edit(Producto $producto): View
    {
        $proveedores = Proveedor::all();
        return view('productos.edit', compact('producto', 'proveedores'));
    }

    /**
     * Actualizar un producto en la base de datos.
     */
    public function update(Request $request, Producto $producto): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'proveedor_id' => 'required|exists:proveedors,id',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Eliminar un producto de la base de datos (soft delete).
     */
    public function destroy(Producto $producto): RedirectResponse
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }

    /**
     * Mostrar productos eliminados.
     */
    public function trash(): View
    {
        $productosTrashed = Producto::onlyTrashed()->with('proveedor')->paginate(10);
        return view('productos.trash', compact('productosTrashed'));
    }

    /**
     * Restaurar un producto eliminado.
     */
    public function restore($id): RedirectResponse
    {
        $producto = Producto::onlyTrashed()->findOrFail($id);
        $producto->restore();

        return redirect()->route('productos.trash')
            ->with('success', 'Producto restaurado exitosamente.');
    }

    /**
     * Eliminar permanentemente un producto.
     */
    public function forceDelete($id): RedirectResponse
    {
        $producto = Producto::onlyTrashed()->findOrFail($id);
        $producto->forceDelete();

        return redirect()->route('productos.trash')
            ->with('success', 'Producto eliminado permanentemente.');
    }
}