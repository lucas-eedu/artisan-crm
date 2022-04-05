<?php

namespace Database\Seeders;

use App\Models\Origin;
use App\Models\Company;
use Illuminate\Database\Seeder;

class OriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Origin::factory()
            // Create origins for a specific company
            ->for(Company::factory()->state([
                'id' => 'company-id-here',
            ]))
            ->count(10)
            ->create();
    }
}
