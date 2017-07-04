<?php

namespace YM\Umi\DataTable\DataType;

class CheckBoxDataType extends DataTypeAbstract
{
    public function regulateDataEditAdd ($data, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        return $this->getAddHtml($data, $option);
    }

    private function getAddHtml($data, $option)
    {
        $property = $this->getProperty($option);

        $html =<<<UMI
       <input type="checkbox" checked class="checkbox">
UMI;
        return $html;
    }
}