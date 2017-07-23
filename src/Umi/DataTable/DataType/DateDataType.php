<?php

namespace YM\Umi\DataTable\DataType;

class DateDataType extends DataTypeAbstract
{
    public function regulateDataEditAdd($data, $relatedTable = '', $relatedField = '', $validation = '', $option = [])
    {
        $property = $this->getProperty($option);
        $validationString = $this->getValidation($validation);

        $html =<<<UMI
        <input class="form-control datetimepicker" type="text" $property value='$data' $validationString >
        <script>
            jQuery(function($) {
                $('.datetimepicker').datetimepicker({
                    lang: 'en',
                    format:"Y-m-d H:i:s",
                    step:5,
                    timepicker:true,
                    todayButton:true
                });
            });
        </script>
UMI;
        return $html;
    }
}