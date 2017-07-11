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
        Schema::create('umi_field_display_browser', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->string('field', 50);
            $table->string('type', 20);
            $table->string('relation_display', 80);
            $table->string('display_name', 30);
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_showing')->default(0);
            $table->timestamps();
        });

        #field_display_read
        Schema::create('umi_field_display_read', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->string('field', 50);
            $table->string('type', 20);
            $table->string('relation_display', 80);
            $table->string('display_name', 30);
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_showing')->default(0);
            $table->timestamps();
        });

        #field_display_edit
        Schema::create('umi_field_display_edit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->string('field', 50);
            $table->string('type', 20);
            $table->string('relation_display', 80);
            $table->text('custom_value');
            $table->string('display_name', 30);
            $table->text('validation');
            $table->string('details');
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_editable')->default(0);
            $table->timestamps();
        });

        #field_display_add
        Schema::create('umi_field_display_add', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->string('field', 50);
            $table->string('type', 20);
            $table->string('relation_display', 80);
            $table->text('custom_value');
            $table->string('display_name', 30);
            $table->text('validation');
            $table->string('details');
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_editable')->default(0);
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
        Schema::drop('umi_field_display_browser');
        Schema::drop('umi_field_display_read');
        Schema::drop('umi_field_display_edit');
        Schema::drop('umi_field_display_add');
    }
}
