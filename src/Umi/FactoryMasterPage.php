<?php

namespace YM\Umi;

use YM\Umi\Auth\AdminMasterPage;
use YM\Umi\Auth\SuperAdminMasterPage;

class FactoryMasterPage
{
    private $administrator;

    public function __construct()
    {
        $this->administrator = new administrator();
    }

    #生成左边栏菜单的对象
    #new a object for side menus
    public function getMasterPage()
    {
        if ($this->administrator->isSuperAdmin()) {
            return new SuperAdminMasterPage();
        } else {
            return new AdminMasterPage();
        }
    }
}