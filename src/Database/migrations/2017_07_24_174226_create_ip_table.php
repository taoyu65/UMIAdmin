<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateIpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name', 50);
            $table->string('ip', 20);
            $table->string('country', 50);
            $table->string('region', 50);
            $table->string('city', 50);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::create('ip_info_rate', function (Blueprint $table) {
            $table->string('period', 10);
            $table->integer('rate')->default(0);
            $table->smallInteger('order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ip_info');
        Schema::drop('ip_info_rate');
    }
}
