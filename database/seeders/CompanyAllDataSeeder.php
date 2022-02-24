<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Origin;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CompanyAllDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()
            ->has(User::factory()->count(5), 'users')
            ->has(Product::factory()->count(5), 'products')
            ->has(Origin::factory()->count(5), 'origins')
            ->count(10)
            ->create();
    }
}
