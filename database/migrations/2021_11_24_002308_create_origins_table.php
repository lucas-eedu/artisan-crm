<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOriginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('origins', function (Blueprint $table) {
            $table->uuid('id')->primary()->nullable(false);
            $table->index('id');
            $table->string('name', 255);
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->uuid('company_id');
            $table->index('company_id');
            $table
                ->foreign('company_id', 'origins_company')
                ->references('id')
                ->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('origins', function (Blueprint $table) {
            $table->dropForeign('origins_company');
            $table->dropColumn('company_id');
            $table->dropIfExists('origins');
        });
    }
}
