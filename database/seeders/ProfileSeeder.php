<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adding user profiles
        DB::statement("
            INSERT INTO `profiles` (`id`, `name`) VALUES
            (1, 'SuperAdministrator'),
            (2, 'Administrator');
        ");
    }
}
