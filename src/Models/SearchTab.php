<?php

namespace YM\Models;

class SearchTab extends UmiBase
{
    protected $table = 'umi_search_tab';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes, 'order');
    }

    public function searchTabs($tableId)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('table_id', $tableId);
        return self::where('table_id', $tableId)
            ->orderBy('order')
            ->get();
    }
}