<?php

namespace YM\Umi\TableRelation;

use Illuminate\Support\Facades\DB;

/*
 * 当编辑一个记录时, 检查是否在其他数据表的某个字段存在此数据值
 * when edit a record, check other data table if has a same value at the given field
 */
class TREditExist extends TROperationAbstract
{
    public function showConfirmation($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation = '=')
    {
        if (($checkOperation === '<' || $checkOperation === '>') && is_numeric($currentFieldValue))
            abort('503', 'parameter should be number according to the operation character');

        try {
            $record = DB::table($responseTableName)
                ->where($responseField, $checkOperation, $currentFieldValue)
                ->first();
        } catch (\Exception $e) {
           return 'parameter wrong';
        }
        return $record ?
            $this->errMessage($activeTableName, $currentFieldValue, $responseTableName, $responseField) :
            true;
    }

    private function errMessage($activeTableName, $currentFieldValue, $responseTableName, $responseField)
    {
        $html = <<<UMI
        <div class="alert alert-danger">
			<strong>
				<i class="ace-icon fa fa-times"></i>
				Whoops! Found at least one record in the Table : "$responseTableName"
			</strong>
			Because the policy "<strong style="color: red">EXIST</strong>" has been applied on this delete action, you can not edit this record until manually delete all the
			records relate to Table "$activeTableName"
			<br>
			<strong style="color: grey">
			    <i>From table "$responseTableName" we found record that filed "$responseField" is $currentFieldValue</i>
			</strong>
			<br />
		</div>
UMI;
        return $html;
    }
}