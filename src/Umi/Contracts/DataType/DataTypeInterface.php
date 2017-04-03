<?php

namespace YM\Umi\Contracts\DataType;

interface DataTypeInterface
{
    public function regulateDataEditAdd($dataList, $relatedTable = '', $relatedField = '', $validation = '', $option = []);

    public function regulateDataBrowser($dataList, $relatedTable = '', $relatedField = '', $option = []);
}