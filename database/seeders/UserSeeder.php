<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            // Create users for a specific company
            ->for(Company::factory()->state([
                'id' => 'company-id-here',
            ]))
            ->count(10)
            ->create();
    }
}
