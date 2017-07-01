<?php

namespace YM\Models;

use Illuminate\Support\Facades\Config;

class Menu extends UmiBase
{
    use BreadOperation;

    protected $table = 'umi_menus';
    public $timestamps = true;

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function __construct(array $attributes = [], $orderBy = 'order', $order = 'asc')
    {
        $this->fillable = Config::get('umiEnum.fillable.' . $this->table);

        parent::__construct($attributes, $orderBy, $order);
    }

    #获取菜单
    #getting menus
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