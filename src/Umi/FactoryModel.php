<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Config;
use YM\Models\Menu;
use YM\Models\User;

class FactoryModel
{
    public function getInstance($tableName)
    {
        $list = Config::get('umiEnum.system_table_name');
        switch ($tableName) {
            case $list['umi_users']:
                return new User();
            case $list['umi_menus']:
                return new Menu();
            default:
                return null;
        }
    }
}