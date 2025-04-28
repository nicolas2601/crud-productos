<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entrada extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'proveedor_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
        'total',
        'fecha',
    ];

    /**
     * Los atributos que deben convertirse a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * Obtener el proveedor al que pertenece la entrada.
     */
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    /**
     * Obtener el producto al que pertenece la entrada.
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}