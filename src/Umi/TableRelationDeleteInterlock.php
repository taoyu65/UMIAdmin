<?php

namespace YM\Umi;

use Illuminate\Support\Facades\DB;
use YM\Umi\Contracts\TableRelationOperationInterface;
use YM\Models\Table;

class TableRelationDeleteInterlock implements TableRelationOperationInterface
{
    /**
     * @param $operationObjects - will be array of instance of table table_relation_operation
     * @return mixed
     */
    public function operation($operationObjects)
    {
        foreach ($operationObjects as $operationObject) {
            $whereRight = $operationObject->active_table_id;
            $whereLeft = $operationObject->response_table_field;
            $responseTableId = $operationObject->response_table_id;
            $responseTableName = Table::tableName($responseTableId);
            $re = DB::table($responseTableName)->where($whereLeft, $whereRight)->delete();
            var_dump($re);
        }
    }
}