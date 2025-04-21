<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompraController extends Controller
{
    public function index(): View
    {
        $compras = Compra::with('proveedor')
            ->orderBy('fecha_compra', 'desc')
            ->get();

        return view('compras.index', compact('compras'));
    }

    public function create(): View
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        return view('compras.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'fecha_compra' => 'required|date',
            'observaciones' => 'nullable|string',
            'numero_factura' => 'required|string',
            'estado_factura' => 'required|in:pendiente,pagada,vencida',
            'fecha_vencimiento' => 'required|date|after:fecha_compra'
        ]);

        $validated['total'] = $validated['cantidad'] * $validated['precio_unitario'];

        Compra::create($validated);

        return redirect()->route('compras.index')
            ->with('success', 'Compra registrada exitosamente');
    }

    public function show(Compra $compra): View
    {
        return view('compras.show', compact('compra'));
    }

    public function edit(Compra $compra): View
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        return view('compras.edit', compact('compra', 'proveedores'));
    }

    public function update(Request $request, Compra $compra)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'fecha_compra' => 'required|date',
            'observaciones' => 'nullable|string',
            'numero_factura' => 'required|string',
            'estado_factura' => 'required|in:pendiente,pagada,vencida',
            'fecha_vencimiento' => 'required|date|after:fecha_compra'
        ]);

        $validated['total'] = $validated['cantidad'] * $validated['precio_unitario'];

        $compra->update($validated);

        return redirect()->route('compras.index')
            ->with('success', 'Compra actualizada exitosamente');
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();

        return redirect()->route('compras.index')
            ->with('success', 'Compra eliminada exitosamente');
    }
}