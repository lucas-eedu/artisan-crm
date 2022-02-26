<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary()->nullable(false);
            $table->index('id');
            $table->string('name', 255);
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->uuid('company_id');
            $table->index('company_id');
            $table
                ->foreign('company_id', 'products_company')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_company');
            $table->dropColumn('company_id');
            $table->dropIfExists('products');
        });
    }
}
