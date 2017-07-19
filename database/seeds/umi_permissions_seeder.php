<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class umi_permissions_seeder extends Seeder
{
    public function run()
    {
        #目前有16个数据表, 初始化的时候并且id按照1-16整齐排列
        #total has 16 data tables, when init, id follow by 1-16
        for ($i = 1; $i <= 16; $i++) {
            DB::table('umi_permissions')->insert([
                array(
                    'id'        => $i * 5 - 4,
                    'table_id'  => $i,
                    'key'       => 'browser',
                    'display_name'  => '',
                ),
                array(
                    'id'        => $i * 5 - 3,
                    'table_id'  => $i,
                    'key'       => 'read',
                    'display_name'  => '',
                ),
                array(
                    'id'        => $i * 5 - 2,
                    'table_id'  => $i,
                    'key'       => 'edit',
                    'display_name'  => '',
                ),
                array(
                    'id'        => $i * 5 - 1,
                    'table_id'  => $i,
                    'key'       => 'add',
                    'display_name'  => '',
                ),
                array(
                    'id'        => $i * 5,
                    'table_id'  => $i,
                    'key'       => 'delete',
                    'display_name'  => '',
                )
            ]);
        }
    }
}