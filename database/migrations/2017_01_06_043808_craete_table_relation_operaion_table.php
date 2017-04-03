<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraeteTableRelationOperaionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umi_table_relation_operation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('active_table_id')->unsigned();
            $table->string('active_table_field');
            $table->string('special_relation');
            $table->string('response_action');
            $table->integer('response_table_id');
            $table->string('where');
            $table->string('field_display');
            $table->string('details');
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
        Schema::drop('umi_table_relation_operation');
    }
}
