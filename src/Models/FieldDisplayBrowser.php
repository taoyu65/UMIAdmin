<?php

namespace YM\Models;

class FieldDisplayBrowser extends UmiBase
{
    protected $table = 'umi_field_display_browser';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function __construct()
    {
        parent::__construct('order');
    }

    public function DataSetBrowser($tableId)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('table_id', $tableId)
                ->where('is_showing', 1);

        return self::where('table_id', $tableId)
            ->where('is_showing', 1)
            ->get();
    }
}