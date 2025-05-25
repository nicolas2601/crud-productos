<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class StockExit extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'exit_date' => 'date',
    ];

    protected $fillable = [
        'product_id',
        'client_id',
        'quantity',
        'exit_date',
        'notes'
    ];

    /**
     * Obtener el producto asociado con esta salida de stock.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Obtener el cliente asociado con esta salida de stock.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}