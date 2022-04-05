<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            // Create products for a specific company
            ->for(Company::factory()->state([
                'id' => 'company-id-here',
            ]))
            ->count(10)
            ->create();
    }
}
