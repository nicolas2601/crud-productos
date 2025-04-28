<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory, SoftDeletes;

    // Relación muchos a muchos con Producto
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_proveedor');
    }

    public function salidas()
    {
        return $this->belongsToMany(SalidaInventario::class, 'proveedor_salida_pivot');
    }

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'proveedors';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'empresa',
        'contacto',
    ];

    /**
     * Obtener las entradas de inventario del proveedor.
     */
    public function entradas(): HasMany
    {
        return $this->hasMany(Entrada::class);
    }
}