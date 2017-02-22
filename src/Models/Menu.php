<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    private $MenuTable;

    public function __construct()
    {
        parent::__construct();
        if (Cache::has('menuTable')) {
            $this->MenuTable = Cache::get('menuTable');
        } else {
            $this->MenuTable = DB::table('menus')->get();
            Cache::put('menuTable', $this->MenuTable, 10);
        }
    }

    public function getMenus($menu_id)
    {
        return $this->MenuTable->where('menu_id', $menu_id);
    }

    public function isSubMenu($id)
    {
        return $this->MenuTable->where('menu_id', $id)->count();
    }
}