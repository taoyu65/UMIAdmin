<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class umi_table_seeder extends Seeder
{
    public function run()
    {
        DB::table('umi_tables')->insert([
            array(
                'id'    => 1,
                'table_name'    => 'umi_badges',
                'type'          => 'umi'
            ),
            array(
                'id'    => 2,
                'table_name'    => 'umi_field_display_browser',
                'type'          => 'umi'
            ),
            array(
                'id'    => 3,
                'table_name'    => 'umi_field_display_read',
                'type'          => 'umi'
            ),
            array(
                'id'    => 4,
                'table_name'    => 'umi_field_display_edit',
                'type'          => 'umi'
            ),
            array(
                'id'    => 5,
                'table_name'    => 'umi_field_display_add',
                'type'          => 'umi'
            ),
            array(
                'id'    => 6,
                'table_name'    => 'umi_menus',
                'type'          => 'umi'
            ),
            array(
                'id'    => 7,
                'table_name'    => 'umi_permission_role',
                'type'          => 'umi'
            ),
            array(
                'id'    => 8,
                'table_name'    => 'umi_permissions',
                'type'          => 'umi'
            ),
            array(
                'id'    => 9,
                'table_name'    => 'umi_roles',
                'type'          => 'umi'
            ),
            array(
                'id'    => 10,
                'table_name'    => 'umi_search',
                'type'          => 'umi'
            ),
            array(
                'id'    => 11,
                'table_name'    => 'umi_search_tab',
                'type'          => 'umi'
            ),
            array(
                'id'    => 12,
                'table_name'    => 'umi_table_relation_operation',
                'type'          => 'umi'
            ),
            array(
                'id'    => 13,
                'table_name'    => 'umi_tables',
                'type'          => 'umi'
            ),
            array(
                'id'    => 14,
                'table_name'    => 'umi_user_menu',
                'type'          => 'umi'
            ),
            array(
                'id'    => 15,
                'table_name'    => 'umi_user_role',
                'type'          => 'umi'
            ),
            array(
                'id'    => 16,
                'table_name'    => 'umi_users',
                'type'          => 'umi'
            )
        ]);
    }
}
