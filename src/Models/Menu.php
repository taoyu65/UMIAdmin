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

    public function getMenus($menu_id)
    {
        if ($this->openCache)
            return $this->cachedTable->where('menu_id', $menu_id);
        return self::where('menu_id', $menu_id);
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