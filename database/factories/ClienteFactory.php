<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_cliente' => $this->faker->firstName(),  // Genera un nombre de pila
            'apellido_cliente' => $this->faker->lastName(),  // Genera un apellido
            'direccion_cliente' => $this->faker->address(),  // Genera una dirección
            'telefono_cliente' => $this->faker->phoneNumber(),  // Genera un número de teléfono
            'email_cliente' => $this->faker->unique()->safeEmail(),  // Genera un correo electrónico único
        ];
    }
}
