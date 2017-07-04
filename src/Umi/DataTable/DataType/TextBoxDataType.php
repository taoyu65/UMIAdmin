<?php

namespace YM\Umi\DataTable\DataType;

class TextBoxDataType extends DataTypeAbstract
{
    public function regulateDataEditAdd ($data, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        return $this->getAddHtml($data, $validation, $option);
    }

    private function getAddHtml($data, $validation, $option)
    {
        $property = $this->getProperty($option);
        $validationString = $this->getValidation($validation);

        $html =<<<UMI
        <input class="form-control" type="text" $property value='$data' $validationString >
UMI;
        return $html;
    }
}