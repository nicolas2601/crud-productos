<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
        return view('proveedores.create');
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
        ]);

        Proveedor::create($request->all());

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
        return view('proveedores.edit', compact('proveedor'));
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
        ]);

        $proveedor->update($request->all());

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