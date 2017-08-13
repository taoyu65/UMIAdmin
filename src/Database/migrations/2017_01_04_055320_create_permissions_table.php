<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umi_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->string('key', 10);
            $table->string('display_name', 30);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('umi_permission_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
        });

        #生成view
        #make view
        DB::statement("create view view_role_permission as select `umi_permissions`.`id` AS `id`,`umi_permission_role`.`role_id` AS `role_id`, `umi_roles`.`role_name` AS `role_name`,concat(`umi_permissions`.`key`,`umi_permissions`.`table_id`) AS `permission` from ((`umi_permissions` join `umi_permission_role` on((`umi_permissions`.`id` = `umi_permission_role`.`permission_id`))) join `umi_roles` on((`umi_permission_role`.`role_id` = `umi_roles`.`id`)))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('umi_permissions');
        Schema::drop('umi_permission_role');
    }
}
