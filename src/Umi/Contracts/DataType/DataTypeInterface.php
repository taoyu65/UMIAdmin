<?php

namespace YM\Umi\Contracts\DataType;

interface DataTypeInterface
{
    public function regulateDataEditAdd($data, $relatedTable = '', $relatedField = '', $validation = '', $option = []);

    public function regulateDataBrowser($data, $relatedTable = '', $relatedField = '', $option = []);
}