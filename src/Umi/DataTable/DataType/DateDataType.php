<?php

namespace YM\Umi\DataTable\DataType;

class DateDataType extends DataTypeAbstract
{
    public function regulateDataBrowser($data, $relatedTable = '', $relatedField = '', $option = [])
    {
        return $data;
        //todo - complete date data type, this is input
    }
}