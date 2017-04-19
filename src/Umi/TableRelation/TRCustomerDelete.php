<?php

namespace YM\Umi\TableRelation;

class TRCustomerDelete extends TROperationAbstract
{
    public function operation($activeTableName, $activeField, $activeFieldValue, $responseTableName, $responseField)
    {
        /*foreach ($operationObjects as $operationObject) {
            $whereRight = $operationObject->active_table_id;
            $whereLeft = $operationObject->response_table_field;
            $responseTableId = $operationObject->response_table_id;
            $responseTableName = Table::tableName($responseTableId);
            $re = DB::table($responseTableName)->where($whereLeft, $whereRight)->delete();
            var_dump($re);
        }*/
        return '';
    }
}