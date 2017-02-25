<?php

namespace YM\Umi;

use YM\Models\Menu;
use Exception;

class Menus
{
    private $menus;

    public function __construct()
    {
        $this->menus = new Menu();
    }

    #超级用户获取全部菜单权限
    #super admin can get all menus
    public function AllMenus()
    {
        $html = $this->dashboard();
        $html .= $this->recursionAllMenus(0);
        return $html;
    }

    #根据权限获取部分菜单
    #get part of menus according to the authorization
    public function Menus($json)
    {
        $html = $this->dashboard();
        try {
            $jsonMenus = json_decode($json);
            $html .= $this->recursionPartMenus($jsonMenus);
            return $html;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function dashboard()
    {
        $dashboard = route('dashboard');
        $html = <<<EOD
        <li class="active">
		    <a href="$dashboard">
			    <i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>
            <b class="arrow"></b>
		</li>
EOD;
        return $html;
    }

    private function recursionPartMenus($jsonMenus, $levelInit = 0)
    {
        $html = '';
        $level = 0;
        $level .= $levelInit;
        foreach ($jsonMenus as $jsonMenu) {
            $objMenu = $this->menus->getOneMenu($jsonMenu->id);
            $rootMenu = $level == 0 ? '<span class="menu-text">' . $objMenu->title . '</span>' : $objMenu->title;
            if (array_key_exists('children', $jsonMenu)){
                $html .= <<<EOD
                <li class="">
                    <a href="$objMenu->url" target="$objMenu->target" class="dropdown-toggle">
			            <i class="menu-icon fa $objMenu->icon_class"></i>
			            $rootMenu
			            <b class="arrow fa fa-angle-down"></b>
		            </a>
                    <b class="arrow"></b>
EOD;
                $html .= '<ul class="submenu">';
                $html .= $this->recursionPartMenus($jsonMenu->children, 1);
                $html .= '</ul>';
                $html .= '</li>';
            } else {
                $html .= <<<EOD
                <li class="">
                    <a href="$objMenu->url" target="$objMenu->target">
			            <i class="menu-icon fa $objMenu->icon_class"></i>
			        $rootMenu
		            </a>
                    <b class="arrow"></b>
                </li>
EOD;
            }

        }
        return $html;
    }

    private function recursionAllMenus($menu_id = 0)
    {
        $menus = $this->menus->getMenus($menu_id);
        $html = '';
        foreach ($menus as $menu) {
            $rootMenu = $menu_id == 0 ? '<span class="menu-text">' . $menu->title . '</span>' : $menu->title;
            if ($this->menus->isSubMenu($menu->id)) {
                $html .= <<<EOD
                <li class="">
                    <a href="$menu->url" target="$menu->target" class="dropdown-toggle">
			            <i class="menu-icon fa $menu->icon_class"></i>
			            $rootMenu
			            <b class="arrow fa fa-angle-down"></b>
		            </a>
                    <b class="arrow"></b>
EOD;
                $html .= '<ul class="submenu">';
                $html .= $this->recursionAllMenus($menu->id);
                $html .= '</ul>';
                $html .= '</li>';
            } else {
                $html .= <<<EOD
                <li class="">
                    <a href="$menu->url" target="$menu->target">
			            <i class="menu-icon fa $menu->icon_class"></i>
			        $rootMenu
		            </a>
                    <b class="arrow"></b>
                </li>
EOD;
            }
        }
        return $html;
    }
}