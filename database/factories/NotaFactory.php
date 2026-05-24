<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(3),

            'contenido' => fake()->paragraph(),

            'categoria' => fake()->randomElement([
                'Personal',
                'Trabajo',
                'Estudio',
                'Ideas'
            ]),

            'fijada' => fake()->boolean(),
        ];
    }
}