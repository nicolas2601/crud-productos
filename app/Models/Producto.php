<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory, SoftDeletes;
    
    /**
     * Los atributos que son asignables masivamente.
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
        'es_destacado'
    ];
    
    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'precio' => 'decimal:2',
        'es_destacado' => 'boolean',
    ];
}
