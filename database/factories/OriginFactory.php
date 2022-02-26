<?php

namespace Database\Factories;

use App\Models\Origin;
use Illuminate\Database\Eloquent\Factories\Factory;

class OriginFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Origin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Google', 'Instagram', 'Facebook', 'Linkedin', 'TikTok', 'Email', 'Website', 'Landing Page']),
            'status' => $this->faker->randomElement(['active', 'inactive'])
        ];
    }
}
