<?php

namespace YM\Umi\DataTable\DataType;

use YM\Umi\Contracts\DataType\DataTypeInterface;

class DataTypeAbstract implements DataTypeInterface
{
    public function regulateDataBrowser($data, $relatedTable = '', $relatedField = '', $option = [])
    {
        return $data;
    }

    /**
     * 通常用于 显示数据表的外键所对应的表的真实数据(仅仅用于少量外键, 如果外键对应表的数据量很大 下拉列表会很长 会影响显示效果)
     * normally use for showing the real data install of this table's foreign key (only use for less data, if
     * not will be long list of drop down, not comfortable for browser.
     * @param $data
     *      - 原始数据集
     *      - original data list
     * @param string $relatedTable
     *      - 要显示的数据表
     *      - related table name
     * @param string $relatedField
     *      - 要显示的数据表的字段
     *      - related field name
     * @param string $validation
     *      - 字段验证规则
     *      - validation of field
     * @param array $option
     *      - 'property': 包含input的属性 including the property of input
     * @return mixed
     * @internal param string $relationship - 如果该字段需要显示其他数据表的字段, 则需要relationship等于 表名:字段名, 还有外键id*      - 如果该字段需要显示其他数据表的字段, 则需要relationship等于 表名:字段名, 还有外键id
     *      - if data need to be showing as other table's field then need relationship = tableName:fieldName, and foreign id
     */
    public function regulateDataEditAdd($data, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        return $data;
    }

    #input属性数组转换为字符串
    #input property array turn into string
    protected function getProperty($option)
    {
        if (!array_has($option, 'property'))
            return '';

        $property = '';
        foreach ($option['property'] as $key => $value) {
            if ($value == '')
                break;
            $property .= "$key=\"$value\" ";
        }
        return $property;
    }

    #解析validation并拼接字符串, 使用jquery validation
    #analyize and joint the string, using jquery validation.
    protected function getValidation($validation)
    {
        if (!$validation)
            return '';

        $validationRules = '';
        foreach ($validation as $key => $value) {
            $validationRules .= "$key=\"$value\" ";
        }
        return $validationRules;
    }

}