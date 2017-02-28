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
        //$html = $this->dashboard();
        $html = $this->recursionAllMenus(0);
        return $html;
    }

    #根据权限获取部分菜单
    #get part of menus according to the authorization
    public function Menus($json)
    {
        $html = '';//$this->dashboard();
        try {
            $jsonMenus = json_decode($json);

            #获取 active 或者 open的样式 并且以id标识
            #get menu's css right(proper style) and use id as a identity
            $menuLevel = $this->activeOrOpenStyle($jsonMenus);

            $html .= $this->recursionPartMenus($jsonMenus, $menuLevel);
            return $html;
        } catch (Exception $e) {
            throw $e;
        }
    }

    #根据菜单的深度路径(一个菜单的所有父类) 计算并作为数组返回
    #return a array of menu style according to the menu's deep path(all the menu's parents)
    private function activeOrOpenStyle($jsonMenus)
    {
        $activeOrOpen = [];
        if (array_key_exists('id', $_REQUEST) && is_numeric($_REQUEST['id'])) {
            $menuLevel = $this->getLevelOfMenu($jsonMenus, $_REQUEST['id']);
            if (count($menuLevel) == 1) {
                $activeOrOpen[$menuLevel[0]] = 'active';
            } else {
                $count = count($menuLevel);
                for ($i = 0; $i < $count; $i++) {
                    if ($i == 0) {
                        $activeOrOpen[$menuLevel[$i]] = 'active open';
                    } elseif ($i == $count - 1) {
                        $activeOrOpen[$menuLevel[$i]] = 'active';
                    } else {
                        $activeOrOpen[$menuLevel[$i]] = 'open';
                    }
                }
            }
        }
        return $activeOrOpen;
    }

    protected function dashboard()
    {
        $dashboard = route('dashboard');
        $html = <<<EOD
        <li class="" id="dashboard">
		    <a href="$dashboard">
			    <i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>
            <b class="arrow"></b>
		</li>
EOD;
        return $html;
    }

    #根据用户自定义菜单的json加载
    #load menu by json that is related to user
    protected function recursionPartMenus($jsonMenus, $menuLevel, $levelInit = 0)
    {
        $html = '';
        $level = 0;
        $level .= $levelInit;
        foreach ($jsonMenus as $jsonMenu) {
            $objMenu = $this->menus->getOneMenu($jsonMenu->id);
            $rootMenu = $level == 0 ? '<span class="menu-text">' . $objMenu->title . '</span>' : $objMenu->title;
            //menus class(active or open) -------------------------------------------
            $url = $objMenu->url === '#' ? '#' : $objMenu->url . '?id=' . $objMenu->id;
            $class = '';
            if(array_key_exists($objMenu->id, $menuLevel))
                $class = $menuLevel[$objMenu->id];
            //-----------------------------------------------------------------------
            if (array_key_exists('children', $jsonMenu)){
                $html .= <<<EOD
                <li class='$class'>
                    <a href="$url" target="$objMenu->target" class="dropdown-toggle">
			            <i class="menu-icon fa $objMenu->icon_class"></i>
			            $rootMenu
			            <b class="arrow fa fa-angle-down"></b>
		            </a>
                    <b class="arrow"></b>
EOD;
                $html .= '<ul class="submenu">';
                $html .= $this->recursionPartMenus($jsonMenu->children, $menuLevel, 1);
                $html .= '</ul>';
                $html .= '</li>';
            } else {
                $html .= <<<EOD
                <li class='$class'>
                    <a href="$url" target="$objMenu->target">
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

    protected function recursionAllMenus($menu_id = 0)
    {
        $menus = $this->menus->getMenus($menu_id);
        $html = '';
        foreach ($menus as $menu) {
            $rootMenu = $menu_id == 0 ? '<span class="menu-text">' . $menu->title . '</span>' : $menu->title;
            //menus class(active or open) -------------------------------------------
            $url = $menu->url === '#' ? '#' : $menu->url . '?id=' . $menu->id;
            $class = '';
            //if(array_key_exists($menu->id, $menuLevel))
              //  $class = $menuLevel[$menu->id];
            //-----------------------------------------------------------------------
            if ($this->menus->isSubMenu($menu->id)) {
                $html .= <<<EOD
                <li class="$class">
                    <a href="$url" target="$menu->target" class="dropdown-toggle">
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
                <li class="$class">
                    <a href="$url" target="$menu->target">
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

    /** use for showing the side menu's style, remaining the active menu's style after refresh page
     * @param $jsonMenus - type is array.
     * @param $id - id from table umi_menus
     * @return array - deep path (all the parents id of table umi_menus)
     */
    private function getLevelOfMenu($jsonMenus, $id)
    {
        $arrString = $this->recursionJsonMenu($jsonMenus, $id);
        return explode(',', trim($arrString, ','));
    }

    private function recursionJsonMenu($jsonMenus, $id, $returnString = '')
    {
        $temString = '';
        foreach ($jsonMenus as $jsonMenu) {
            if (strstr($temString, $id . ','))
                return $temString;
            $temString = $returnString . $jsonMenu->id . ',';
            #recursion
            if (array_key_exists('children', $jsonMenu)) {
                $temString = $this->recursionJsonMenu($jsonMenu->children, $id, $temString);
            } else {
                if ($id == $jsonMenu->id) {
                    return $temString;
                }
            }
        }
        return $temString;
    }
}