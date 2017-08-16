<?php

namespace YM\Umi\PageBuilder;

use YM\Facades\Umi as YM;
use YM\Umi\Contracts\PageBuilder\tableBreadInterface;
use YM\Umi\FactoryDataType;

class umiTableBreadBuilder_ACE implements tableBreadInterface
{
    private $dataTypeFactory;

    public function __construct()
    {
        $this->dataTypeFactory = new FactoryDataType();
    }

    public function display($records, $defaultValue, $buttonType)
    {
        if (!$records->count()) {
            return $this->showingNoRecords();
        }

        $html = '';
        $html .= csrf_field();

        if ($buttonType === 'read') {
            foreach ($records as $record) {
                $html .= $this->rowForRead($record, $defaultValue);
            }
        } else {
            foreach ($records as $record) {
                $html .= $this->rowForEditAdd($record, $defaultValue);
            }
        }

        $html .= $this->buttons($buttonType);
        $html .=<<<UMI
        <script>
            jQuery(function ($) {
                $("#umiForm").validate({errorClass: "red"});
            })
        </script>
UMI;


        return $html;
    }

#region private method
    #检查字段是否有默认值
    #check the field if there is a default value
    private function checkDefaultValue($fieldName, $defaultValueArr)
    {
        return array_has($defaultValueArr, $fieldName) ? $defaultValueArr[$fieldName] : '';
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
#endregion

#region component
    private function rowForEditAdd($record, $defaultValue)
    {
        $popoverTitle = $record->display_name ? $record->display_name : $record->field;
        $popover = $this->popoverInfo($popoverTitle, $record->details);

        $readonly = $record->is_editable ? '' : 'true " style="cursor: not-allowed ';
        $name = $record->field;
        $title = $record->display_name == '' ? $record->field : $record->display_name;
        $property = compact('name','readonly');

        $value = $this->checkDefaultValue($name, $defaultValue);
        $dataTypeFactory = $this->dataTypeFactory->getInstance($record->type);
        $validation = json_decode($record->validation);
        list($tableName, $field) = $this->getTableField($record->relation_display);

        $input = $dataTypeFactory->regulateDataEditAdd($value, $tableName, $field, $validation, [
            'property'      => $property,
            'customValue'   => json_decode($record->custom_value)
        ]);

        $html =<<<UMI
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="$name">$title</label>
            <div class="col-xs-12 col-sm-4">
                <div class="clearfix">
                    <span >$input</span>
                </div>
            </div>
            $popover
        </div>
        
UMI;

        return $html;
    }

    private function rowForRead($record, $defaultValue)
    {
        if (!$record->is_showing)
            return '';

        $name = $record->field;
        $title = $record->display_name == '' ? $record->field : $record->display_name;

        $value = $this->checkDefaultValue($name, $defaultValue);
        $dataTypeFactory = $this->dataTypeFactory->getInstance($record->type);

        list($tableName, $field) = $this->getTableField($record->relation_display);

        $input = $dataTypeFactory->regulateDataBrowser($value, $tableName, $field);

        $html =<<<UMI
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="$name">$title</label>
            <div class="col-xs-12 col-sm-4">
                <div class="clearfix">
                    <span >$input</span>
                </div>
            </div>
        </div>
        
UMI;

        return $html;
    }

    private function popoverInfo($title, $content)
    {
        if ($content == '')
            return '';

        $html =<<<UMI
            <i class="fa fa-question-circle fa-lg popover-info blue" aria-hidden="true" data-rel="popover"
                       data-trigger="hover" style="transform: translate(0,4px);" data-placement="auto right"
                       title="$title"
                       data-content="$content"></i>
UMI;
        return $html;
    }

    private function buttons($buttonType)
    {
        if ($buttonType === 'edit')
            return $this->buttonEdit();
        if ($buttonType === 'add')
            return $this->buttonAdd();
        if ($buttonType === 'read')
            return $this->buttonCloseForRead();
    }

    private function buttonCloseForRead()
    {
        $html = <<<UMI
        <button class="btn btn-grey btn-sm btn-next" type="button" id="cls">
            Close
            <i class="ace-icon fa fa-close"></i>
        </button>
UMI;
        return $html;
    }

    private function buttonEdit()
    {
        $html = <<<UMI
        <button class="btn btn-info btn-sm btn-next" type="submit" id="submitBtn">
            Update
            <i class="ace-icon fa fa-refresh"></i>
        </button>
        &nbsp;&nbsp;
        <button class="btn btn-grey btn-sm btn-next" type="button" id="cls">
            Close
            <i class="ace-icon fa fa-close"></i>
        </button>
UMI;
        return $html;
    }

    private function buttonAdd()
    {
        $html = <<<UMI
        <button class="btn btn-success btn-sm btn-next" type="submit" id="submitBtn">
            Add
            <i class="ace-icon fa fa-plus"></i>
        </button>
        &nbsp;&nbsp;
        <button class="btn btn-primary btn-sm btn-next" type="button" id="cls">
            Close
            <i class="ace-icon fa fa-close"></i>
        </button>
UMI;
        return $html;
    }

    private function showingNoRecords()
    {
        $html =<<<UMI
        <div class="alert alert-danger">
            You have not set up fields that will be showing here
            <br /><br /><p>
                <button class="btn btn-sm btn-success" type="button">Go Set Up</button>
                <button class="btn btn-sm btn-info" id="cls" type="button">Close</button>
            </p>
        </div>
UMI;

        return $html;
    }
#endregion
}