<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compra extends Model
{
    protected $table = 'compras';

    protected $fillable = [
        'proveedor_id',
        'cantidad',
        'precio_unitario',
        'total',
        'fecha_compra',
        'observaciones',
        'numero_factura',
        'estado_factura',
        'fecha_vencimiento'
    ];

    protected $casts = [
        'fecha_compra' => 'date',
        'fecha_vencimiento' => 'date',
        'precio_unitario' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function getEstadoFacturaColorAttribute(): string
    {
        return match($this->estado_factura) {
            'pendiente' => 'yellow',
            'pagada' => 'green',
            'vencida' => 'red',
            default => 'gray'
        };
    }
}