<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umi_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name')->unique();
            $table->string('display_name');
            $table->timestamps();
        });

        Schema::create('umi_role_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->text('json');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('umi_roles');
        Schema::drop('umi_role_menu');
    }
}
