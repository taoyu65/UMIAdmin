<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldDisplayBreadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #field_display_browser
        Schema::create('field_display_browser', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->string('field');
            $table->string('type');
            $table->string('relation_display');
            $table->string('display_name');
            $table->timestamps();
        });

        #field_display_read
        Schema::create('field_display_read', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->string('field');
            $table->string('type');
            $table->string('relation_display');
            $table->string('display_name');
            $table->timestamps();
        });

        #field_display_edit
        Schema::create('field_display_edit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->string('field');
            $table->string('type');
            $table->string('relation_display');
            $table->string('display_name');
            $table->string('validation');
            $table->string('details');
            $table->timestamps();
        });

        #field_display_add
        Schema::create('field_display_add', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->string('field');
            $table->string('type');
            $table->string('relation_display');
            $table->string('display_name');
            $table->string('validation');
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
        Schema::drop('field_display_browser');
        Schema::drop('field_display_read');
        Schema::drop('field_display_edit');
        Schema::drop('field_display_add');
    }
}
