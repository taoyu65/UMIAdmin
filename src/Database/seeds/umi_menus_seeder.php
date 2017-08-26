<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class umi_menus_seeder extends Seeder
{
    public function run()
    {
        if (\YM\Models\Menu::count())
            DB::table('umi_menus')->truncate();

        DB::table('umi_menus')->insert([
            array(
                'id'        => 1,
                'menu_id'   => 0,
                'title'     => 'Dashboard',
                'url'       => 'dashboard',
                'target'    => '_self',
                'icon_class'=> 'fa-tachometer fa-teal',
                'order'     => 0,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 2,
                'menu_id'   => 0,
                'title'     => 'Field Display',
                'url'       => '#',
                'target'    => '_self',
                'icon_class'=> 'fa-desktop fa-pink',
                'order'     => 1,
                'extra_icon_html'   => '<i class="fa fa-laptop fa-green"></i>'
            ),
            array(
                'id'        => 3,
                'menu_id'   => 0,
                'title'     => 'Authority(BREAD)',
                'url'       => '#',
                'target'    => '_self',
                'icon_class'=> 'fa-list-alt fa-red',
                'order'     => 2,
                'extra_icon_html'   => '<span  class="pull-right fa-purple"><i class="fa fa-users"></i></span>'
            ),
            array(
                'id'        => 4,
                'menu_id'   => 0,
                'title'     => 'Side Menu',
                'url'       => '#',
                'target'    => '_self',
                'icon_class'=> 'fa-tree fa-green',
                'order'     => 3,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 5,
                'menu_id'   => 0,
                'title'     => 'Table Relation',
                'url'       => '#',
                'target'    => '_self',
                'icon_class'=> 'fa-list fa-purple',
                'order'     => 4,
                'extra_icon_html'   => '<span class="pull-right fa-orange"><i class="fa fa-cogs"></i></span> <span class="label pull-right bg-blue">17</span>'
            ),
            array(
                'id'        => 6,
                'menu_id'   => 0,
                'title'     => 'Table',
                'url'       => '#',
                'target'    => '_self',
                'icon_class'=> 'fa-pencil-square-o fa-orange',
                'order'     => 5,
                'extra_icon_html'   => '<span class="badge badge-danger">19</span>'
            ),
            array(
                'id'        => 7,
                'menu_id'   => 0,
                'title'     => 'Search',
                'url'       => '#',
                'target'    => '_self',
                'icon_class'=> 'fa-search fa-danger',
                'order'     => 6,
                'extra_icon_html'   => '<small class="label pull-right bg-teal">17</small>'
            ),
            array(
                'id'        => 8,
                'menu_id'   => 0,
                'title'     => 'Other',
                'url'       => '#',
                'target'    => '_self',
                'icon_class'=> 'fa-coffee fa-info',
                'order'     => 7,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 9,
                'menu_id'   => 2,
                'title'     => 'When Browser',
                'url'       => 'fieldDisplay/umi_field_display_browser/type/browser',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 0,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 10,
                'menu_id'   => 2,
                'title'     => 'When Read',
                'url'       => 'fieldDisplay/umi_field_display_read/type/read',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 1,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 11,
                'menu_id'   => 2,
                'title'     => 'When Edit',
                'url'       => 'fieldDisplay/umi_field_display_edit/type/edit',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 2,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 12,
                'menu_id'   => 2,
                'title'     => 'When Add',
                'url'       => 'fieldDisplay/umi_field_display_add/type/add',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 3,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 13,
                'menu_id'   => 3,
                'title'     => 'Role Management',
                'url'       => 'umiTable/umi_roles',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 0,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 14,
                'menu_id'   => 3,
                'title'     => 'Permission Management',
                'url'       => 'umiTable/umi_permissions',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 1,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 15,
                'menu_id'   => 3,
                'title'     => 'User-Role',
                'url'       => 'umiTable/umi_user_role',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 2,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 16,
                'menu_id'   => 3,
                'title'     => 'Role-Permission',
                'url'       => 'authority/role-permission',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 3,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 17,
                'menu_id'   => 3,
                'title'     => 'Distribute Wizard',
                'url'       => 'authority/permission/wizard',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 4,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 18,
                'menu_id'   => 4,
                'title'     => 'Management',
                'url'       => 'menuManagement/umi_menus',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 0,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 19,
                'menu_id'   => 4,
                'title'     => 'Distribution',
                'url'       => 'menuManagement/umi_menus/distribution',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 1,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 20,
                'menu_id'   => 5,
                'title'     => 'Show Relation',
                'url'       => 'umiTable/umi_table_relation_operation',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 0,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 21,
                'menu_id'   => 5,
                'title'     => 'Add Relation',
                'url'       => 'relationOpe/adding',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 1,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 22,
                'menu_id'   => 6,
                'title'     => 'All Tables',
                'url'       => 'umiTable',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 0,
                'extra_icon_html'   => '<i class="fa fa-table fa-pink"></i>'
            ),
            array(
                'id'        => 23,
                'menu_id'   => 6,
                'title'     => 'UMI Table',
                'url'       => '#',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 1,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 24,
                'menu_id'   => 6,
                'title'     => 'Custom Table',
                'url'       => '#',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 2,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 25,
                'menu_id'   => 23,
                'title'     => 'Badges',
                'url'       => 'umiTable/umi_badges',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 0,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 26,
                'menu_id'   => 23,
                'title'     => 'Field_display_browser',
                'url'       => 'umiTable/umi_field_display_browser',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 1,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 27,
                'menu_id'   => 23,
                'title'     => 'Field_display_read',
                'url'       => 'umiTable/umi_field_display_browser',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 2,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 28,
                'menu_id'   => 23,
                'title'     => 'Field_display_edit',
                'url'       => 'umiTable/umi_field_display_edit',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 3,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 29,
                'menu_id'   => 23,
                'title'     => 'Field_display_add',
                'url'       => 'umiTable/umi_field_display_add',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 4,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 30,
                'menu_id'   => 23,
                'title'     => 'Menus',
                'url'       => 'umiTable/umi_menus',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 5,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 31,
                'menu_id'   => 23,
                'title'     => 'Permission_role',
                'url'       => 'umiTable/umi_permission_role',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 6,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 32,
                'menu_id'   => 23,
                'title'     => 'Permissions',
                'url'       => 'umiTable/umi_permissions',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 7,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 33,
                'menu_id'   => 23,
                'title'     => 'Roles',
                'url'       => 'umiTable/umi_roles',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 8,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 34,
                'menu_id'   => 23,
                'title'     => 'Search',
                'url'       => 'umiTable/umi_search',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 9,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 35,
                'menu_id'   => 23,
                'title'     => 'Search Tab',
                'url'       => 'umiTable/umi_search_tab',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 10,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 36,
                'menu_id'   => 23,
                'title'     => 'Table Relation Operation',
                'url'       => 'umiTable/umi_table_relation_operation',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 11,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 37,
                'menu_id'   => 23,
                'title'     => 'Tables',
                'url'       => 'umiTable/umi_tables',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 12,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 38,
                'menu_id'   => 23,
                'title'     => 'User_menu',
                'url'       => 'umiTable/umi_user_menu',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 13,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 39,
                'menu_id'   => 23,
                'title'     => 'User_role',
                'url'       => 'umiTable/umi_user_role',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 14,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 40,
                'menu_id'   => 23,
                'title'     => 'Users',
                'url'       => 'umiTable/users',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 15,
                'extra_icon_html'   => '<i class="fa fa-user fa-orange"></i>'
            ),
            array(
                'id'        => 41,
                'menu_id'   => 7,
                'title'     => 'Tab Management',
                'url'       => 'umiTable/umi_search_tab',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 0,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 42,
                'menu_id'   => 7,
                'title'     => 'Search Content',
                'url'       => 'umiTable/umi_search',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 1,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 43,
                'menu_id'   => 8,
                'title'     => 'Table Management',
                'url'       => 'umiTable/umi_tables',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 0,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 44,
                'menu_id'   => 8,
                'title'     => 'Badge Management',
                'url'       => 'umiTable/umi_badges',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 1,
                'extra_icon_html'   => ''
            ),
            array(
                'id'        => 45,
                'menu_id'   => 8,
                'title'     => 'User Management',
                'url'       => 'umiTable/users',
                'target'    => '_self',
                'icon_class'=> '',
                'order'     => 2,
                'extra_icon_html'   => ''
            ),
        ]);
    }
}
