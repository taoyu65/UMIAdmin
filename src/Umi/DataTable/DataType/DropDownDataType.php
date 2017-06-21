<?php

namespace YM\Umi\DataTable\DataType;

use YM\Models\Table;

class DropDownDataType extends DataTypeAbstract
{
    public function regulateDataEditAdd($dataList, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        $property = $this->getProperty($option);
        $validationString = $this->getValidation($validation);

        if ($option['customValue'] == '')
            return '';

        $custom = $option['customValue']->dropDownBox;
        $placeholder = $custom->placeholder;
        $options = $custom->option;

        $optionHtml = '';
        foreach ($options as $option) {
            $optionHtml .= "<option value='$option->value'>$option->text</option>";
        }

        $html =<<<UMI
        <select class="input-medium" $property $validationString>
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

        //todo - drop down box should be designed by a Tap card include 2 function 1.relation display which is done, 2. custom_value, customize the value and can be input
        return view('umi::field.relationRule', $list);
    }
}