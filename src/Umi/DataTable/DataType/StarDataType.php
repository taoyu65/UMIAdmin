<?php

namespace YM\Umi\DataTable\DataType;

use Illuminate\Support\Facades\Config;

class StarDataType extends DataTypeAbstract
{
    public function regulateDataBrowser($dataList, $relatedTable = '', $relatedField = '', $option = [])
    {
        $count = count($dataList);
        for ($i = 0; $i < $count; $i++) {
            $data = $dataList[$i];
            if (is_numeric($data) && $data > 0 && $data < 5)
                $dataList[$i] = $this->getStar($data);
        }
        return $dataList;
    }

    private function getStar($num)
    {
        $path = Config::get('umi.assets_path').'/images/star.png';

        $star = '<div>';
        for ($i = 0; $i < $num; $i++) {
            $star .= "<img src='$path'>";
        }
        $star .= "</div>";
        return $star;
    }
}