<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanyAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            $company = Company::create([
                'name' => Str::random(6) . 'seeder',
                'segment' => 'Tech ou Software',
                'state' => 'CE',
                'number_employees' => '2-10',
                'status' => 'active',
            ]);

            $company->users()->create([
                'name'       => Str::random(6) . 'seeder',
                'email'      => Str::random(6) . '@gmail.com',
                'password'   => Hash::make('admin@123'),
                'profile_id' => 2,
                'company_id' => $company->id,
                'status'     => 'active',
            ]);
        }
    }
}
