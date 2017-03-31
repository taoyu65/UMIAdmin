<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Table extends Model
{
    protected $table = 'umi_tables';
    private $cacheTable;

    public function __construct()
    {
        $minute = Config::get('umi.cache_minutes');
        $this->cacheTable = Cache::remember('tables', $minute, function (){
            return DB::table('umi_tables')->get();
        });
    }

    public function TableRelationOperationActive()
    {
        return $this->belongsTo('TableRelationOperation', 'active_table_id');
    }

    public function TableRelationOperationResponse()
    {
        return $this->belongsTo('TableRelationOperation', 'response_table_id');
    }

    public function getTableName($id)
    {
        return self::find($id)->table_name;
    }

    public function getTableId($tableName)
    {
        $record = $this->cacheTable->where('table_name', $tableName)->first();
        if ($record)
            return $record->id;
        return 0;
    }
}
