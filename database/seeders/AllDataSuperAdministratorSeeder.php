<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\User;
use App\Models\Origin;
use App\Models\Company;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AllDataSuperAdministratorSeeder extends Seeder
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::create([
            'name'             => 'ArtisanCRM',
            'segment'          => 'Tech ou Software',
            'state'            => 'CE',
            'number_employees' => '2-10',
            'status'           => 'active'
        ]);

        $userSuper = User::create([
            'name'              => 'Super Administrator',
            'email'             => 'super@artisancrm.com.br',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin@123'),
            'company_id'        => $company->id,
            'profile_id'        => 1,
            'status'            => 'active',
        ]);

        $userAdmin = User::create([
            'name'              => 'Administrator',
            'email'             => 'admin@artisancrm.com.br',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin@123'),
            'company_id'        => $company->id,
            'profile_id'        => 2,
            'status'            => 'active',
        ]);

        $userSeller = User::create([
            'name'              => 'Seller',
            'email'             => 'seller@artisancrm.com.br',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin@123'),
            'company_id'        => $company->id,
            'profile_id'        => 3,
            'status'            => 'active',
        ]);

        $product = Product::create([
            'name'       => 'ArtisanCRM',
            'company_id' => $company->id,
            'status'     => 'active'
        ]);

        $origin = Origin::create([
            'name'       => 'Website',
            'company_id' => $company->id,
            'status'     => 'active'
        ]);

        for ($i=0; $i < 500; $i++) {
            Lead::create([
                'company_id' => $company->id,
                'product_id' => $product->id,
                'origin_id'  => $origin->id,
                'user_id'    => $userSeller->id,
                'name'       => $this->faker->name(),
                'email'      => $this->faker->freeEmail(),
                'phone'      => rand(00000000000, 99999999999),
                'message'    => $this->faker->text($maxNbChars = 1000),
                'status'     => $this->faker->randomElement(['new', 'negotiation', 'gain', 'lost']),
                'created_at' => date('Y-') . rand(1, 12) . date('-d H:i:s')
            ]);
        }
    }
}
