<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'contact_name',
        'email',
        'phone',
        'address'
    ];

    /**
     * Obtener los productos asociados con este proveedor.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Obtener las entradas de stock asociadas con este proveedor.
     */
    public function stockEntries()
    {
        return $this->hasMany(StockEntry::class);
    }
}