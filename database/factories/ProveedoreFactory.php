<?php

namespace Database\Factories;

use App\Models\Proveedore;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedore>
 */
class ProveedoreFactory extends Factory
{
    protected $model = Proveedore::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_proveedor' => $this->faker->company(),  // Genera un nombre de empresa
            'direccion_proveedor' => $this->faker->address(),  // Genera una dirección
            'telefono_proveedor' => $this->faker->phoneNumber(),  // Genera un número de teléfono
            'email_proveedor' => $this->faker->unique()->safeEmail(),  // Genera un correo electrónico único
        ];        
    }
}
