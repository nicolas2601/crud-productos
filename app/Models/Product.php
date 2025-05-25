<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_path'
    ];

    /**
     * Obtener los proveedores asociados con este producto.
     */
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    /**
     * Obtener las entradas de stock asociadas con este producto.
     */
    public function stockEntries()
    {
        return $this->hasMany(StockEntry::class);
    }

    /**
     * Obtener las salidas de stock asociadas con este producto.
     */
    public function stockExits()
    {
        return $this->hasMany(StockExit::class);
    }
}
