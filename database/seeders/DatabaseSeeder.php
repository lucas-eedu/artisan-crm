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
        $this->call([
            PermissionSeeder::class,
            ProfileSeeder::class,
            PermissionProfilerSeeder::class,
            UserAdminSeeder::class,
            CompanyAllDataSeeder::class,
        ]);
    }
}
