<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria',
        'imagen',
        'franquicia',
    ];

    // Relación muchos a muchos con Proveedor
    public function proveedores()
    {
        return $this->belongsToMany(Proveedor::class, 'producto_proveedor')
                    ->withPivot('precio_compra') // Incluir el campo extra de la tabla pivote
                    ->withTimestamps(); // Mantener timestamps en la tabla pivote
    }

    // Relación uno a muchos con SalidaInventario
    public function salidasInventario()
    {
        return $this->hasMany(SalidaInventario::class);
    }

    /**
     * Obtener las entradas de inventario del producto.
     */
    public function entradas(): HasMany
    {
        return $this->hasMany(Entrada::class);
    }

    // Relación belongsTo con Proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}