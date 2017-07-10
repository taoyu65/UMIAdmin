<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use YM\Models\UmiModel;
use YM\Umi\Common\Selector;

class commonController extends Controller
{
    #弹出一个选择数据窗口 用于替代下拉框 带分页的数据列表, 根据参数设定点击一条数据返回指定数据到父窗口
    #   $property: [] 一组规则 如下
    #       title: 标题
    #       tip: 提示信息
    #       returnField: 那个字段会被返回到父窗口
    #       functionName: 点击记录的方法名称
    #       fields: 哪些字段会被显示在选择器

    #pop a window for selecting and return data, instead of drop down box, it's data sets with paginate, according to the parameters
    #when clicks one record, the specific designated data will be return to the parent's window for displaying
    #   $property: [] a group of rules as following
    #       title: window title
    #       tip: some information
    #       returnField: which field's value will be returned to the parent's window
    #       functionName: the method name that when the record got clicked
    #       fields: which fields will be displayed on the selector
    public function selector(Request $request, $table, $property)
    {
        $selectorClass = new Selector();
        $selector = $selectorClass->unSerialize($property);

        $umiModel = new UmiModel($table);
        $records = $umiModel->getRecordsByFields($selector->fields);
        $links = $records->links();
        $url = $request->url();

        return view('umi::common.selector', compact('table', 'selector', 'records', 'links', 'url'));
    }

    public function search(Request $request)
    {
        $table = $request->input('table');
        $field = $request->input('field');
        $value = $request->input('value');
        $url = $request->input('url');
        $selector = unserialize($request->input('selector'));

        $umiModel = new UmiModel($table);
        $records = $umiModel->singleFieldSearch($field, $value);

        return view('umi::common.selector', compact('table', 'selector', 'records', 'url'));
    }
}