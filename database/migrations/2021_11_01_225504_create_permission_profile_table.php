<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_profile', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->uuid('permission_id')->nullable(false);
            $table->index('permission_id');

            $table->uuid('profile_id')->nullable(false);
            $table->index('profile_id');

            $table
                ->foreign('permission_id', 'permission_profile')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table
                ->foreign('profile_id', 'profile_permission')
                ->references('id')
                ->on('profiles')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_profile');
    }
}
