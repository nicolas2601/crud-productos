<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        $proveedores = [
            [
                'nombre' => 'Anime Imports México',
                'direccion' => 'Av. Revolución 1234, Ciudad de México',
                'email' => 'ventas@animeimports.mx',
                'telefono' => '55-1234-5678',
                'nit' => '123456789-0'
            ],
            [
                'nombre' => 'Gaming World Distribuidora',
                'direccion' => 'Calle Juegos 567, Guadalajara',
                'email' => 'contacto@gamingworld.com.mx',
                'telefono' => '33-9876-5432',
                'nit' => '987654321-0'
            ],
            [
                'nombre' => 'Manga Store Mayorista',
                'direccion' => 'Av. Otaku 890, Monterrey',
                'email' => 'ventas@mangastore.mx',
                'telefono' => '81-4567-8901',
                'nit' => '456789012-3'
            ],
            [
                'nombre' => 'Distribuidora Gamer Plus',
                'direccion' => 'Blvd. Consolas 432, Tijuana',
                'email' => 'info@gamerplus.mx',
                'telefono' => '664-234-5678',
                'nit' => '345678901-2'
            ],
            [
                'nombre' => 'Anime Collectibles México',
                'direccion' => 'Paseo Figuras 789, Puebla',
                'email' => 'ventas@animecollectibles.mx',
                'telefono' => '222-890-1234',
                'nit' => '567890123-4'
            ]
        ];

        foreach ($proveedores as $proveedor) {
            Proveedor::create($proveedor);
        }
    }
}