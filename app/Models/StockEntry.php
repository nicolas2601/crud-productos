<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockEntry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'quantity',
        'entry_date',
        'notes'
    ];
    
    protected $casts = [
        'entry_date' => 'date'
    ];

    /**
     * Obtener el producto asociado con esta entrada de stock.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Obtener el proveedor asociado con esta entrada de stock.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}