<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Table extends Model
{
    protected $table = 'umi_tables';
    protected $openCache = true;

    private $cachedTable;

    public function __construct()
    {
        if ($this->openCache){
            $minute = Config::get('umi.cache_minutes');
            $this->cachedTable = Cache::remember($this->table, $minute, function (){
                return DB::table('umi_tables')->get();
            });
        }
    }

    public function TableRelationOperationActive()
    {
        return $this->belongsTo('TableRelationOperation', 'active_table_id');
    }

    public function TableRelationOperationResponse()
    {
        return $this->belongsTo('TableRelationOperation', 'response_table_id');
    }

    public function getTableById($id)
    {
        if ($this->openCache)
            return $this->cachedTable->find($id);
        return self::find($id);
    }

    public function getTableName($id)
    {
        return $this->getTableById($id)->table_name;
    }

    public function getTableId($tableName)
    {
        if ($this->openCache){
            $record = $this->cachedTable->where('table_name', $tableName)->first();
        } else {
            $record = self::where('table_name', $tableName)->first();
        }

        if ($record)
            return $record->id;
        return 0;
    }

    public function getAllTable()
    {
        if ($this->openCache)
            return $this->cachedTable;
        return self::all();
    }
}
