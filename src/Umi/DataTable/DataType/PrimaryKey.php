<?php

namespace YM\Umi\DataTable\DataType;

class PrimaryKey extends DataTypeAbstract
{
    public function regulateDataBrowser($data, $relatedTable = '', $relatedField = '', $option = [])
    {
        return $this->getHtml($data);
    }

    public function getHtml($data)
    {
        return "<i class='ace-icon fa fa-key red'></i><span class='red'>$data</span>";
    }
}