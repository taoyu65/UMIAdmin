<?php

namespace YM\Umi\DataTable\DataType;

use YM\Models\FieldDisplayBrowser;
use YM\Models\Table;
use YM\Umi\FactoryDataType;

class DataTypeOperation
{
    private $bread;
    private $tableName;
    private $tableId;

    #database table name
    private $browser = 'umi_field_display_browser';
    private $read = 'umi_field_display_read';
    private $edit = 'umi_field_display_edit';
    private $delete = 'umi_field_display_delete';

    public function __construct($bread, $tableName)
    {
        switch ($bread) {
            case 'browser':
                $this->bread = $this->browser;
                break;
            case 'read':
                $this->bread = $this->read;
                break;
            case 'edit':
                $this->bread = $this->edit;
                break;
            case 'delete':
                $this->bread = $this->delete;
                break;
            default:
                throw new \Exception('wrong parameter is provided');
        }

        $this->tableName = $tableName;

        $table = new Table();
        $this->tableId = $table->getTableId($this->tableName);
    }

    private function getDataSet($tableId)
    {
        $fieldDisplayBrowser = new FieldDisplayBrowser();
        return $fieldDisplayBrowser->DataSetBrowser($tableId);
    }

    #仅仅为数据浏览所用 just use for the browser
    public function getTHead()
    {
        return $this->getDataSet($this->tableId);
    }

    #获取所有用于显示的字段 get all fields that use for showing on the browser
    public function getFields()
    {
        return $this->getDataSet($this->tableId)
            ->map(function ($item){
                return $item->field;
            })->toArray();
    }

    private function getRegulatingType()
    {
        return $this->getDataSet($this->tableId)
            ->map(function ($item) {
                return [
                    $item->field => [
                        'type'              => $item->type,
                        'relation_display'  => $item->relation_display
                    ]
                ];
            })->collapse();
    }

    #根据数据类型重写数据格式 get regulated data according to the custom required
    public function regulatedDataSet($dataSet)
    {
        $dataTypes = $this->getRegulatingType();
        $factory = new FactoryDataType($dataTypes);

        $arrDisorder = [];
        foreach ($dataTypes as $field => $others) {
            $column = $dataSet->pluck($field)->toArray();
            $regulator = $factory->getInstance($field);
            list($relatedTable, $relatedField) = $this->getTableField($others['relation_display']);
            $column = $regulator->regulateDataBrowser($column, $relatedTable, $relatedField);
            array_push($arrDisorder, $column);
        }
        $regulatedDateSet = $this->swapRowColumn($arrDisorder);

        return $regulatedDateSet;
    }

    private function getTableField($relationship)
    {
        $arr = explode(':', $relationship);

        #如果不是分为2个部分, 则参数错误 返回原有数据
        #if does not have 2 parts, the parameter is wrong than return original data
        if (count($arr) != 2)
            return ['', ''];
        return [$arr[0], $arr[1]];
    }

    private function swapRowColumn($arr)
    {
        #初始化 initial
        $returnArr = [];
        for ($i = 0; $i < count($arr[0]); $i++) {
            $returnArr[$i] = array();
        }

        for ($i = 0; $i < count($arr); $i++) {
            for ($j = 0; $j < count($arr[$i]); $j++) {
                $returnArr[$j][$i] = $arr[$i][$j];
            }
        }

        return $returnArr;
    }
}