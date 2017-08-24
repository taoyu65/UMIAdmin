<?php

namespace YM\Umi\PageBuilder;

use YM\Models\Menu;
use YM\Models\TableRelationOperation;
use YM\Facades\Umi as YM;
use YM\Umi\Contracts\PageBuilder\nestableInterface;

class umiNestableBuilder_LTE implements nestableInterface
{
    private $tableName;
    private $relationOperationRuleList;
    private $menus;

    public function __construct()
    {
        $this->menus = new Menu([], 'order');
    }

    #Menu tree for management (drag and drop)-------------------------------------------------------
    #加载菜单(用nestable插件显示)
    #buttonException:   在显示按钮的同时, 哪个功能不显示 (browser, read, add, delete)
    #load menus (with nestable plugin)
    #buttonException:   when all buttons are showing, decide which button is not available. (browser, read, add, delete)
    public function showDragDropTree($tableName, $showButton = false, $buttonException = [])
    {
        $TRO = new TableRelationOperation();
        $tableId = YM::getTableIdByTableName($tableName);
        $this->tableName = $tableName;
        $this->relationOperationRuleList = $TRO->getRulesForConfirmation($tableId);

        $html = '';
        $html .= '<div class="dd" id="nestableMenu">';
        $html .= $this->menuManagement($showButton, $buttonException);
        $html .= '</div>';

        return $html;
    }

    #显示用户菜单, 从用户菜单json中读取, 可以定制
    #show user's menu, reading from user's json, can be customized
    public function showDragDropTreeByJson($jsonArr)
    {
        $html = '';
        $html .= '<div class="dd" id="nestableUser">';
        $html .= $this->createUserTree($jsonArr);
        $html .= '</div>';

        return $html;
    }

    #显示用户菜单, 从用户菜单json中读取, 可以定制
    #show user's menu, reading from user's json, can be customized
    private function createUserTree($jsonArr)
    {
        $emptyContainer = count($jsonArr) > 0 ? '' : 'dd-empty';
        $html = "<ol class='dd-list $emptyContainer'>";

        foreach ($jsonArr as $item) {
            $record = $this->menus->getOneMenu($item->id);

            $recursiveOL = '';
            if (isset($item->children))
                $recursiveOL = $this->createUserTree($item->children);

            $html .= $LI =<<<UMI
                <li class="dd-item dd2-item" data-id="$record->id">
                     <div class="dd-handle dd2-handle">
                         <i class="normal-icon fa $record->icon_class"></i>
        
                         <i class="drag-icon fa fa-arrows"></i>
                     </div>
                     <div class="dd2-content">
                         $record->title
                     </div>
                     $recursiveOL
                </li>
UMI;
        }
        $html .= '</ol>';

        return $html;
    }

    #显示所有菜单根据数据表字段生成, 用于超级用户读取全部数据
    #show all menus from data table, for super administrator showing all the menus
    private function menuManagement($showButton = false, $buttonException = [], $menu_id = 0)
    {
        $menus = $this->menus->getMenus($menu_id);
        if ($menus->count() === 0) return '';

        $html = '<ol class="dd-list">';
        foreach ($menus as $menu) {
            $itemId = $menu->id;
            $iconClass = $menu->icon_class;
            $title = $menu->title;
            $recursiveOL = $this->menuManagement($showButton, $buttonException, $menu->id);

            #获取数据库连级删除的参数field
            #get parameter "field" for relation operation
            $parameterField = YM::parameterTRO($menu, $this->relationOperationRuleList);
            //$breadButton = $showOperationButton ? $this->breadButton($itemId, $parameterField) : '';
            $breadButton = $showButton ? $this->breadButton($itemId, $menu_id, $parameterField, $buttonException) : '';

            $html .= $LI =<<<UMI
            <li class="dd-item dd2-item" data-id="$itemId">
                <div class="dd-handle dd2-handle">
                    <i class="normal-icon fa $iconClass"></i>

                    <i class="drag-icon fa fa-arrows"></i>
                </div>
                <div class="dd2-content">
                    $title
                    $breadButton
                </div>
                $recursiveOL
           </li>
UMI;
        }
        $html .= '</ol>';

        return $html;
    }

    private function breadButton($itemId, $menuId, $parameterField, $buttonException = [])
    {
        if (!is_array($buttonException))
            abort(503, 'parameter is wrong');

        $deleteUrl = url('deleting') . "/$this->tableName/$itemId/$parameterField";
        #添加规则最后的参数为:提供默认字段以及值
        #add rule, the last parameter is: supply defaults value and its fields
        $parameterDefaultValue = YM::serializeAndBase64(array('menu_id' => $itemId));
        $addUrl = url('adding'). "/$this->tableName" . "/$parameterDefaultValue";
        $readUrl = url('reading') . "/$this->tableName/$itemId";
        $editUrl = url('editing') . "/$this->tableName/$itemId/$parameterField";

        $html = '<div class="pull-right action-buttons">';

        #add
        if (in_array('add', $buttonException)) {
            $html .= '<a class="fa-gray" href="#" style="cursor: not-allowed">
                        <i class="fa fa-plus"></i>
                      </a>';
        } else {
            $html .= '<a class="fa-green" href="#" onclick="showAdding(\'' . $addUrl . '\')">';
            $html .= '    <i class="fa fa-plus"></i>';
            $html .= '</a>&nbsp;';
        }

        #browser
        if (in_array('browser', $buttonException)) {
            $html .= '<a class="fa-gray" href="#" style="cursor: not-allowed">
                        <i class="fa fa-eye"></i>
                      </a>';
        } else {
            $html .= '<a class="fa-orange" href="#" onclick="showReading(\'' . $readUrl . '\')">
                        <i class="fa fa-eye"></i>
                      </a>&nbsp;';
        }

        #edit
        if (in_array('edit', $buttonException)) {
            $html .= '<a class="fa-gray" href="#" style="cursor: not-allowed">
                        <i class="fa fa-pencil"></i>
                      </a>';
        } else {
            $html .= '<a class="fa-primary" href="#" onclick="showEditing(\'' . $editUrl . '\')">
                        <i class="fa fa-pencil"></i>
                      </a>&nbsp;';
        }

        #delete
        if (in_array('delete', $buttonException)) {
            $html .= '<a class="fa-gray" href="#" style="cursor: not-allowed">
                        <i class="fa fa-trash-o"></i>
                      </a>';
        } else {
            $html .= '<a class="fa-danger" href="#" onclick="showDeleting(\'' . $deleteUrl . '\')">';
            $html .= '    <i class="fa fa-trash-o"></i>';
            $html .= '</a>';
        }
        $html .= '</div>';

        return $html;
    }
}