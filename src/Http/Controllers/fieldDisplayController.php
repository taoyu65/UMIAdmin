<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use YM\Facades\Umi;
use YM\Models\FieldDisplayAdd;
use YM\Models\FieldDisplayBrowser;
use YM\Models\FieldDisplayEdit;
use YM\Models\FieldDisplayRead;
use YM\Models\Table;
use YM\Umi\FactoryDataType;
use YM\Umi\FactoryUI;

class fieldDisplayController extends Controller
{
    public function display($table, $type)
    {
        $tableModel = new Table();
        $tableList = $tableModel->getAllTable();
        $list = compact('tableList', 'table', 'type', 'browserDisabled');

        switch ($type) {
            case 'browser':
            case 'read':
                $dataTypes = Config::get('umiEnum.data_type.browserRead');
                $list['showInputInterface'] = $dataTypes;
                return view('umi::field.fieldBrowserRead', $list);
            case 'edit':
            case 'add':
                $dataTypes = Config::get('umiEnum.data_type.editAdd');
                $list['showInputInterface'] = $dataTypes;
                return view('umi::field.fieldEditAdd', $list);
            default:
                abort(404, 'Error page');
        }
    }

    #获取并显示所有已经存在的字段
    #get and show all fields that exist
    public function loadFields($table, $tableId)
    {
        $factoryUI = new FactoryUI();
        $builder = $factoryUI->fieldDisplayUI();
        return $builder->showExistRecords($table, $tableId);
    }

    #快速添加所有字段 所有值为默认值
    #quick add all the fields, all the value are default
    public function quickAdd($table, $fields, $selectedTableId, $type)
    {
        $fieldsArr = json_decode(base64_decode($fields));
        $browserModel = new FieldDisplayBrowser();

        switch ($type) {
            case 'browser':
                return $browserModel->quickAddBrowserRead($table, $selectedTableId, $fieldsArr, 'label');
            case 'read':
                return $browserModel->quickAddBrowserRead($table, $selectedTableId, $fieldsArr, 'label4Read');
            case 'edit':
            case 'add':
                return $browserModel->quickAddEditAdd($table, $selectedTableId, $fieldsArr);
        }
    }

    #弹出窗口 新建显示数据关系的规则
    #  $dom: 父窗口的dom id 用于显示生成的规则字符串
    #pop window and new a rule of relation of data
    #  $dom: dom of parent's window, use for displaying the rule string from generation
    public function relationRule($relationDisplayDomId, $customValueDomId, $dataType)
    {
        $factory = new FactoryDataType();
        $dataType = $factory->getInstance($dataType);

        return $dataType->dataTypeInterface($relationDisplayDomId, $customValueDomId);
    }

    #data type 的添加操作
    #data type of adding operation
    public function dataTypeAdd(Request $request, $table, $type)
    {
        switch ($type) {
            case 'browser':
                $model = new FieldDisplayBrowser();
                break;
            case 'read':
                $model = new FieldDisplayRead();
                break;
            case 'edit':
                $model = new FieldDisplayEdit();
                break;
            case 'add':
                $model = new FieldDisplayAdd();
                break;
            default:
                throw new \Exception('Parameter is wrong');
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
        $model->insertWithId($request->input());
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