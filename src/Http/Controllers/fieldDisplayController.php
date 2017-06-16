<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
use YM\Models\FieldDisplayBrowser;
use YM\Models\FieldDisplayRead;
use YM\Models\Table;
use YM\Umi\umiFieldDisplayBuilder;

class fieldDisplayController extends Controller
{
    public function display($table, $type)
    {
        $tableModel = new Table();
        $tableList = $tableModel->getAllTable();
        $dataTypes = Config::get('umiEnum.data_type');

        $list = compact('tableList', 'table', 'dataTypes', 'type', 'browserDisabled');

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

    #获取并显示所有已经存在的字段
    #get and show all fields that exist
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

    public function relationRule($dom)
    {
        $tableModel = new Table();
        $tableList = $tableModel->getAllTable();

        $list = compact('tableList', 'dom');

        return view('umi::field.relationRule', $list);
    }

    public function browserAdd(Request $request, $table, $type)
    {
        if ($type === 'browser') {
            $model = new FieldDisplayBrowser();
        } else if ($type === 'read') {
            $model = new FieldDisplayRead();
        }

        if ($model->checkBeforeInsert($request->input('table_id'), $request->input('field'))) {
            Umi::showMessage(
                'Add field failed',
                'Can not add two same field in one table',
                [
                    'class_name' => 'gritter-error'
                ]
            );
            return redirect()->back();
        }

        //添加成功 //add success
        $model->insert($request->input());
        Umi::showMessage(
            'Add field success',
            'Job Done, keep going.',
            [
                'class_name' => 'gritter-success'
            ]
        );
        return redirect()->back();
    }
}