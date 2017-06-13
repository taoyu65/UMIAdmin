<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;
use YM\Models\FieldDisplayBrowser;
use YM\Models\Table;
use YM\Models\UmiModel;
use YM\Umi\umiFieldDisplayBuilder;

class fieldDisplayController extends Controller
{
    public function display($table, $type)
    {
        $tableModel = new Table();
        $tableList = $tableModel->getAllTable();
        $list = compact('tableList', 'table');

        switch ($type) {
            case 'browser':
            case 'read':
                return view('umi::field.fieldEditAdd', $list);
            case 'edit':
            case 'add':
                return view('umi::field.fieldEditAdd', $list);
            default:
                abort(404, 'Error page');
        }
    }

    public function loadFields($table, $tableId)
    {
        $builder = new umiFieldDisplayBuilder();
        return $builder->showExistRecords($table, $tableId);
    }

    public function quickAdd($table, $fields, $selectedTableId)
    {
        $fieldsArr = json_decode(base64_decode($fields));

        $browserModel = new FieldDisplayBrowser();
        return $browserModel->quickAdd($table, $selectedTableId, $fieldsArr);
    }
}