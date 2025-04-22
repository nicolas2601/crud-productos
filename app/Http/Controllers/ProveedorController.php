<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Producto; // Importar el modelo Producto

class ProveedorController extends Controller
{
    /**
     * Mostrar un listado de proveedores.
     */
    public function index(): View
    {
        $proveedores = Proveedor::latest()->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Mostrar el formulario para crear un nuevo proveedor.
     */
    public function create(): View
    {
        $productos = Producto::orderBy('nombre')->get(); // Obtener todos los productos
        return view('proveedores.create', compact('productos'));
    }

    /**
     * Almacenar un nuevo proveedor en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            // Validar el array de productos
            'productos' => 'nullable|array',
            'productos.*' => 'exists:productos,id'
        ]);

        $proveedor = Proveedor::create($request->only(['nombre', 'empresa', 'contacto']));

        // Asignar los productos seleccionados (si los hay)
        if ($request->has('productos')) {
            $proveedor->productos()->sync($request->productos);
            // Aquí podríamos añadir lógica para guardar el precio_compra si se incluye en el form
        }

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor creado exitosamente.');
    }

    /**
     * Mostrar un proveedor específico.
     */
    public function show(Proveedor $proveedor): View
    {
        return view('proveedores.show', compact('proveedor'));
    }

    /**
     * Mostrar el formulario para editar un proveedor.
     */
    public function edit(Proveedor $proveedor): View
    {
        $productos = Producto::orderBy('nombre')->get(); // Obtener todos los productos
        $productosProveedor = $proveedor->productos->pluck('id')->toArray(); // Obtener IDs de productos asociados
        return view('proveedores.edit', compact('proveedor', 'productos', 'productosProveedor'));
    }

    /**
     * Actualizar un proveedor en la base de datos.
     */
    public function update(Request $request, Proveedor $proveedor): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            // Validar el array de productos
            'productos' => 'nullable|array',
            'productos.*' => 'exists:productos,id'
        ]);

        $proveedor->update($request->only(['nombre', 'empresa', 'contacto']));

        // Sincronizar los productos
        // Si no se envía 'productos', sync([]) desasociará todos los productos.
        $proveedor->productos()->sync($request->input('productos', []));
        // Aquí también podríamos añadir lógica para actualizar el precio_compra si se incluye en el form

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado exitosamente.');
    }

    /**
     * Eliminar un proveedor de la base de datos (soft delete).
     */
    public function destroy(Proveedor $proveedor): RedirectResponse
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor eliminado exitosamente.');
    }

    /**
     * Mostrar proveedores eliminados.
     */
    public function trash(): View
    {
        $proveedoresTrashed = Proveedor::onlyTrashed()->paginate(10);
        return view('proveedores.trash', compact('proveedoresTrashed'));
    }

    /**
     * Restaurar un proveedor eliminado.
     */
    public function restore($id): RedirectResponse
    {
        $proveedor = Proveedor::onlyTrashed()->findOrFail($id);
        $proveedor->restore();

        return redirect()->route('proveedores.trash')
            ->with('success', 'Proveedor restaurado exitosamente.');
    }

    /**
     * Eliminar permanentemente un proveedor.
     */
    public function forceDelete($id): RedirectResponse
    {
        $proveedor = Proveedor::onlyTrashed()->findOrFail($id);
        $proveedor->forceDelete();

        return redirect()->route('proveedores.trash')
            ->with('success', 'Proveedor eliminado permanentemente.');
    }
}