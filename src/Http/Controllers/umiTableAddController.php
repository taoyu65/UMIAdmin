<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
use YM\Models\Menu;
use YM\Models\UmiModel;
use YM\Umi\FactoryModel;
use YM\Umi\umiAddTableBuilder;

class umiTableAddController extends Controller
{
    # $defaultValue: 动态设置键值对代表 默认的字段和值.
    # $defaultValue: dynamic set a key-value to represent default field and its value
    public function adding(Request $request, $tableName, $defaultValue = '')
    {
//        $actionAvailable = isset($request['TRO_Available']) && $request['TRO_Available'] === false ? false : true;
//        $message = $request['TRO_Message'];
        $defaultValue = Umi::unSerializeAndBase64($defaultValue);

        $display = $this->getTableFields($tableName, $defaultValue);
        return view('umi::table.umiTableAdding', ['display' => $display]);
    }

    public function add(Request $request, $tableName)
    {
        //$menu = new Menu();
        //$menu->insert($request->input());
        $factory = new FactoryModel();
        $model = $factory->getInstance($tableName);
        $model->insert($request->input());

        Umi::showMessage(
            "<strong style=\'color: orange\'>Insert success!</strong>",
            ""
        );
        Cache::flush($tableName);
        echo '<script>parent.window.location.reload();</script>';
    }

    public function getTableFields($tableName, $defaultValue)
    {
        $tableNameLoadingFieldTable = Config::get('umiEnum.system_table_name.umi_field_display_add');
        $tableId = Umi::getTableIdByTableName($tableName);
        $umiModel = new UmiModel($tableNameLoadingFieldTable, 'order', 'asc');
        $records = $umiModel->getRecordsByWhere('table_id', $tableId);

        $builder = new umiAddTableBuilder();
        return $builder->display($records, $defaultValue, $tableName);
    }
}