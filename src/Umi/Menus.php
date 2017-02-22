<?php

namespace YM\Umi;

use YM\Models\Menu;

class Menus
{
    private $menus;

    public function __construct()
    {
        $this->menus = new Menu();
    }

    public function AllMenus()
    {
        $html = <<<EOD
        <li class="active">
		    <a href="#">
			    <i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>
            <b class="arrow"></b>
		</li>
EOD;
        $html .= $this->recursion(0);
        return $html;
    }

    public function Menus($json)
    {

    }

    private function recursion($menu_id = 0)
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
                $html .= $this->recursion($menu->id);
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