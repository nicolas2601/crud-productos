<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    /**
     * Muestra un listado de todos los productos.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => 'required|string|max:255',
            'franquicia' => 'nullable|string|max:255',
            'es_destacado' => 'boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('productos', 'public');
            $validated['imagen'] = $imagenPath;
        }

        Producto::create($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Muestra un producto específico.
     */
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Actualiza un producto específico en la base de datos.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => 'required|string|max:255',
            'franquicia' => 'nullable|string|max:255',
            'es_destacado' => 'boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            
            $imagenPath = $request->file('imagen')->store('productos', 'public');
            $validated['imagen'] = $imagenPath;
        }

        $producto->update($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Elimina un producto específico de la base de datos (soft delete).
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
    
    /**
     * Muestra la lista de productos eliminados (papelera).
     */
    public function papelera()
    {
        $productosEliminados = Producto::onlyTrashed()->get();
        return view('productos.papelera', compact('productosEliminados'));
    }
    
    /**
     * Restaura un producto eliminado.
     */
    public function restaurar($id)
    {
        $producto = Producto::onlyTrashed()->findOrFail($id);
        $producto->restore();
        
        return redirect()->route('productos.papelera')
            ->with('success', 'Producto restaurado exitosamente.');
    }
    
    /**
     * Elimina permanentemente un producto.
     */
    public function eliminarPermanente($id)
    {
        $producto = Producto::onlyTrashed()->findOrFail($id);
        
        // Eliminar la imagen si existe
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }
        
        $producto->forceDelete();
        
        return redirect()->route('productos.papelera')
            ->with('success', 'Producto eliminado permanentemente.');
    }
}