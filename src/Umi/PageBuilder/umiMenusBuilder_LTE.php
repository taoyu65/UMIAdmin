<?php

namespace YM\Umi\PageBuilder;

use YM\Exceptions\UmiException;
use YM\Models\Menu;
use Exception;
use YM\Models\User;
use YM\Facades\Umi as YM;
use YM\Umi\Contracts\PageBuilder\menusInterface;

class umiMenusBuilder_LTE implements menusInterface
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
        $menuId = isset($_REQUEST['id']) && is_numeric($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $activeIds = explode(',', trim($this->allActiveMenuId($menuId), ','));

        $html = '<li class="header">MAIN NAVIGATION</li>';
        $html .= $this->recursionAllMenus($activeIds);
        return $html;
    }

    protected function recursionAllMenus($activeIds, $menu_id = 0)
    {
        $menus = $this->menus->getMenus($menu_id);
        $html = '';
        foreach ($menus as $menu) {
            //menus class(active or open) -------------------------------------------
            $url = $menu->url === '#' ? '#' : url($menu->url) . '?id=' . $menu->id;
            $activeClass = in_array($menu->id, $activeIds) ? 'active' : '';
            $subMenu = $this->menus->isSubMenu($menu->id);
            //-----------------------------------------------------------------------

            #输出自定义图标 (标题后面的小图标)
            #getting the custom icon which is behind the title
            $extraIconHtml = $menu->extra_icon_html;
            $rightIcon = $subMenu ? ' <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>' . $extraIconHtml . '</span>' :
                '<span class="pull-right-container">' . $extraIconHtml . '</span>';
            $leftIcon = $menu->icon_class === '' ? '<i class="fa fa-circle-o"></i>' : '<i class="fa ' . $menu->icon_class . '"></i>';
            $rootMenu = $menu_id == 0 ? "$leftIcon<span>$menu->title</span>$rightIcon" : "$leftIcon$menu->title$rightIcon";

            $treeView = $subMenu ? 'treeview' : '';
            $html .= <<<UMI
                <li class="$treeView $activeClass">
                    <a href="$url" target="$menu->target">
                        $rootMenu
                    </a>
UMI;
            if ($subMenu) {
                $html .= '<ul class="treeview-menu">';
                $html .= $this->recursionAllMenus($activeIds, $menu->id);
                $html .= '</ul>';
                $html .= '</li>';
            } else {
                $html .= '</li>';
            }
        }
        return $html;
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
            $menuId = isset($_REQUEST['id']) && is_numeric($_REQUEST['id']) ? $_REQUEST['id'] : 0;
            $activeIds = explode(',', trim($this->allActiveMenuId($menuId), ','));

            $jsonMenus = json_decode($json);
            $html .= $this->recursionPartMenus($activeIds, $jsonMenus);
            return $html;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function recursionJsonMenu($jsonMenus, $id, $returnString = '')
    {
        if ($id == 0)
            return '';

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
    private function recursionPartMenus($activeIds, $jsonMenus, $levelInit = 0)
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

            //menus class(active or open) -------------------------------------------
            $url = $objMenu->url === '#' ? '#' : url($objMenu->url) . '?id=' . $objMenu->id;
            $activeClass = in_array($objMenu->id, $activeIds) ? 'active' : '';
            $subMenu = $this->menus->isSubMenu($objMenu->id);
            //-----------------------------------------------------------------------

            #输出自定义图标 (标题后面的小图标)
            #getting the custom icon which is behind the title
            $extraIconHtml = $objMenu->extra_icon_html;
            $rightIcon = $subMenu ? ' <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>' . $extraIconHtml . '</span>' :
                '<span class="pull-right-container">' . $extraIconHtml . '</span>';
            $leftIcon = $objMenu->icon_class === '' ? '<i class="fa fa-circle-o"></i>' : '<i class="fa ' . $objMenu->icon_class . '"></i>';
            $rootMenu = $level == 0 ? "$leftIcon<span>$objMenu->title</span>$rightIcon" : "$leftIcon$objMenu->title$rightIcon";

            $treeView = $subMenu ? 'treeview' : '';
            $html .= <<<UMI
                <li class="$treeView $activeClass">
                    <a href="$url" target="$objMenu->target">
                        $rootMenu
                    </a>
UMI;
            if (array_key_exists('children', $jsonMenu)){
                $html .= '<ul class="treeview-menu">';
                $html .= $this->recursionPartMenus($activeIds, $jsonMenu->children, 1);
                $html .= '</ul>';
                $html .= '</li>';
            } else {
                $html .= '</li>';
            }
        }
        return $html;
    }

#endregion---------------------------------------------------------------------------------------------

    #获取此用户的menu的json值
    #get this user's json of menu
    private function menusJson()
    {
        $user = new User();
        return $user->menusJson();
    }

    private function allActiveMenuId($menuId)
    {
        if ($menuId === 0)
            return '';
        $re = '';
        $re .= $menuId . ',';
        $parentMenu = $this->menus->getOneMenu($menuId);
        if ($parentMenu->menu_id != 0)
            $re .= $this->allActiveMenuId($parentMenu->menu_id);
        return $re;
    }
}