<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use YM\Umi\Auth\AdminMasterPage;
use YM\Umi\Auth\SuperAdminMasterPage;

class FactoryMasterPage
{
    #生成左边栏菜单的对象
    #new a object for side menus
    public function getMasterPage()
    {
        $userName = Auth::user()->name;

        switch ($userName) {
            case Config::get('umi.super_admin'):
                return new SuperAdminMasterPage();
            default:
                return new AdminMasterPage();
        }
    }
}