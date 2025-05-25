<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockEntry;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockEntryController extends Controller
{
    /**
     * Mostrar un listado de entradas de stock.
     */
    public function index()
    {
        $stockEntries = StockEntry::with(['product', 'supplier'])->get();
        return view('stock-entries.index', compact('stockEntries'));
    }

    /**
     * Mostrar el formulario para crear una nueva entrada de stock.
     */
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('stock-entries.create', compact('products', 'suppliers'));
    }

    /**
     * Almacenar una nueva entrada de stock en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'entry_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $stockEntry = StockEntry::create($validated);
        
        // Actualizar el stock del producto
        $product = Product::findOrFail($validated['product_id']);
        $product->stock += $validated['quantity'];
        $product->save();
        
        return redirect()->route('stock-entries.index')
            ->with('success', 'Entrada de stock registrada exitosamente.');
    }

    /**
     * Mostrar una entrada de stock específica.
     */
    public function show(StockEntry $stockEntry)
    {
        $stockEntry->load(['product', 'supplier']);
        return view('stock-entries.show', compact('stockEntry'));
    }

    /**
     * Mostrar el formulario para editar una entrada de stock.
     */
    public function edit(StockEntry $stockEntry)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('stock-entries.edit', compact('stockEntry', 'products', 'suppliers'));
    }

    /**
     * Actualizar una entrada de stock específica en la base de datos.
     */
    public function update(Request $request, StockEntry $stockEntry)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'entry_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Restaurar el stock anterior
        $product = Product::findOrFail($stockEntry->product_id);
        $product->stock -= $stockEntry->quantity;
        
        // Actualizar la entrada de stock
        $stockEntry->update($validated);
        
        // Si el producto ha cambiado, actualizar el stock del nuevo producto
        if ($stockEntry->product_id != $validated['product_id']) {
            $product->save(); // Guardar el stock actualizado del producto anterior
            $product = Product::findOrFail($validated['product_id']);
        }
        
        // Añadir la nueva cantidad al stock
        $product->stock += $validated['quantity'];
        $product->save();
        
        return redirect()->route('stock-entries.index')
            ->with('success', 'Entrada de stock actualizada exitosamente.');
    }

    /**
     * Eliminar una entrada de stock específica de la base de datos.
     */
    public function destroy(StockEntry $stockEntry)
    {
        // Actualizar el stock del producto
        $product = Product::findOrFail($stockEntry->product_id);
        $product->stock -= $stockEntry->quantity;
        $product->save();
        
        $stockEntry->delete();
        
        return redirect()->route('stock-entries.index')
            ->with('success', 'Entrada de stock eliminada exitosamente.');
    }
}