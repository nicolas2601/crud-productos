<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Entrada;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function create()
    {
        $productos = Producto::all();
        return view('entradas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'observacion' => 'nullable|string|max:255'
        ]);

        $entrada = new Entrada([
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'fecha' => $request->fecha,
            'observacion' => $request->observacion
        ]);

        $entrada->save();

        // Actualizar el stock del producto
        $producto = Producto::find($request->producto_id);
        $producto->stock += $request->cantidad;
        $producto->save();

        return redirect()->route('productos.index')
            ->with('success', 'Entrada registrada correctamente');
    }
}