<?php

namespace YM\Umi\DataTable\DataType;

class CheckBoxDataType extends DataTypeAbstract
{
    public function regulateDataEditAdd ($data, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        return $this->getAddHtml($data, $option);
    }

    private function getAddHtml($data, $option)
    {
        $property = $this->getProperty($option);
        $check = $data ? 'checked' : '';
        $value = $data ? '1' : '0';

        $html =<<<UMI
        <input $check type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="YES" data-off-text="NO" id="bsCheckBox">
        <input type="hidden" $property class="isEditableHidden" value="$value">
        <script>
            $(document).ready(function () {
                var switchSelector = 'input[type="checkbox"]';
                $(switchSelector).bootstrapSwitch();
                $(switchSelector).on('switchChange.bootstrapSwitch', function(event, state) {
                    $('.isEditableHidden').val(state ? '1' : '0');
                });
            });
            </script>
UMI;
        return $html;
    }
}