<?php

namespace YM\Umi\DataTable\DataType;

class DateDataType extends DataTypeAbstract
{
    public function regulateDataBrowser($dataList, $relatedTable = '', $relatedField = '', $option = [])
    {
        $count = count($dataList);
        for ($i = 0; $i < $count; $i++) {
            $dataList[$i] = "<div style='color: darkgreen'>$dataList[$i]</div>";
        }
        return $dataList;
    }
}