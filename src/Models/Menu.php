<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'umi_menus';

    private $MenuTable;

    public function __construct()
    {
        #缓存左边栏的菜单 从数据表menus
        #cache for the side menu from table menus
        parent::__construct();

        $minute = Config::get('umi.cache_minutes');
        $this->MenuTable = Cache::remember('menuTable', $minute, function () {
            return DB::table($this->table)->get();
        });
    }

    public function getMenus($menu_id)
    {
        return $this->MenuTable->where('menu_id', $menu_id);
    }

    public function isSubMenu($id)
    {
        return $this->MenuTable->where('menu_id', $id)->count();
    }

    /**
     * @param $arrIds - array of id of table <menus>. like [1,2,3]
     * @return mixed
     */
    public function getMenusById($arrIds)
    {
        return $this->MenuTable->whereIn('id', $arrIds);
    }

    public function getOneMenu($id)
    {
        return $this->MenuTable->where('id', $id)->first();
    }
}