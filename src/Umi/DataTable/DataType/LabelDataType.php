<?php

namespace YM\Umi\DataTable\DataType;

class LabelDataType extends DataTypeAbstract
{
    public function regulateDataBrowser($dataList, $relatedTable = '', $relatedField = '', $option = [])
    {
        return $dataList;
    }
}