<?php

namespace YM\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use YM\Facades\Umi;

class FieldDisplayBrowser extends UmiBase
{
    protected $table = 'umi_field_display_browser';

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function __construct(array $attributes = [], $orderBy = '', $order = 'asc')
    {
        $this->fillable = Config::get('umiEnum.fillable.' . $this->table);
        parent::__construct($attributes, 'order', $order);
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

    public function getRecordsByTable($tableId)
    {
        if ($this->openCache) {
            return $this->cachedTable
                ->where('table_id', $tableId);
        }

        return self::where('table_id', $tableId)
            ->get();
    }

    #一键增加所有用于显示的字段, 使用默认值 (排除已存在的字段)
    #on click to add all fields that use for display as default value (not for exist fields)
    public function quickAdd($table, $selectedTableId, $existFieldArr)
    {
        $tableName = Umi::getTableNameById($selectedTableId);
        $umiModel = new UmiModel($tableName);
        $allFields = $umiModel->getTableFields($tableName);

        try {
            $count = 0;
            foreach ($allFields as $field) {
                if (in_array($field, $existFieldArr))
                    continue;

                $re = DB::table($table)->insert([
                    'table_id'  => $selectedTableId,
                    'field'     => $field,
                    'type'      => 'label',
                    'relation_display'  => '',
                    'display_name'      => $field,
                    'order'             => $count,
                    'is_showing'        => 1,
                ]);
                $count = $re ? $count+1 : $count;
            }
        } catch (\Exception $exception) {
            exit($exception->getMessage());
        }

        Cache::pull($table);
        return $count;
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

    public function checkBeforeInsert($tableId, $fieldName)
    {
        return self::where([
            'table_id'  => $tableId,
            'field'     => $fieldName
        ])
            ->count();
    }
    public function insert($inputs)
    {
        try {
            self::create($inputs);
            Cache::pull($this->table);
        } catch (\Exception $exception) {
            abort(503, $exception->getMessage());
        }
    }
}