<?php

namespace YM\Models;

class TableRelationOperation extends umiBase
{
    protected $table = 'umi_table_relation_operation';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function getTableRelationOperationByTableId($tableId)
    {
        if ($this->openCache)
            return $this->cachedTable->where('table_id', $tableId)->get();
        return self::where('table_id', $tableId)->get();
    }
}
