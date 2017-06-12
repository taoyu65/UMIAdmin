<?php

namespace YM\Models;

class FieldDisplayAdd extends UmiBase
{
    protected $table = 'umi_field_display_add';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function __construct(array $attributes = [], $orderBy = '', $order = 'asc')
    {
        parent::__construct($attributes, 'order', $order);
    }

    public function getRecordsByTable($tableId)
    {
        if ($this->openCache) {
            return $this->cachedTable
                ->where('table_id', $tableId);
        }

        return self::where('table_id', $tableId)
            ->get();
    }
}