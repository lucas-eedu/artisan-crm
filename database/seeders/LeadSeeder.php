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
            ->state([
                'company_id' => 'company-id-here',
                'product_id' => 'product-id-here',
                'origin_id'  => 'origin-id-here',
            ])
            ->count(10)
            ->create();
    }
}
