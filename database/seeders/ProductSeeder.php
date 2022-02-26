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
            ->for(Company::factory()->create())
            // Use state to create products for a specific company
            // ->for(Company::factory()->state([
            //     'id' => '189b3a2a-c1e6-4b83-9601-e2ac8c2059f8',
            // ]))
            ->count(10)
            ->create();
    }
}
