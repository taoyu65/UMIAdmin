<?php

namespace YM\Umi;

use Illuminate\Support\Facades\Cache;
use YM\Models\Menu;

class MenuRole
{

    private $menus;

    public function __construct()
    {
        $this->menus = Cache::rememberForever('menus', function () {
            $this->menus = Menu::all();
        });
    }

    /**
     * @return mixed - get all root menus which are menu_id = 0
     * 获取所有跟菜单
     */
    public function rootMenu()
    {
        return $this->menus->where('menu_id', 0);
    }

    /**
     * @param $menuIds - get all the menus by list of id
     * 根据所有的id参数获取相应的权限菜单
     */
    public function menusById($menuIds)
    {

    }

    public function menuTree($parentId = 0)
    {
        $menuLists = $this->menus->where('menu_id', $parentId);
        foreach ($menuLists as $menuList) {

        }
    }

    //recursive iterator
    function flattenJsonTree($aJSON, $iParentId = 0, $iLevel = 0)
    {
        $aRetval = array();
        $iPosition = 1;
        foreach ($aJSON as $aChilds) {
            $aDescendents = array();
            if (isset($aChilds['children'])) {
                $aDescendents = $this->flattenJsonTree(
                    $aChilds['children'], $aChilds['id'], $iLevel+1
                );
            }
            $aRetval[] = array(
                'item_id'  => $aChilds['id'],
                'parent'   => $iParentId,
                'level'    => $iLevel,
                'position' => $iPosition++,
            );
            $aRetval = array_merge($aRetval, $aDescendents);
        }
        return $aRetval;
    }
}