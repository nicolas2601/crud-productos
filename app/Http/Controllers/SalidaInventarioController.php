<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalidaInventario;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SalidaInventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $salidas = SalidaInventario::with(['producto', 'clientes'])->latest()->paginate(10);
        return view('salidas.index', compact('salidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $productos = Producto::orderBy('nombre')->get();
        $clientes = Cliente::orderBy('nombre')->get();
        return view('salidas.create', compact('productos', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'nullable|string|max:255',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Validar que la cantidad no supere el stock actual
        if ($request->cantidad > $producto->stock) {
            return back()->withErrors(['cantidad' => 'La cantidad solicitada supera el stock disponible ('.$producto->stock.')'])->withInput();
        }

        DB::transaction(function () use ($request, $producto) {
            // Crear la salida de inventario
            $salida = SalidaInventario::create([
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad,
                'motivo' => $request->motivo,
                'fecha_salida' => now(),
            ]);

            // Asociar clientes si existen
            if($request->has('clientes')) {
                $salida->clientes()->sync($request->clientes);
            }

            // Actualizar el stock del producto
            $producto->stock -= $request->cantidad;
            $producto->save();
        });

        return redirect()->route('productos.index') // Redirigir a la lista de productos o a donde sea más conveniente
            ->with('success', 'Salida de inventario registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalidaInventario $salidaInventario): View
    {
        $salidaInventario->load('producto'); // Cargar la relación con el producto
        return view('salidas.show', compact('salidaInventario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalidaInventario $salidaInventario): View
    {
        // Por ahora, solo permitimos editar el motivo. Cargar producto para contexto.
        $salidaInventario->load('producto');
        // No necesitamos pasar $productos aquí a menos que permitamos cambiar el producto.
        return view('salidas.edit', compact('salidaInventario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalidaInventario $salidaInventario): RedirectResponse
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'fecha_salida' => 'required|date',
            'clientes' => 'required|array',
            'clientes.*' => 'exists:clientes,id'
        ]);

        $salidaInventario->update($request->all());
        $salidaInventario->clientes()->sync($request->clientes);

        return redirect()->route('salidas.index')
            ->with('success', 'Salida actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalidaInventario $salidaInventario): RedirectResponse
    {
        // Nota: Eliminar una salida no revierte automáticamente el stock.
        // Si se requiere revertir el stock, se necesitaría lógica adicional aquí.
        $salidaInventario->delete();

        return redirect()->route('salidas.index')
            ->with('success', 'Salida de inventario eliminada exitosamente.');
    }
}
