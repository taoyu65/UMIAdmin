<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
            $table->string('rule_name', 30);
            $table->string('custom_rule_name', 30);
            $table->string('operation_type', 10);
            $table->integer('active_table_id')->unsigned();
            $table->string('active_table_field', 30);
            $table->integer('response_table_id')->unsigned();
            $table->string('response_table_field', 30);
            $table->string('check_value', 30);
            $table->string('check_operation', 20);
            $table->boolean('is_extra_operation')->default(0);
            $table->string('details');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
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
