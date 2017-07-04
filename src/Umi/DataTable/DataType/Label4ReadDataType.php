<?php

namespace YM\Umi\DataTable\DataType;

class Label4ReadDataType extends DataTypeAbstract
{
    public function regulateDataBrowser($data, $relatedTable = '', $relatedField = '', $option = [])
    {
        return "<div class='form-control'>$data</div>";
    }
}