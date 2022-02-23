<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(PermissionProfilerSeeder::class);
        $this->call(UserAdminSeeder::class);
        $this->call(CompanyAndUserSeeder::class);
    }
}
