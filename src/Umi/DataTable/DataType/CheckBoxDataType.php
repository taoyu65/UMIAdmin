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
        <label>
            <input $property class="ace ace-switch ace-switch-7" type="checkbox" />
            <span class="lbl"></span>
        </label>
UMI;
        return $html;
    }
}