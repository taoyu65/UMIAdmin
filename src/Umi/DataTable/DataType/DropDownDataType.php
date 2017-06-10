<?php

namespace YM\Umi\DataTable\DataType;

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
//todo - dynamic output the options, and add the interface of input the custom_value
        $html =<<<UMI
        <select class="input-medium" $property $validationString>
			<option value="">$placeholder</option>
			<option value="linux">Linux</option>
			<option value="windows">Windows</option>
			<option value="mac">Mac OS</option>
			<option value="ios">iOS</option>
			<option value="android">Android</option>
	    </select>
UMI;
        return $html;
    }


}