<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Origin;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lead::factory()
            // Create leads for a specific company
            ->for(Company::factory()->state([
                'id' => 'company-id-here',
            ]))
            // Create leads for a specific product
            ->for(Product::factory()->state([
                'id' => 'product-id-here',
            ]))
            // Create leads for a specific origin
            ->for(Origin::factory()->state([
                'id' => 'origin-id-here',
            ]))
            ->count(50)
            ->create();
    }
}
