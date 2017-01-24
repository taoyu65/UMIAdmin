<?php

namespace YM\Umi\Auth;

use Illuminate\Support\Facades\Config;
use YM\Umi\Contracts\Auth\MenuAuthInterface;
use YM\Models\Menu;
use YM\Umi\MenuRole;

class MenuAuth implements MenuAuthInterface
{
    private $userName;
    private $userId;

    public function __construct($user)
    {
        $this->userName = $user->name;
        $this->userId = $user->id;
    }

    public function isSuperAdmin()
    {
        return $this->userName === Config::get('umi.super_admin');
    }

    public function menuAttributions()
    {
        if ($this->isSuperAdmin()) {
            return Menu::all();
        } else {
            return $this->loadMenu();
        }
    }

    private function loadMenu()
    {
        //1.找出所有所属于的角色
        //2.根据角色 找出所有 menu
        //3.所有menu_role的 数据均为最底部的菜单数据(不会再有底下的分支)
        //4. 建立一个类 用于操作menu_role 增删改 比较复杂
        $menuRole = new MenuRole();
        dd($menuRole->rootMenu());
        return 'loadmenu';
    }
}