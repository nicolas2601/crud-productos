<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Mostrar un listado de productos.
     */
    public function index()
    {
        $products = Product::with('suppliers')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Mostrar el formulario para crear un nuevo producto.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('products.create', compact('suppliers'));
    }

    /**
     * Almacenar un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'suppliers' => 'nullable|array',
            'suppliers.*' => 'exists:suppliers,id',
        ]);

        $product = new Product();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->stock = $validated['stock'];
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        }
        
        $product->save();
        
        if (isset($validated['suppliers'])) {
            $product->suppliers()->attach($validated['suppliers']);
        }
        
        return redirect()->route('products.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Mostrar un producto específico.
     */
    public function show(Product $product)
    {
        $product->load('suppliers', 'stockEntries.supplier', 'stockExits.client');
        return view('products.show', compact('product'));
    }

    /**
     * Mostrar el formulario para editar un producto.
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        $selectedSuppliers = $product->suppliers->pluck('id')->toArray();
        return view('products.edit', compact('product', 'suppliers', 'selectedSuppliers'));
    }

    /**
     * Actualizar un producto específico en la base de datos.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'suppliers' => 'nullable|array',
            'suppliers.*' => 'exists:suppliers,id',
        ]);

        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->stock = $validated['stock'];
        
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        }
        
        $product->save();
        
        // Sincronizar proveedores
        if (isset($validated['suppliers'])) {
            $product->suppliers()->sync($validated['suppliers']);
        } else {
            $product->suppliers()->detach();
        }
        
        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Eliminar un producto específico de la base de datos.
     */
    public function destroy(Product $product)
    {
        // Eliminar imagen si existe
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        
        $product->delete();
        
        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}