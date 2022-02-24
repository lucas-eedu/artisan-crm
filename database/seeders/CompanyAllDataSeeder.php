<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanyAllDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) { 
            $company = Company::create([
                'name' => Str::random(4) . 'CompanySeeder',
                'segment' => 'Tech ou Software',
                'state' => 'CE',
                'number_employees' => '2-10',
                'status' => 'active',
            ]);

            for ($cont=0; $cont < 5; $cont++) {
                $company->users()->create([
                    'name'       => Str::random(4) . 'UserSeeder',
                    'email'      => Str::random(4) . '@seeder.com',
                    'password'   => Hash::make('admin@123'),
                    'profile_id' => 2,
                    'company_id' => $company->id,
                    'status'     => 'active',
                ]);

                $company->products()->create([
                    'name'       => Str::random(4) . 'ProductSeeder',
                    'company_id' => $company->id,
                    'status'     => 'active'
                ]);

                $company->origins()->create([
                    'name'       => Str::random(6) . 'OriginSeeder',
                    'company_id' => $company->id,
                    'status'     => 'active'
                ]);
            }
        }
    }
}
