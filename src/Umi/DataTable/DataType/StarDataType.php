<?php

namespace YM\Umi\DataTable\DataType;

use Illuminate\Support\Facades\Config;

class StarDataType extends DataTypeAbstract
{
    public function regulateDataBrowser($data, $relatedTable = '', $relatedField = '', $option = [])
    {
        if (is_numeric($data) && $data > 0 && $data < 6)
            return $this->getStar($data);
        return $data;
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