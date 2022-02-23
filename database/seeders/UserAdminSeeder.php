<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'       => 'Admin',
            'email'      => 'admin@admin.com',
            'password'   => Hash::make('admin@123'),
            'profile_id' => 1,
            'status'     => 'active',
        ]);
    }
}
