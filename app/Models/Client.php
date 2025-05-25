<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address'
    ];

    /**
     * Obtener las salidas de stock asociadas con este cliente.
     */
    public function stockExits()
    {
        return $this->hasMany(StockExit::class);
    }
}