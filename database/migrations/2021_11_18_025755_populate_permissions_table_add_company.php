<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulatePermissionsTableAddCompany extends Migration
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
            (14, 'Empresa - Listar', 'company_viewAny'),
            (15, 'Empresa - Editar', 'company_update'),
            (16, 'Empresa - Cadastrar', 'company_create'),
            (17, 'Empresa - Excluir', 'company_delete');
        ");

        DB::statement("
            INSERT INTO `permission_profile` (`profile_id`, `permission_id`) VALUES
            (1, 14),
            (1, 15),
            (1, 16),
            (1, 17);
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
