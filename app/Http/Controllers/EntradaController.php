<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class EntradaController extends Controller
{
    /**
     * Mostrar un listado de entradas de inventario.
     */
    public function index(): View
    {
        $entradas = Entrada::with(['proveedor', 'producto'])->latest()->paginate(10);
        return view('entradas.index', compact('entradas'));
    }

    /**
     * Mostrar el formulario para crear una nueva entrada de inventario.
     */
    public function create(): View
    {
        $proveedores = Proveedor::all();
        $productos = collect(); // Colección vacía inicialmente
        return view('entradas.create', compact('proveedores', 'productos'));
    }

    /**
     * Obtener productos por proveedor (para AJAX).
     */
    public function getProductosByProveedor(Request $request)
    {
        $productos = Producto::where('proveedor_id', $request->proveedor_id)->get();
        return response()->json($productos);
    }

    /**
     * Almacenar una nueva entrada de inventario en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedors,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'fecha' => 'required|date',
        ]);

        // Calcular subtotal y total
        $subtotal = $request->cantidad * $request->precio_unitario;
        $total = $subtotal; // En este caso son iguales, pero podría incluir impuestos, etc.

        DB::beginTransaction();

        try {
            // Crear la entrada
            $entrada = Entrada::create([
                'proveedor_id' => $request->proveedor_id,
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $request->precio_unitario,
                'subtotal' => $subtotal,
                'total' => $total,
                'fecha' => $request->fecha,
            ]);

            // Actualizar el stock del producto
            $producto = Producto::findOrFail($request->producto_id);
            $producto->stock += $request->cantidad;
            $producto->save();

            DB::commit();

            return redirect()->route('entradas.factura', $entrada->id)
                ->with('success', 'Entrada de inventario registrada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar la entrada: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Mostrar una entrada específica.
     */
    public function show(Entrada $entrada): View
    {
        return view('entradas.show', compact('entrada'));
    }

    /**
     * Mostrar la factura de una entrada.
     */
    public function factura(Entrada $entrada): View
    {
        return view('entradas.factura', compact('entrada'));
    }

    /**
     * Generar PDF de la factura.
     */
    public function generarPdf(Entrada $entrada)
    {
        $pdf = \PDF::loadView('entradas.pdf', compact('entrada'));
        return $pdf->download('factura-' . $entrada->id . '.pdf');
    }
}