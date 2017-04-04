<?php

namespace YM\Umi\DataTable\DataType;

class PrimaryKey extends DataTypeAbstract
{
    public function regulateDataBrowser($dataList, $relatedTable = '', $relatedField = '', $option = [])
    {
        $re = [];
        foreach ($dataList as $item) {
            array_push($re, $this->getHtml($item));
        }
        return $re;
    }

    public function getHtml($data)
    {
        return "<i class='ace-icon fa fa-key red'></i><span class='red'>$data</span>";
    }
}