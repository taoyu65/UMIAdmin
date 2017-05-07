<?php

namespace YM\Umi\TableRelation;

use Illuminate\Support\Facades\DB;

/*
 * 自定义规则
 * custom rule
 */
class aaa extends TROperationAbstract
{
    public function showConfirmation($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation = '=')
    {
        return $this->errMessage($activeTableName, $currentFieldValue, $responseTableName, $responseField);
//        return '' ?
//            $this->errMessage($activeTableName, $currentFieldValue, $responseTableName, $responseField) :
//            true;
    }

    public function executeExtraOperation($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation = '=')
    {
        //return 'aaa'. $activeTableName.'+++'.$currentFieldValue.':'.$targetValue;
        return 1;
    }

    private function errMessage($activeTableName, $currentFieldValue, $responseTableName, $responseField)
    {
        $html = <<<UMI
        sdafasdf
        <div title="sdaf">
        sdfasdfa
</div>
UMI;
        return $html;
    }
}