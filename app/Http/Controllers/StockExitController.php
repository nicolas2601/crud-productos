<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\StockExit;
use Illuminate\Http\Request;

class StockExitController extends Controller
{
    /**
     * Mostrar un listado de salidas de stock.
     */
    public function index()
    {
        $stockExits = StockExit::with(['product', 'client'])->get();
        return view('stock-exits.index', compact('stockExits'));
    }

    /**
     * Mostrar el formulario para crear una nueva salida de stock.
     */
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        $clients = Client::all();
        return view('stock-exits.create', compact('products', 'clients'));
    }

    /**
     * Almacenar una nueva salida de stock en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'client_id' => 'nullable|exists:clients,id',
            'quantity' => 'required|integer|min:1',
            'exit_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Verificar que hay suficiente stock
        $product = Product::findOrFail($validated['product_id']);
        
        if ($product->stock < $validated['quantity']) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['quantity' => 'No hay suficiente stock disponible. Stock actual: ' . $product->stock]);
        }
        
        $stockExit = StockExit::create($validated);
        
        // Actualizar el stock del producto
        $product->stock -= $validated['quantity'];
        $product->save();
        
        return redirect()->route('stock-exits.index')
            ->with('success', 'Salida de stock registrada exitosamente.');
    }

    /**
     * Mostrar una salida de stock específica.
     */
    public function show(StockExit $stockExit)
    {
        $stockExit->load(['product', 'client']);
        return view('stock-exits.show', compact('stockExit'));
    }

    /**
     * Mostrar el formulario para editar una salida de stock.
     */
    public function edit(StockExit $stockExit)
    {
        $products = Product::all();
        $clients = Client::all();
        return view('stock-exits.edit', compact('stockExit', 'products', 'clients'));
    }

    /**
     * Actualizar una salida de stock específica en la base de datos.
     */
    public function update(Request $request, StockExit $stockExit)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'client_id' => 'nullable|exists:clients,id',
            'quantity' => 'required|integer|min:1',
            'exit_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Restaurar el stock anterior
        $product = Product::findOrFail($stockExit->product_id);
        $product->stock += $stockExit->quantity;
        
        // Si el producto ha cambiado, guardar el stock del producto anterior
        if ($stockExit->product_id != $validated['product_id']) {
            $product->save();
            $product = Product::findOrFail($validated['product_id']);
        }
        
        // Verificar que hay suficiente stock para la nueva cantidad
        if ($product->stock < $validated['quantity']) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['quantity' => 'No hay suficiente stock disponible. Stock actual: ' . $product->stock]);
        }
        
        // Actualizar la salida de stock
        $stockExit->update($validated);
        
        // Restar la nueva cantidad al stock
        $product->stock -= $validated['quantity'];
        $product->save();
        
        return redirect()->route('stock-exits.index')
            ->with('success', 'Salida de stock actualizada exitosamente.');
    }

    /**
     * Eliminar una salida de stock específica de la base de datos.
     */
    public function destroy(StockExit $stockExit)
    {
        // Restaurar el stock del producto
        $product = Product::findOrFail($stockExit->product_id);
        $product->stock += $stockExit->quantity;
        $product->save();
        
        $stockExit->delete();
        
        return redirect()->route('stock-exits.index')
            ->with('success', 'Salida de stock eliminada exitosamente.');
    }
}