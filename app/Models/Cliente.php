<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'telefono'];

    public function salidas()
    {
        return $this->belongsToMany(SalidaInventario::class, 'cliente_salida');
    }
}
