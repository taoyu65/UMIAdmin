<?php

namespace YM\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';
    public $b = '';

    public function TableRelationOperationActive()
    {
        return $this->belongsTo('TableRelationOperation', 'active_table_id');
    }

    public function TableRelationOperationResponse()
    {
        return $this->belongsTo('TableRelationOperation', 'response_table_id');
    }

    public static function tableName($id)
    {
        return self::find($id)->table_name;
    }

    public function getTableName($id)
    {
        return self::find($id)->table_name;
    }
}
