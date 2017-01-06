<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_tab', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned();
            $table->string('tab_title');
            $table->integer('order')->unsigned();
            $table->timestamps();
        });

        Schema::create('search', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_tab_id')->unsigned();
            $table->string('field');
            $table->string('display_name');
            $table->string('type');
            $table->boolean('is_fuzzy')->default(1);
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
        Schema::drop('search_tab');
        Schema::drop('search');
    }
}
