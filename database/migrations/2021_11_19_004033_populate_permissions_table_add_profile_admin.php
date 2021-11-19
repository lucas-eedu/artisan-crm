<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulatePermissionsTableAddProfileAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            INSERT INTO `profiles` (`id`, `name`) VALUES
            (2, 'Administrator');
        ");

        DB::statement("
            INSERT INTO `permission_profile` (`profile_id`, `permission_id`) VALUES
            (2, 13);
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
