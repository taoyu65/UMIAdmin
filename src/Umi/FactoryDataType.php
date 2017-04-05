<?php

namespace YM\Umi;

use YM\Umi\DataTable\DataType\BadgesDataType;
use YM\Umi\DataTable\DataType\DateDataType;
use YM\Umi\DataTable\DataType\DropDownDataType;
use YM\Umi\DataTable\DataType\ForeignKeyDataType;
use YM\Umi\DataTable\DataType\LabelDataType;
use YM\Umi\DataTable\DataType\PrimaryKey;
use YM\Umi\DataTable\DataType\StarDataType;

class FactoryDataType
{
    private $dataType = [];

    public function __construct($dataTypeList)
    {
        foreach ($dataTypeList as $field => $values) {
            $this->dataType[$field] = $this->getDataType($values['type']);
        }
    }

    private function getDataType($dataType)
    {
        switch ($dataType) {
            case 'label':
                return new LabelDataType();
            case 'date':
                return new DateDataType();
            case 'star':
                return new StarDataType();
            case 'dropdown':
                return new DropDownDataType();
            case 'foreignKey':
                return new ForeignKeyDataType();
            case 'badge':
                return new BadgesDataType();
            case 'primaryKey':
                return new PrimaryKey();
            default:
                throw new \Exception("You have not set up this data type: $dataType");
        }
    }

    public function getInstance($field)
    {
        return $this->dataType[$field];
    }
}