<?php

namespace YM\Umi\DataTable\DataType;

use Illuminate\Support\Facades\DB;
use YM\Models\Table;

class DropDownDataType extends DataTypeAbstract
{
    public function regulateDataEditAdd($dataList, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        $property = $this->getProperty($option);
        $validationString = $this->getValidation($validation);

        $optionHtml = '';
        if ($option['customValue'] == '') {
            #如果下拉列表有自定义的值, 优先执行自定义
            #if down down box has custom value, then load this priority
            $placeholder = 'please select...';
            $options = DB::table($relatedTable)
                ->get()
                ->pluck('id', $relatedField);

            foreach ($options as $text => $value) {
                $optionHtml .= "<option value='$value'>$text</option>";
            }
        } else {
            #加载设定的下拉列表关联数据表
            #load drop down box with related data table
            $custom = $option['customValue']->dropDownBox;
            $placeholder = $custom->placeholder;
            $options = $custom->option;

            foreach ($options as $option) {
                $optionHtml .= "<option value='$option->value'>$option->text</option>";
            }
        }

        $html =<<<UMI
        <select class="input-medium form-control" $property $validationString>
			<option value="">$placeholder</option>
			$optionHtml
	    </select>
UMI;
        return $html;
    }

    public function dataTypeInterface($relationDisplayDomId, $customValueDomId)
    {
        $tableModel = new Table();
        $tableList = $tableModel->getAllTable();
        $list = compact('tableList', 'relationDisplayDomId', 'customValueDomId');

        return view('umi::common.fieldDisplay.relationRule', $list);
    }
}