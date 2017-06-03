<?php

namespace YM\Models;

class Menu extends UmiBase
{
    protected $table = 'umi_menus';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function __construct()
    {
        parent::__construct('order');
    }

    #获取菜单, 如果是用户的json菜单则接收jsonArr进行过滤
    #getting menus, if it's user's json menu than receiving a jsonArr to be filtered
    public function getMenus($menu_id, $jsonArr = '')
    {
        if ($this->openCache) {
            $returnData = $this->cachedTable->where('menu_id', $menu_id);
        } else {
            $returnData = self::where('menu_id', $menu_id);
        }

        #用户menus为json格式, 从所有菜单中过滤
        #user's menu is a type of json, will be filtered from all menus
        if ($jsonArr != '') {
            $returnData = $returnData->filter(function ($item) use ($jsonArr) {
                return in_array($item->id, $jsonArr);
            });
        }

        return $returnData;
    }

    public function isSubMenu($id)
    {
        if ($this->openCache)
            return $this->cachedTable->where('menu_id', $id)->count();
        return self::where('menu_id', $id)->count();
    }

    #array of table's id <menus>. like [1,2,3]
    public function getMenusById($arrIds)
    {
        if ($this->openCache)
            return $this->cachedTable->whereIn('id', $arrIds);
        return self::whereIn('id', $arrIds);
    }

    public function getOneMenu($id)
    {
        if ($this->openCache)
            return $this->cachedTable->where('id', $id)->first();
        return self::where('id', $id)->first();
    }

    public function getAllRecord()
    {
        if ($this->openCache)
            return $this->cachedTable;
        return self::all();
    }

    public function updateOrder($id, $parentId, $order)
    {
        self::where('id', $id)
            ->update([
                'menu_id'   => $parentId,
                'order'     => $order
            ]);
    }
}