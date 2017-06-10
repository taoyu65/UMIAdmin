<?php

namespace YM\Umi;

use YM\Umi\DataTable\DataType\BadgesDataType;
use YM\Umi\DataTable\DataType\CheckBoxDataType;
use YM\Umi\DataTable\DataType\DateDataType;
use YM\Umi\DataTable\DataType\DropDownDataType;
use YM\Umi\DataTable\DataType\ForeignKeyDataType;
use YM\Umi\DataTable\DataType\LabelDataType;
use YM\Umi\DataTable\DataType\KeyIcon;
use YM\Umi\DataTable\DataType\StarDataType;
use YM\Umi\DataTable\DataType\TextBoxDataType;

class FactoryDataType
{
    #dataType对象列表
    #dataType objects lists
    private $dataType = [];

    public function __construct($dataTypeList = [])
    {
        if (!count($dataTypeList))
            return;

        #加载所有已给参数中的对象
        #load all the objects that given by the parameter
        foreach ($dataTypeList as $field => $values) {
            $this->dataType[$field] = $this->getDataType($values['type']);
        }
    }

    private function getDataType($dataType)
    {
        switch ($dataType) {
            case 'label':
                return new LabelDataType();
            case 'textBox':
                return new TextBoxDataType();
            case 'checkBox':
                return new CheckBoxDataType();
            case 'date':
                return new DateDataType();
            case 'star':
                return new StarDataType();
            case 'dropDownBox':
                return new DropDownDataType();
            case 'foreignKey':
                return new ForeignKeyDataType();
            case 'badge':
                return new BadgesDataType();
            case 'keyIcon':
                return new KeyIcon();
            default:
                throw new \Exception("You have not set up this data type: $dataType");
        }
    }

    public function getInstance($field)
    {
        #如果已经加载的对象则从中获取, 如果没有则新建 (区别是一次创建按需拿取, 和分别创建)
        #if the object has been created than get it from the list, other wise new one.
        if (count($this->dataType))
            return $this->dataType[$field];

        return $this->getDataType($field);
    }
}