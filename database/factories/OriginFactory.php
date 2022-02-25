<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OriginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'       => $this->faker->company(),
            'status'     => $this->faker->randomElement(['active', 'inactive'])
        ];
    }
}
