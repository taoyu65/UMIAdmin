<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ip_info_rate_seeder extends Seeder
{
    public function run()
    {
        DB::table('ip_info_rate')->insert([
            array(
                'period'    => '2017-Jan'
            ),
            array(
                'period'    => '2017-Feb'
            ),
            array(
                'period'    => '2017-Mar'
            ),
            array(
                'period'    => '2017-Apr'
            ),
            array(
                'period'    => '2017-May'
            ),
            array(
                'period'    => '2017-Jun'
            ),
            array(
                'period'    => '2017-Jul'
            ),
            array(
                'period'    => '2017-Aug'
            ),
            array(
                'period'    => '2017-Sep'
            ),
            array(
                'period'    => '2017-Oct'
            ),
            array(
                'period'    => '2017-Nov'
            ),
            array(
                'period'    => '2017-Dec'
            )
        ]);
    }
}
