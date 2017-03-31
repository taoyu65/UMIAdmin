<?php

namespace YM\Umi;

use YM\Umi\DataTable\DataType\LabelDataType;

class FactoryDataType
{
    public function getDataType($dataType)
    {
        switch ($dataType) {
            case 'label':
                return new LabelDataType();
            default:
                throw new \Exception("You have not set up this data type: $dataType");
        }
    }
}