<?php

namespace YM\Umi\PageBuilder;

use YM\Exceptions\UmiException;
use YM\Models\Menu;
use Exception;
use YM\Models\User;
use YM\Facades\Umi as YM;

class umiMenusBuilder_ACE
{
    private $menus;

    public function __construct()
    {
        $this->menus = new Menu([], 'order');
    }
#region Menus for super admin-------------------------------------------------------------------------

    #超级用户获取全部菜单权限
    #super admin can get all menus
    public function AllMenus()
    {
        //$html = $this->dashboard();
        $menuLevelStyle = [];
        if (array_key_exists('id', $_REQUEST) && is_numeric($_REQUEST['id'])) {
            $menuTable = $this->menus->getAllRecord();
            $menuLevelStrings = $this->getLevelOfMenuForSuperAdmin($_REQUEST['id'], $menuTable);
            $menuLevel = [];
            foreach (explode(',', $menuLevelStrings) as $menuLevelString) {
                array_unshift($menuLevel, $menuLevelString);
            }
            $menuLevelStyle =  $this->getStyle($menuLevel);
        }
        $html = $this->recursionAllMenus($menuLevelStyle);
        return $html;
    }

    protected function recursionAllMenus($menuLevelStyle, $menu_id = 0)
    {
        $menus = $this->menus->getMenus($menu_id);
        $html = '';
        foreach ($menus as $menu) {
            #输出自定义图标 (标题后面的小图标)
            #getting the custom icon which is behind the title
            $extraIconHtml = $menu->extra_icon_html;

            $titleWithIcon = $menu->title . $extraIconHtml;
            $rootMenu = $menu_id == 0 ? '<span class="menu-text">' . $titleWithIcon . '</span>' : $titleWithIcon;
            //menus class(active or open) -------------------------------------------
            $url = $menu->url === '#' ? '#' : url($menu->url) . '?id=' . $menu->id;
            $class = '';
            if(array_key_exists($menu->id, $menuLevelStyle))
                $class = $menuLevelStyle[$menu->id];
            //-----------------------------------------------------------------------
            if ($this->menus->isSubMenu($menu->id)) {
                $html .= <<<UMI
                <li class="$class">
                    <a href="$url" target="$menu->target" class="dropdown-toggle">
                        <i class="menu-icon fa $menu->icon_class"></i>
                        $rootMenu
                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
UMI;
                $html .= '<ul class="submenu">';
                $html .= $this->recursionAllMenus($menuLevelStyle, $menu->id);
                $html .= '</ul>';
                $html .= '</li>';
            } else {
                $html .= <<<UMI
                <li class="$class">
                    <a href="$url" target="$menu->target">
                        <i class="menu-icon fa $menu->icon_class"></i>
                        $rootMenu
                    </a>
                    <b class="arrow"></b>
                </li>
UMI;
            }
        }
        return $html;
    }

    private function getLevelOfMenuForSuperAdmin($id, $menuTable)
    {
        $idString = $id . ',';
        $menu = $menuTable->where('id', $id)->first();
        if(!$menu)
            throw new UmiException('parameter of url might be wrong. check the record of database table');
        if ($menu->menu_id == 0) {
            return $id;
        } else {
            $idString .= $this->getLevelOfMenuForSuperAdmin($menu->menu_id, $menuTable);
        }
        return $idString;
    }

#endregion---------------------------------------------------------------------------------------------

#region Menus for administrator------------------------------------------------------------------------

    /**
     * 根据不同的json加载不同菜单
     * load different menus according to the json
     * @param string $json
     *              - 为空    : 根据当前用户从数据库加载json  get json by search from database according to current user
     *              - 不为空   : 根据参数加载json    get json by the parameter has given
     * @return string
     * @throws Exception
     */
    public function Menus($json = '')
    {
        $json = $json === '' ? $this->menusJson() : $json;

        if (!is_string($json) || !is_array(json_decode($json)))
            //throw new Exception('loading Menus was failed');
            return 'No menus or Loading menus was failed, Please set a user menus permission first!';

        $html = '';//$this->dashboard();
        try {
            $jsonMenus = json_decode($json);

            #获取 active 或者 open的样式 并且以id标识
            #get menu's css right(proper style) and use id as a identity
            $menuLevelStyle = $this->activeOrOpenStyle($jsonMenus);

            $html .= $this->recursionPartMenus($jsonMenus, $menuLevelStyle);
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
            $activeOrOpen = $this->getStyle($menuLevel);
        }
        return $activeOrOpen;
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

    #根据用户自定义菜单的json加载
    #load menu by json that is related to user
    private function recursionPartMenus($jsonMenus, $menuLevelStyle, $levelInit = 0)
    {
        $html = '';
        $level = 0;
        $level .= $levelInit;
        foreach ($jsonMenus as $jsonMenu) {
            $objMenu = $this->menus->getOneMenu($jsonMenu->id);

            if (!$objMenu) {
                YM::showMessage(
                    "Could not find the menu that ID is $jsonMenu->id",
                    "please manually check related data table",
                    [
                        'sticky'     => true,
                        'class_name' => 'gritter-error'
                    ]
                );
                break;
                //abort(404, "Could not find the menu that ID is $jsonMenu->id");
            }


            #输出自定义图标 (标题后面的小图标)
            #getting the custom icon which is behind the title
            $extraIconHtml = $objMenu->extra_icon_html;

            $titleWithIcon = $objMenu->title . $extraIconHtml;
            $rootMenu = $level == 0 ? '<span class="menu-text">' . $titleWithIcon . '</span>' : $titleWithIcon;
            //menus class(active or open) -------------------------------------------
            $url = $objMenu->url === '#' ? '#' : url($objMenu->url) . '?id=' . $objMenu->id;
            $class = '';
            if(array_key_exists($objMenu->id, $menuLevelStyle))
                $class = $menuLevelStyle[$objMenu->id];
            //-----------------------------------------------------------------------
            if (array_key_exists('children', $jsonMenu)){
                $html .= <<<UMI
                <li class='$class'>
                    <a href="$url" target="$objMenu->target" class="dropdown-toggle">
                        <i class="menu-icon fa $objMenu->icon_class"></i>
                            $rootMenu
                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
UMI;
                $html .= '<ul class="submenu">';
                $html .= $this->recursionPartMenus($jsonMenu->children, $menuLevelStyle, 1);
                $html .= '</ul>';
                $html .= '</li>';
            } else {
                $html .= <<<UMI
                <li class='$class'>
                    <a href="$url" target="$objMenu->target">
                        <i class="menu-icon fa $objMenu->icon_class"></i>
                        $rootMenu
                    </a>
                    <b class="arrow"></b>
                </li>
UMI;
            }

        }
        return $html;
    }

#endregion---------------------------------------------------------------------------------------------

    private function dashboard()
    {
        $dashboard = route('dashboard');
        $html = <<<UMI
        <li class="" id="dashboard">
            <a href="$dashboard">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
            <b class="arrow"></b>
        </li>
UMI;
        return $html;
    }

    private function getStyle($menuLevel)
    {
        $activeOrOpen = [];
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
        return $activeOrOpen;
    }

    #获取此用户的menu的json值
    #get this user's json of menu
    public function menusJson()
    {
        $user = new User();
        return $user->menusJson();
    }
}