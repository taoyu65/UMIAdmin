<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use YM\Facades\Umi;
use YM\Models\FieldDisplayAdd;
use YM\Models\FieldDisplayBrowser;
use YM\Models\FieldDisplayEdit;
use YM\Models\FieldDisplayRead;
use YM\Models\Table;
use YM\Umi\FactoryDataType;
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
                return view('umi::field.fieldBrowserRead', $list);
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

    #快速添加所有字段 所有值为默认值
    #quick add all the fields, all the value are default
    public function quickAdd($table, $fields, $selectedTableId)
    {
        $fieldsArr = json_decode(base64_decode($fields));

        $browserModel = new FieldDisplayBrowser();
        return $browserModel->quickAdd($table, $selectedTableId, $fieldsArr);
    }

    #弹出窗口 新建显示数据关系的规则
    #  $dom: 父窗口的dom id 用于显示生成的规则字符串
    #pop window and new a rule of relation of data
    #  $dom: dom of parent's window, use for displaying the rule string from generation
    public function relationRule($relationDisplayDomId, $customValueDomId, $dataType)
    {
        /*$tableModel = new Table();
        $tableList = $tableModel->getAllTable();

        $list = compact('tableList', 'dom');

        return view('umi::field.relationRule', $list);*/
        $factory = new FactoryDataType();
        $dataType = $factory->getInstance($dataType);
        return $dataType->dataTypeInterface($relationDisplayDomId, $customValueDomId);
    }

    #browser 和 read 的添加操作
    #browser and read add operation
    public function browserAdd(Request $request, $table, $type)
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