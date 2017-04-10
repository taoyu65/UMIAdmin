<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'umi_menus';
    protected $openCache = true;

    private $cachedTable;

    public function __construct()
    {
        #缓存左边栏的菜单 从数据表menus
        #cache for the side menu from table menus
        parent::__construct();

        if ($this->openCache){
            $minute = Config::get('umi.cache_minutes');
            $this->cachedTable = Cache::remember($this->table, $minute, function () {
                return DB::table($this->table)->orderBy('order')->get();
            });
        }

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
}