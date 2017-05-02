<?php

namespace YM\Umi\TableRelation;

use Illuminate\Support\Facades\DB;

/*
 * 自定义规则
 * custom rule
 */
class TRCustom extends TROperationAbstract
{
    public function showConfirmation($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation = '=')
    {

        return '' ?
            $this->errMessage($activeTableName, $currentFieldValue, $responseTableName, $responseField) :
            true;
    }

    private function errMessage($activeTableName, $currentFieldValue, $responseTableName, $responseField)
    {
        $html = <<<UMI
        
UMI;
        return $html;
    }
}