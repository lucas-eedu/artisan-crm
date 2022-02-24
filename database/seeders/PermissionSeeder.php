<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating permissions
        DB::statement("
            INSERT INTO `permissions` (`id`, `name`, `code`) VALUES
            (1, 'User - List', 'user_viewAny'),
            (2, 'User - Edit', 'user_update'),
            (3, 'User - Create', 'user_create'),
            (4, 'User - Delete', 'user_delete'),
            (5, 'Permission - List', 'permission_viewAny'),
            (6, 'Permission - Edit', 'permission_update'),
            (7, 'Permission - Create', 'permission_create'),
            (8, 'Permission - Delete', 'permission_delete'),
            (9, 'Profile - List', 'profile_viewAny'),
            (10, 'Profile - Edit', 'profile_update'),
            (11, 'Profile - Create', 'profile_create'),
            (12, 'Profile - Delete', 'profile_delete'),
            (13, 'User - My Profile', 'user_myprofile'),
            (14, 'Company - List', 'company_viewAny'),
            (15, 'Company - Edit', 'company_update'),
            (16, 'Company - Create', 'company_create'),
            (17, 'Company - Delete', 'company_delete'),
            (18, 'Product - List', 'product_viewAny'),
            (19, 'Product - Edit', 'product_update'),
            (20, 'Product - Create', 'product_create'),
            (21, 'Product - Delete', 'product_delete'),
            (22, 'Origin - List', 'origin_viewAny'),
            (23, 'Origin - Edit', 'origin_update'),
            (24, 'Origin - Create', 'origin_create'),
            (25, 'Origin - Delete', 'origin_delete');
        ");
    }
}
