<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use YM\Models\Menu;
use YM\Models\UserMenu;
use YM\Umi\Common\Selector;
use YM\Umi\umiMenusBuilder;

class menuController extends Controller
{
    private $menu;

    public function __construct()
    {
        $this->menu = new Menu();
    }

    #加载所有菜单 并管理
    #load all menus and manage
    public function management(Request $request)
    {
        $menuBuilder = new umiMenusBuilder();

        $tableName = $request->route()->parameter('table');
        $menuTree = $menuBuilder->showDragDropTree($tableName, true);

        return view('umi::menu.sideMenu', [
            'menuTree' => $menuTree,
            'tableName'=> $tableName
            ]);
    }

    #更新菜单顺序 并清除缓存加载最新的菜单顺序
    #update the orders of menus, clear cache and reload the last orders
    public function updateMenuOrder(Request $request)
    {
        $menuJson = $request->input('menuJson');

        $this->recursiveUpdateOrder(json_decode($menuJson), 0);

        $tableName = $request->route()->parameter('table');
        Cache::pull($tableName);

        return 'Updated success';
    }

    #加载分配用户菜单页面
    #load distribution page of user's menus
    public function distribution($tableName)
    {
        $userTableName = Config::get('umiEnum.system_table_name.umi_users');

#region selector
        #初始化一个选择用户的弹窗选择器  (用于选择一条记录的某一个数值并且返回到父窗口)
        #init a selector which is selecting a user (select a value from one record and return to its parent's window)
        $selector = new Selector();
        $selector->title = 'Selector';
        $selector->tip = 'Please click row to select a user';
        $selector->returnField = 'id';
        $selector->functionName = "LoadUserTree";
        $selector->fields = ['id', 'name', 'email'];

        #转变json并且加密 作为url参数请求相应的功能
        #turn into json and encrypt as part of url for requesting a related function
        $property = $selector->serialize();
#endregion

        $menuBuilder = new umiMenusBuilder();
        $menuTree = $menuBuilder->showDragDropTree($tableName);

        return view('umi::menu.distribution', compact('menuTree', 'tableName', 'userTableName', 'property'));
    }

    #重新加载所有菜单 来自ajax请求
    #reload all the menus from ajax request
    public function loadMenuTree($table, $showButton = false, $buttonException = [])
    {
        $menuBuilder = new umiMenusBuilder();
        $menuTree = $menuBuilder->showDragDropTree($table, $showButton, $buttonException);

        #必须重新用js启动可拖拽功能
        #must to be restart the drag function with js command
        $js = "<script>$('.dd').nestable();</script>";
        return $menuTree . $js;
    }

    #从用户菜单的json字符串中加载菜单
    #load the menus from string of user's json menu
    public function loadMenuTreeFromJson($table, $userId)
    {
        $userMenu = new UserMenu([],false);
        $json = $userMenu->userJsonMenu($userId);
        $jsonArr = json_decode($json);

        $menuBuilder = new umiMenusBuilder();
        return $menuBuilder->showDragDropTreeByJson($jsonArr);
    }

    #更新用户菜单 以json方式进行数据存储
    #update user's menu, as json type to storage data
    public function updateUserTree(Request $request, $table, $userId)
    {
        $menuJsonUser = $request->input('menuJsonUser');

        $userMenu = new UserMenu();
        if ($userMenu->updateUserMenu($userId, $menuJsonUser) > 0) {
            Cache::pull($table);
            return 'Update success!';
        } else {
            return 'Nothing changes!';
        }
    }
#region Private function
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
#endregion
}
