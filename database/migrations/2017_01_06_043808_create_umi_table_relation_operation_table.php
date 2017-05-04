<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUmiTableRelationOperationTable extends Migration
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
            $table->string('rule_name');
            $table->string('custom_rule_name');
            $table->string('operation_type');
            $table->integer('active_table_id')->unsigned();
            $table->string('active_table_field');
            $table->integer('response_table_id')->unsigned();
            $table->string('response_table_field');
            $table->string('field_display');
            $table->string('check_value');
            $table->string('check_operation', 20);
            $table->boolean('is_extra_operation')->default(0);
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
