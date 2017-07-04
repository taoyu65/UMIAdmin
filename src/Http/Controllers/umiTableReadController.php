<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
use YM\Models\UmiModel;
use YM\Umi\umiTableBreadBuilder;

class umiTableReadController extends Controller
{
    public function reading(Request $request, $table, $recordId)
    {
        $umiModel = new UmiModel($table);
        $defaultValue = $umiModel->loadFieldsValue($recordId);
        $display = $this->getTableFields($table, $defaultValue);

        $list = compact('table', 'recordId', 'display');
        return view('umi::table.umiTableReading', $list);
    }

#region private
    private function getTableFields($tableName, $defaultValue)
    {
        $tableNameLoadingFieldTable = Config::get('umiEnum.system_table_name.umi_field_display_read');
        $tableId = Umi::getTableIdByTableName($tableName);
        $umiModel = new UmiModel($tableNameLoadingFieldTable, 'order', 'asc');
        $records = $umiModel->getRecordsByWhere('table_id', $tableId);

        $builder = new umiTableBreadBuilder();
        return $builder->display($records, $defaultValue, 'read');
    }
#endregion
}