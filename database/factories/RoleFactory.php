<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => $this->faker->unique()->word(),
        ];
    }
}
