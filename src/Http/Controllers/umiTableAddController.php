<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
use YM\Models\UmiModel;
use YM\Umi\FactoryUI;

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

        $list = compact('display', 'tableName');
        return view('umi::table.umiTableAdding', $list);
    }

    public function add(Request $request, $tableName)
    {
        $model = new UmiModel($tableName);
        $count = $model->insert($request->input());

        if ($count) {
            Umi::showMessage(
                "<strong style=\'color: orange\'>Insert Success!</strong>",
                ""
            );
        } else {
            Umi::showMessage(
                "<strong style=\'color: orange\'>Insert fail!</strong>",
                "Some fields must be fill in, please go to \"Field Display\" to add all necessary fields",
                ['class_name' => 'gritter-error']
            );
        }

        Cache::flush($tableName);
        echo '<script>parent.window.location.reload();</script>';
    }

    private function getTableFields($tableName, $defaultValue)
    {
        $tableNameLoadingFieldTable = Config::get('umiEnum.system_table_name.umi_field_display_add');
        $tableId = Umi::getTableIdByTableName($tableName);
        $umiModel = new UmiModel($tableNameLoadingFieldTable, 'order', 'asc');
        $records = $umiModel->getRecordsByWhere('table_id', $tableId);

        $factoryUI = new FactoryUI();
        $builder = $factoryUI->tableBreadUI();
        return $builder->display($records, $defaultValue, 'add');
    }
}