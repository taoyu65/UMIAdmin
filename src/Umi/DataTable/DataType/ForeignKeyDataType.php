<?php

namespace YM\Umi\DataTable\DataType;

use Illuminate\Support\Facades\Config;
use YM\Models\Umi;

class ForeignKeyDataType extends DataTypeAbstract
{
    public function __construct()
    {
    }

    public function regulateDataBrowser($dataList, $relatedTable = '', $relatedField = '', $option = [])
    {
        $umiTable = new Umi();
        $re = [];
        $currentPageData = $umiTable->getFieldByIds($relatedTable, $dataList);
        foreach ($dataList as $data) {
            $targetData = $currentPageData->where('id', $data)->first();
            $data = ($targetData === null) ? $this->getNoExistData($data) : $targetData->$relatedField;
            $value = "<i class='ace-icon fa fa-key purple'></i> " . $data;
            array_push($re, $value);
        }
        return $re;
    }

    public function getNoExistData($data)
    {
        $js = '{$(\'[data-rel=tooltip]\').tooltip();}';
        $url = Config::get('umi.assets_path') . '/ace/js/jquery.easypiechart.min.js';
        $html = <<< EOD
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

EOD;
        return $html;
    }
}