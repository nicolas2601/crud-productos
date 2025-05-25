<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Mostrar un listado de proveedores.
     */
    public function index()
    {
        $suppliers = Supplier::withCount('products')->get();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Mostrar el formulario para crear un nuevo proveedor.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Almacenar un nuevo proveedor en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Supplier::create($validated);
        
        return redirect()->route('suppliers.index')
            ->with('success', 'Proveedor creado exitosamente.');
    }

    /**
     * Mostrar un proveedor específico.
     */
    public function show(Supplier $supplier)
    {
        $supplier->load('products', 'stockEntries');
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Mostrar el formulario para editar un proveedor.
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Actualizar un proveedor específico en la base de datos.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier->update($validated);
        
        return redirect()->route('suppliers.index')
            ->with('success', 'Proveedor actualizado exitosamente.');
    }

    /**
     * Eliminar un proveedor específico de la base de datos.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        
        return redirect()->route('suppliers.index')
            ->with('success', 'Proveedor eliminado exitosamente.');
    }
}