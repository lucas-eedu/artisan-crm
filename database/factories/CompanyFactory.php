<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'segment' => 'Tech ou Software',
            'state' => 'CE',
            'number_employees' => '2-10',
            'status'     => $this->faker->randomElement(['active', 'inactive'])
        ];
    }
}
