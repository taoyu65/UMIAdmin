<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use YM\Models\Menu;
use YM\Umi\umiMenusBuilder;

class menuController extends Controller
{
    private $menu;

    public function __construct()
    {
        $this->menu = new Menu();
    }

    public function management(Request $request)
    {
        $menu = new umiMenusBuilder();

        $tableName = $request->route()->parameter('table');
        $menuTree = $menu->showDragDropTree($tableName);

        return view('umi::menu.sideMenu', ['menuTree' => $menuTree]);
    }

    public function updateMenuOrder(Request $request)
    {
        $menuJson = $request->input('menuJson');

        $this->recursiveUpdateOrder(json_decode($menuJson), 0);

        $tableName = $request->route()->parameter('table');
        Cache::pull($tableName);

        echo $menuJson;
    }

    private function recursiveUpdateOrder($currentMenu, $parentId = 0)
    {
        $order = 0;
        for ($i = 0; $i < count($currentMenu); $i++) {
            $id = $currentMenu[$i]->id;
            $this->checkAndUpdate($id, $parentId, $order);

            if (isset($currentMenu[$i]->children)) {
                $childMenu = $currentMenu[$i]->children;
                $this->recursiveUpdateOrder($childMenu, $id);
            }

            $order++;
        }
    }

    private function checkAndUpdate($id, $parentId, $order)
    {
        $menu = $this->menu->getOneMenu($id);
        if ($menu->menu_id != $parentId || $menu->order != $order) {
            $this->menu->updateOrder($id, $parentId, $order);
        }
    }
}
