<?php

namespace YM\Umi\DataTable\DataType;

use YM\Models\Badge;
use YM\Facades\Umi;

class BadgesDataType extends DataTypeAbstract
{
    public function regulateDataBrowser($data, $relatedTable = '', $relatedField = '', $option = [])
    {
        $tableId = Umi::currentTableId();// dd($tableId);
        $badge = new Badge();
        $dataSet = $badge->getBadges($tableId, $relatedField);
        $dataSet = $dataSet->pluck('class', 'badge_name');
        $dataSetArr = $dataSet->toArray();

        return $dataSet->keys()->contains($data) ? $this->getBadgeHtml($data, $dataSetArr[$data]) : $data;
    }

    private function getBadgeHtml($value, $style)
    {
        return "<span class='$style'>$value</span>";
    }
}