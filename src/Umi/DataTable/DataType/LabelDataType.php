<?php

namespace YM\Umi\DataTable\DataType;

class LabelDataType extends DataTypeAbstract
{
    public function regulateDataBrowser($data, $relatedTable = '', $relatedField = '', $option = [])
    {
        return $data;
    }
}