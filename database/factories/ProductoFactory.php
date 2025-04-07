<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Configurar el faker en español
        $this->faker = \Faker\Factory::create('es_ES');
        
        $categorias = ['Anime', 'Videojuego', 'Manga', 'Figura', 'Coleccionable', 'Ropa', 'Accesorio'];
        $franquicias = [
            'Naruto', 'Dragon Ball', 'One Piece', 'Ataque a los Titanes', 'My Hero Academia',
            'Final Fantasy', 'La Leyenda de Zelda', 'Pokemon', 'Super Mario', 'Resident Evil',
            'Demon Slayer', 'Jujutsu Kaisen', 'Genshin Impact', 'Persona', 'Kingdom Hearts'
        ];
        
        $nombresProductos = [
            'Figura coleccionable de {franquicia}',
            'Camiseta de {franquicia}',
            'Póster de {franquicia}',
            'Llavero de {franquicia}',
            'Taza de {franquicia}',
            'Manga de {franquicia} Vol. {num}',
            'Videojuego {franquicia} Edición Especial',
            'Peluche de {franquicia}',
            'Gorra de {franquicia}',
            'Sudadera de {franquicia}'
        ];
        
        $franquicia = $this->faker->randomElement($franquicias);
        $nombreBase = $this->faker->randomElement($nombresProductos);
        $nombre = str_replace(
            ['{franquicia}', '{num}'], 
            [$franquicia, $this->faker->numberBetween(1, 10)],
            $nombreBase
        );
        
        return [
            'nombre' => $nombre,
            'descripcion' => $this->faker->paragraph(3),
            'precio' => $this->faker->randomFloat(2, 10, 500),
            'stock' => $this->faker->numberBetween(0, 100),
            'categoria' => $this->faker->randomElement($categorias),
            'imagen' => null, // Las imágenes se crearán manualmente
            'franquicia' => $franquicia,
            'es_destacado' => $this->faker->boolean(20), // 20% de probabilidad de ser destacado
        ];
    }
}
