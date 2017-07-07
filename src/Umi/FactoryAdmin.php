<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use YM\Umi\Admin\GeneralAdmin;
use YM\Umi\Admin\SuperAdmin;
use YM\Umi\Auth\AdminMasterPage;
use YM\Umi\Auth\SuperAdminMasterPage;

class FactoryAdmin
{
    private $userName;

    function __construct()
    {
        $this->userName = Auth::user()->name;
    }

    #展现用户数据表的browser信息, 以及定制页面
    #explore the browser table information with special and customize function
    public function getAdmin()
    {
        switch ($this->userName) {
            case Config::get('umi.system_role.super_admin'):
                return new SuperAdmin();
            #可以扩展你特有的用户(比如一些只有这个用户拥有的功能)
            #you can extend your own user who has some special and unique function
            default:
                return new GeneralAdmin();
        }
    }

    #展现master page 包括左边栏菜单 可以自定义不同风格
    #explore master page including the side menus and can be customized
    public function getMasterPage()
    {
        switch ($this->userName) {
            case Config::get('umi.system_role.super_admin'):
                return new SuperAdminMasterPage();
            #可以扩展你特有的用户(比如一些只有这个用户拥有的功能)
            #you can extend your own user who has some special and unique function
            default:
                return new AdminMasterPage();
        }
    }
}