<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
use YM\Models\UmiModel;
use YM\Umi\umiAddTableBuilder;

class umiTableEditController extends Controller
{
    public function editing(Request $request, $table, $recordId, $activeFields = '')
    {
        #数据关联操作参数
        #aprameter of table relation operation
        $actionAvailable = isset($request['TRO_Available']) && $request['TRO_Available'] === false ? false : true;
        $message = $request['TRO_Message'];
        $activeFieldValue = $request['activeFieldValue'];

        #为字段初始化值
        #load value to the fields//todo - 初始化字段不能从数据库取值, js生成最新的改动的值在更新.应该用ajax更新. 2. 时间戳的更新 解决
        $defaultValue = $this->loadFieldsValue($table, $recordId);
        $display = $this->getTableFields($table, $defaultValue);

        $list = compact('table', 'recordId', 'activeFields', 'actionAvailable', 'message', 'activeFieldValue', 'display');
        return view('umi::table.umiTableEditing', $list);
    }

    public function edit(Request $request, $tableName)
    {
        if (!isset($request['hidden_ti']))
            throw new \Exception('wrong parameter');

        $umiModel = new UmiModel($tableName);
        $id = $request['hidden_ti'];
        $count = $umiModel->update($request->input());

        if ($count){
            $request['action_success'] = true;

            Umi::showMessage(
                "Update success! - <strong style=\'color: orange\'>active update</strong>",
                "Record of ID: <strong style=\'color: orange\'>$id</strong> has been updated from table: <strong style=\'color: orange\'>$tableName</strong>",
                [
                    'time' => 10000
                ]
            );
        } else {
            Umi::showMessage(
                "Update fail! - <strong style=\'color: orange\'>active update</strong>",
                "Please make sure data type is correct",
                [
                    'class_name' => 'gritter-error'
                ]
            );
        }
        echo '<script>parent.window.location.reload();</script>';
    }

#region private
    private function getTableFields($tableName, $defaultValue)
    {
        $tableNameLoadingFieldTable = Config::get('umiEnum.system_table_name.umi_field_display_edit');
        $tableId = Umi::getTableIdByTableName($tableName);
        $umiModel = new UmiModel($tableNameLoadingFieldTable, 'order', 'asc');
        $records = $umiModel->getRecordsByWhere('table_id', $tableId);

        $builder = new umiAddTableBuilder();
        return $builder->display($records, $defaultValue, 'edit');
    }

    private function loadFieldsValue($table, $recordId)
    {
        $defaultValue = [];
        $umiModel = new UmiModel($table);
        $record = $umiModel->getRecordsByWhere('id', $recordId);
        foreach ($record->first() as $field => $value) {
            $defaultValue[$field] = $value;
        }
        return $defaultValue;
    }
#endregion
}