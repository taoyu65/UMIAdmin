<?php

namespace YM\Umi\DataTable\DataType;

use YM\Models\Badge;
use YM\Models\Table;

class BadgesDataType extends DataTypeAbstract
{
    public function regulateDataBrowser($dataList, $relatedTable = '', $relatedField = '', $option = [])
    {
        $table = new Table();
        $tableId = $table->getTableId($relatedTable);

        $badge = new Badge();
        $dataSet = $badge->getBadges($tableId, $relatedField);
        $dataSet = $dataSet->pluck('class', 'badge_name');
        $dataSetArr = $dataSet->toArray();

        $re = [];
        foreach ($dataList as $item) {
            $badge = $dataSet->keys()->contains($item) ? $this->getBadgeHtml($item, $dataSetArr[$item]) : $item;
            array_push($re, $badge);
        }
        return $re;
    }

    private function getBadgeHtml($value, $style)
    {
        return "<span class='$style'>$value</span>";
    }
}