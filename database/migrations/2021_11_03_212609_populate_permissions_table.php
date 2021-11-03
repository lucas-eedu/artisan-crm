<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulatePermissionsTable extends Migration
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
            (1, 'Usuário - Listar', 'user_viewAny'),
            (2, 'Usuário - Editar', 'user_update'),
            (3, 'Usuário - Cadastrar', 'user_create'),
            (4, 'Usuário - Excluir', 'user_delete'),
            (5, 'Permissão - Listar', 'permission_viewAny'),
            (6, 'Permissão - Editar', 'permission_update'),
            (7, 'Permissão - Cadastrar', 'permission_create'),
            (8, 'Permissão - Excluir', 'permission_delete'),
            (9, 'Perfil - Listar', 'profile_viewAny'),
            (10, 'Perfil - Editar', 'profile_update'),
            (11, 'Perfil - Cadastrar', 'profile_create'),
            (12, 'Perfil - Excluir', 'profile_delete');
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
