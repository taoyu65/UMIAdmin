<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
use YM\Models\UmiModel;
use YM\Umi\umiAddTableBuilder;

class umiTableAddController extends Controller
{
    # $defaultValue: 动态设置键值对代表 默认的字段和值.
    # $defaultValue: dynamic set a key-value to represent default field and its value
    public function adding(Request $request, $tableName, $defaultValue)
    {
//        $actionAvailable = isset($request['TRO_Available']) && $request['TRO_Available'] === false ? false : true;
//        $message = $request['TRO_Message'];

        $defaultValue = Umi::unSerializeAndBase64($defaultValue);

        $display = $this->getTableFields($tableName, $defaultValue);
        return view('umi::table.umiTableAdding', ['display' => $display]);
    }

    public function add(Request $request, $table)
    {
        /*if (!isset($request['hidden_ti']))
            throw new \Exception('wrong parameter');

        $umiModel = new UmiModel($table);
        $id = $request['hidden_ti'];
        $count = 1;//$umiModel->delete($id);

        if ($count){
            $request['action_success'] = true;

            Umi::showMessage(
                "Delete success! - <strong style=\'color: orange\'>active delete</strong>",
                "Record of ID: <strong style=\'color: orange\'>$id</strong> has been deleted from table: <strong style=\'color: orange\'>$table</strong>",
                [
                    'time' => 10000
                ]
            );

            echo '<script>parent.window.location.reload();</script>';
        }*/
    }

    public function getTableFields($tableName, $defaultValue)
    {
        $tableNameLoadingFieldTable = Config::get('umiEnum.system_table_name.umi_field_display_add');
        $tableId = Umi::getTableIdByTableName($tableName);
        $umiModel = new UmiModel($tableNameLoadingFieldTable, 'order', 'asc');
        $records = $umiModel->getRecordsByWhere('table_id', $tableId);

        $builder = new umiAddTableBuilder();
        return $builder->display($records, $defaultValue);
    }
}