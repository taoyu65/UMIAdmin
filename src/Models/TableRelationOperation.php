<?php

namespace YM\Models;

class TableRelationOperation extends UmiBase
{
    protected $table = 'umi_table_relation_operation';

    protected $openCache = false;
    protected $cacheAllRecord = false;

    public function getTableRelationOperationByTableId($tableId)
    {
        if ($this->openCache)
            return $this->cachedTable->where('active_table_id', $tableId);

        return self::where('active_table_id', $tableId)->get();
    }

    public function getRulesByNames($nameList, $tableId)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('active_table_id', $tableId)
                ->whereIn('rule_name', $nameList);

        return self::where('active_table_id', $tableId)
            ->whereIn('rule_name', $nameList)
            ->get();
    }
}
