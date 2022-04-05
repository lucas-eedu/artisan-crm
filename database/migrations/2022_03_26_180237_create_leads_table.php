<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->uuid('id')->primary()->nullable(false);
            $table->index('id');
            $table->string('name', 255)->nullable(true);
            $table->string('email');
            $table->string('phone', 11)->nullable(true);
            $table->text('message')->nullable(true);
            $table->enum('status', ['new', 'negotiation', 'gain', 'lost'])->default('new');

            $table->uuid('user_id')->nullable(true);
            $table->index('user_id');
            $table
                ->foreign('user_id', 'leads_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->uuid('company_id');
            $table->index('company_id');
            $table
                ->foreign('company_id', 'leads_company')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');

            $table->uuid('product_id');
            $table->index('product_id');
            $table
                ->foreign('product_id', 'leads_product')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->uuid('origin_id');
            $table->index('origin_id');
            $table
                ->foreign('origin_id', 'leads_origin')
                ->references('id')
                ->on('origins')
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
        Schema::dropIfExists('leads');
    }
}
