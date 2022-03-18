<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('profile_id')->nullable()->after('remember_token');
            $table->index('profile_id');

            $table
                ->foreign('profile_id', 'users_profile')
                ->references('id')
                ->on('profiles')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_profile');
            $table->dropColumn('profile_id');
        });
    }
}
