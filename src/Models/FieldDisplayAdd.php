<?php

namespace YM\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class FieldDisplayAdd extends UmiBase
{
    protected $table = 'umi_field_display_add';
    public $timestamps = true;

    protected $openCache = true;
    protected $cacheAllRecord = true;

    public function __construct(array $attributes = [], $orderBy = '', $order = 'asc')
    {
        $this->fillable = Config::get('umiEnum.fillable.' . $this->table);
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