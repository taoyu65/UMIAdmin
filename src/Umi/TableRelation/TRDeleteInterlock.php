<?php

namespace YM\Umi\TableRelation;

class TRDeleteInterlock extends TROperationAbstract
{
    public function operation($activeTableName, $activeField, $activeFieldValue, $responseTableName, $responseField)
    {
        try {
            $record = DB::table($responseTableName)
                ->where($responseField, $activeFieldValue)
                ->first();
        } catch (\Exception $e) {
            return 'parameter wrong';
        }
        return $record ?
            $this->errMessage($activeTableName, $responseTableName) :
            true;
    }

    private function errMessage($activeTableName, $responseTableName)
    {
        $html = <<<UMI
        <div class="alert alert-danger">
			<strong>
				<i class="ace-icon fa fa-times"></i>
				Whoops! Found records in the Table : "$responseTableName"
			</strong>
				Because the policy "EXIST" has been applied on this delete action, you can not delete this record until manually delete all the
				records relate to Table "$activeTableName"
			<br />
		</div>
UMI;
        return $html;
    }
}