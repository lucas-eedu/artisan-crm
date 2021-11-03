<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_id`) VALUES
            (1, 'Lucas Eduardo', 'lucas01.dev@gmail.com', '" . bcrypt('server@123') . "', 1);
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            delete from users;
        ");
    }
}
