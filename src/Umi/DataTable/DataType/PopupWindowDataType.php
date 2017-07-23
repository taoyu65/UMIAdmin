<?php

namespace YM\Umi\DataTable\DataType;

use YM\Models\Table;
use YM\Umi\Common\Selector;

class PopupWindowDataType extends DataTypeAbstract
{
    public function regulateDataEditAdd($data, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        return $this->getAddHtml($data, $validation, $option);
    }

    private function getAddHtml($data, $validation, $option)
    {
        $property = $this->getProperty($option);
        $validationString = $this->getValidation($validation);

        $selector = new Selector();
        $selector->title = 'Selector';
        //$selector->tip = 'this is tip';
        $selector->functionName = 'getValue';
        $selector->fields = $option['customValue']->showFields;
        $selector->returnField = $option['customValue']->returnField;
        $selector->searchField = $option['customValue']->searchField;
        $selectorProperty = $selector->serialize();

        $relatedTable = $option['customValue']->tableName;
        $url = url("selector/$relatedTable/$selectorProperty");

        $html = <<<UMI
        <input $property $validationString value="$data" type="text" class="form-control" readonly placeholder="Not editable, please select one" id="popupWindowInput">
        <a href="#" id="popup">Click to Select</a>
        <script>
            var popupWindow = $('#popup').click(function () {
                    layer.open({
                    type: 2,
                    title: 'popup window selector',
                    maxmin: true,
                    shadeClose: true,
                    area : ['800px' , '90%'],
                    content: '$url'
                });
            });
            
            function getValue(data) {
                $('#popupWindowInput').val(data.trim());
                layer.closeAll();
            }
        </script>
UMI;
        return $html;
    }

    public function dataTypeInterface($relationDisplayDomId, $customValueDomId)
    {
        $tableModel = new Table();
        $table = $tableModel->getTableNameAndIdList();

        $list = compact( 'relationDisplayDomId', 'customValueDomId', 'table');

        return view('umi::common.dataType.popupWindowInterface', $list);
    }
}