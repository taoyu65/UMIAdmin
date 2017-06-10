<?php

namespace YM\Umi\DataTable\DataType;

use Illuminate\Support\Facades\Config;
use YM\Models\UmiModel;

class ForeignKeyDataType extends DataTypeAbstract
{
    public function __construct()
    {
    }

    public function regulateDataBrowser($data, $relatedTable = '', $relatedField = '', $option = [])
    {
        $umiTable = new UmiModel($relatedTable);
        $targetData = $umiTable->getRowById($data);
        $returnData = $targetData == null ? $this->getNoExistData($data) : $targetData->$relatedField;
        return $returnData;
    }

    private function getNoExistData($data)
    {
        $js = '{$(\'[data-rel=tooltip]\').tooltip();}';
        $url = Config::get('umi.assets_path') . '/ace/js/jquery.easypiechart.min.js';
        $html = <<< UMI
        <i class='ace-icon fa fa-exclamation-circle red tooltip-error'
        title='Does not Exist on the target table.This is the value of itself'
        style='cursor: pointer'
        data-rel='tooltip' data-placement='right'></i>
        <span class='tooltip-error' title='Does not Exist on the target table.This is the value of itself'
        data-rel='tooltip' data-placement='right'>$data</span>
        <script src="$url"></script>
        <script>
        jQuery(function($) $js);
        </script>

UMI;
        return $html;
    }
}