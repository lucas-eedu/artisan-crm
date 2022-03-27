<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id' => '0e990d10-3b8f-4d95-b193-6c11de977f6e',
            'product_id' => '1c3b8e68-2cb8-4cb2-b2d4-1cdcb78ece26',
            'origin_id'  => '4b1afce6-3928-401b-8477-a0b4d9e19887',
            'name'       => $this->faker->name(),
            'email'      => $this->faker->freeEmail(),
            'phone'      => Str::random(11),
            'message'    => $this->faker->text($maxNbChars = 200),
            'status'     => $this->faker->randomElement(['new', 'negotiation', 'gain', 'lost'])
        ];
    }
}
