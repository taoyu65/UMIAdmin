<?php

namespace YM\Umi\DataTable\DataType;

class Label4ReadDataType extends DataTypeAbstract
{
    public function regulateDataBrowser($data, $relatedTable = '', $relatedField = '', $option = [])
    {
        return "<input class='form-control' readonly value='$data' style='cursor: not-allowed;'>";
    }
}