<?php

namespace YM\Models;

class Badge extends UmiBase
{
    protected $table = 'umi_badges';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function getBadges($tableId, $field)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('table_id', $tableId)
                ->where('field', 'type');
                //->pluck('class', 'badge_name');

        return self::select('badge_name', 'class')
            ->whereTable_idAndField($tableId, $field)
            ->get();
    }
}