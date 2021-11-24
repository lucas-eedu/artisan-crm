<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulationPermissionsTableAddOrigin extends Migration
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
            (22, 'Origem - Listar', 'origin_viewAny'),
            (23, 'Origem - Editar', 'origin_update'),
            (24, 'Origem - Cadastrar', 'origin_create'),
            (25, 'Origem - Excluir', 'origin_delete');
        ");

        DB::statement("
            INSERT INTO `permission_profile` (`profile_id`, `permission_id`) VALUES
            (2, 22),
            (2, 23),
            (2, 24),
            (2, 25);
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
