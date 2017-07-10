<?php

namespace YM\Umi\DataTable\DataType;

use Illuminate\Support\Facades\DB;
use YM\Models\Table;

class DropDownDataType extends DataTypeAbstract
{
    public function regulateDataEditAdd($data, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        $property = $this->getProperty($option);
        $validationString = $this->getValidation($validation);

        $optionHtml = '';
        $placeholder = '';
        if ($option['customValue'] == '' && $relatedTable != '') {
            #如果下拉列表有自定义的值, 优先执行自定义
            #if down down box has custom value, then load this priority
            $placeholder = 'please select...';
            $options = DB::table($relatedTable)
                ->get()
                ->pluck('id', $relatedField);

            foreach ($options as $text => $value) {
                $selected = $text === $data ? 'selected' : '';
                $optionHtml .= "<option value='$value' $selected>$text</option>";
            }
        } else if ($option['customValue'] != '') {
            #加载设定的下拉列表关联数据表
            #load drop down box with related data table
            $custom = $option['customValue']->dropDownBox;
            $placeholder = $custom->placeholder;
            $options = $custom->option;

            foreach ($options as $option) {
                $selected = $option->text === $data ? 'selected' : '';
                $optionHtml .= "<option value='$option->value' $selected>$option->text</option>";
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