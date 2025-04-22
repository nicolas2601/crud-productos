<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaInventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'cantidad',
        'fecha_salida',
        'motivo',
    ];

    protected $casts = [
        'fecha_salida' => 'datetime'
    ];

    /**
     * Obtener el producto al que pertenece la salida de inventario.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function proveedores()
    {
        return $this->belongsToMany(Proveedor::class, 'proveedor_salida_pivot');
    }
}
