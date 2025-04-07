<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear productos con imágenes específicas
        $productosConImagenes = [
            [
                'nombre' => 'Figura coleccionable de Naruto',
                'descripcion' => 'Figura de acción de Naruto Uzumaki en pose de combate. Fabricada con materiales de alta calidad y detalles precisos. Altura aproximada: 20 cm.',
                'precio' => 299.99,
                'stock' => 15,
                'categoria' => 'Figura',
                'imagen' => 'productos/producto1.svg',
                'franquicia' => 'Naruto',
                'es_destacado' => true
            ],
            [
                'nombre' => 'Camiseta de Dragon Ball',
                'descripcion' => 'Camiseta oficial de Dragon Ball con estampado de Goku. 100% algodón, disponible en varias tallas. Perfecta para los fans de la serie.',
                'precio' => 149.50,
                'stock' => 25,
                'categoria' => 'Ropa',
                'imagen' => 'productos/producto2.svg',
                'franquicia' => 'Dragon Ball',
                'es_destacado' => true
            ],
            [
                'nombre' => 'La Leyenda de Zelda: Edición Especial',
                'descripcion' => 'Videojuego La Leyenda de Zelda en su edición especial que incluye contenido adicional, mapa del mundo y figura coleccionable de Link. Compatible con Nintendo Switch.',
                'precio' => 899.00,
                'stock' => 5,
                'categoria' => 'Videojuego',
                'imagen' => 'productos/producto3.svg',
                'franquicia' => 'La Leyenda de Zelda',
                'es_destacado' => true
            ]
        ];

        // Crear los productos con imágenes
        foreach ($productosConImagenes as $producto) {
            Producto::create($producto);
        }

        // Crear el resto de productos sin imágenes específicas
        Producto::factory()->count(47)->create();
    }
}
