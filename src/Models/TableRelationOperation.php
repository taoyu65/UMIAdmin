<?php

namespace YM\Models;

class TableRelationOperation extends UmiBase
{
    protected $table = 'umi_table_relation_operation';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function getTableRelationOperationByTableId($tableId)
    {
        if ($this->openCache)
            return $this->cachedTable->where('active_table_id', $tableId);

        return self::where('active_table_id', $tableId)->get();
    }

    # 参数isExtraOperation 为数据库中的字段 表示 除了本身操作以外是否有其他数据操作除
    # parameter isExtraOperation is a field of data base, to see if there is extra operation other than itself
    public function getRulesByNames($tableId, $isExtraOperation = false)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('active_table_id', $tableId)
                ->where('is_extra_operation', $isExtraOperation);

        return self::where('active_table_id', $tableId)
            ->where('is_extra_operation', $isExtraOperation)
            ->get();
    }

    #f
    #
    public function getRulesForConfirmation($tableId)
    {
        if ($this->openCache)
            return $this->cachedTable
                ->where('active_table_id', $tableId)
                ->sortBy('is_extra_operation');

        return self::where('active_table_id', $tableId)
            ->orderBy('is_extra_operation')
            ->get();
    }
}
