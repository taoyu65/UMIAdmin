<?php

namespace YM\Umi\TableRelation;

/*
 * 当删除一个记录时, 检查当前记录的给定字段是否符合规则
 * when delete a record, check current field of given table if match the rule
 */
class TRDeleteSelfCheck extends TROperationAbstract
{
    public function showConfirmation($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation = '=')
    {
        $re = false;
        switch ($checkOperation) {
            case '=':
                $re = ($currentFieldValue == $targetValue);
                break;
            case '<' :
            case '>':
                $re = $this->isNum($currentFieldValue, $targetValue, $checkOperation);
                break;
            case '!=':
                $re = ($currentFieldValue != $targetValue);
                break;
            case 'like':
                $re = stristr($currentFieldValue, $targetValue) == '' ? false : true;
                break;
        }
        return $re ?
            $this->errMessage($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $checkOperation) :
            true;
    }

    private function isNum($currentFieldValue, $targetValue, $checkOperation)
    {
        if (!(is_numeric($currentFieldValue) && is_numeric($targetValue)))
            abort('406', 'parameter is not integer');
        switch ($checkOperation) {
            case '>':
                return $currentFieldValue > $targetValue;
            case '<':
                return $currentFieldValue < $targetValue;
            case '!=':
                return $currentFieldValue != $targetValue;
            default:
                return false;
        }
    }

    private function errMessage($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $checkOperation)
    {
        $html = <<<UMI
        <div class="alert alert-danger">
			<strong>
				<i class="ace-icon fa fa-times"></i>
				Whoops! Found records in the Table : "$responseTableName"
			</strong>
			Because the policy "<strong style="color: red">SELF CHECK</strong>" has been applied on this delete action, you can not delete this record until manually delete all the
			records relate to Table "$activeTableName"
			<br>
			<strong style="color: grey">
			    <i>policy: The value ($currentFieldValue) of field "$activeField" from table "$activeTableName" has to be "$checkOperation" the value($targetValue)</i>
			</strong>
			<br />
		</div>
UMI;
        return $html;
    }
}