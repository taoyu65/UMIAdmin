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

    public function regulateDataEditAddInput()
    {

    }
}