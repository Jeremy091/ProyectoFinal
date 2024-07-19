<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{

    protected $model = Producto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_producto' => $this->faker->sentence(),
            'descripcion_producto' => $this->faker->paragraph(),
            'precio_unitario' => $this->faker->randomFloat( 2, 0, 100),
            'categoria_id' => $this->faker->numberBetween(1, 9),
            
        ];
    }
}
