<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulationPermissionsTableAddProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            INSERT INTO `permissions` (`id`, `name`, `code`) VALUES
            (18, 'Produto - Listar', 'product_viewAny'),
            (19, 'Produto - Editar', 'product_update'),
            (20, 'Produto - Cadastrar', 'product_create'),
            (21, 'Produto - Excluir', 'product_delete');
        ");

        DB::statement("
            INSERT INTO `permission_profile` (`profile_id`, `permission_id`) VALUES
            (2, 18),
            (2, 19),
            (2, 20),
            (2, 21);
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
