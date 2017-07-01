<?php

namespace YM\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class FieldDisplayAdd extends UmiBase
{
    use BreadOperation;

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

    public function insertWithId($inputs)
    {
        $this->checkExist($inputs);
        $this->insert($inputs);
    }

    private function checkExist($inputs)
    {
        $tableId = $inputs['table_id'];
        $fields = self::where('table_id', $tableId)
            ->pluck('field');

        if (!$fields->contains('id')) {
            $id = Config::get('umi.primary_key');
            $idFieldInput['table_id'] = $tableId;
            $idFieldInput['field'] = $id;
            $idFieldInput['type'] = 'label';
            $idFieldInput['relation_display'] = '';
            $idFieldInput['custom_value'] = '';
            $idFieldInput['display_name'] = '';
            $idFieldInput['validation'] = '';
            $idFieldInput['details'] = '';
            $idFieldInput['is_editable'] = '0';
            $this->insert($idFieldInput);
        }
    }
}