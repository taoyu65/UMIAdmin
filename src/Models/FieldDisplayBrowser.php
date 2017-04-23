<?php

namespace YM\Models;

use Illuminate\Support\Facades\Config;

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
        if ($this->openCache) {
            $re = $this->cachedTable
                ->where('table_id', $tableId)
                ->where('is_showing', 1);
            return $this->checkPrimaryKey($re, $tableId);
        }

        $re = self::where('table_id', $tableId)
            ->where('is_showing', 1)
            ->get();
        return $this->checkPrimaryKey($re, $tableId);
    }

    #确保数据表第一列为主键
    #making sure the first column of data table is primary key column
    private function checkPrimaryKey($dataSet, $tableId)
    {
        $primaryKey = Config::get('umi.primary_key');
        if ($dataSet->pluck('field')->first() != $primaryKey) {
            #检查是否包含主键
            #check if contains primary key
            if ($dataSet->where('field', $primaryKey)->count() != 0) {
                $tem = array_values($dataSet->where('field', $primaryKey)->toArray());
                $dataSet = $dataSet->where('field', '!=', $primaryKey);
                $dataSet = $dataSet->toArray();
                array_unshift($dataSet, $tem[0]);
                return collect($dataSet);
            } else {
                $idRow = $this->cachedTable
                    ->where('table_id', $tableId)
                    ->where('field', $primaryKey)
                    ->first();
                $dataSet = $dataSet->toArray();
                array_unshift($dataSet, $idRow);
                return collect($dataSet);
            }
        } else {
            return $dataSet;
        }
    }
}