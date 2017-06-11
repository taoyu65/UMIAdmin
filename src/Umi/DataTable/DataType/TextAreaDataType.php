<?php

namespace YM\Umi\DataTable\DataType;

class TextAreaDataType extends DataTypeAbstract
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
        <textarea class="form-control" type="text" $property $validationString>$data</textarea>
UMI;
        return $html;
    }
}