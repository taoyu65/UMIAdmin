<?php

namespace YM\Umi\TableRelation;

use Illuminate\Support\Facades\DB;

class TRDeleteInterlock extends TROperationAbstract
{
    public function showConfirmation($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation = '=')
    {
        return $this->errMessage($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation);
    }

    public function executeExtraOperation($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation = '=')
    {
//        $count = DB::table($responseTableName)
//            ->where($responseField, $checkOperation, $currentFieldValue)
//            ->delete();
        return 0;//$count;//todo - waiting for final test
    }

    private function errMessage($activeTableName, $activeField, $currentFieldValue, $targetValue, $responseTableName, $responseField, $checkOperation)
    {
        $numShowing = 10;
        $records = DB::table($responseTableName)
            ->where($responseField, $checkOperation, $currentFieldValue)
            ->take($numShowing)
            ->get();

        if ($records->count() === 0) return '';

        $table = $this->getTable($records);

        $html = <<<UMI
        <div class="alert alert-danger">
			<strong>
				<i class="ace-icon fa fa-times"></i>
				WARNING! Found records in the Table : "$responseTableName"
			</strong>
			<br />
			    <strong style="color: #ff6d00">Those records will be deleted along with the main action!</strong>
			<br />
				Maximum of $numShowing records will be showing in the following table, 
			<br />
		</div>

        <div>
            $table
        </div>
UMI;
        return $html;
    }

    private function getTable($records)
    {
        $TH = '';
        $TR = '';
        foreach (collect($records->first())->keys() as $key) {
            $TH .= "<th>$key</th>";
        }
        foreach ($records as $record) {
            $TR .= "<tr>";
            foreach ($record as $item => $value) {
                $TR .= "<td>$value</td>";
            }
            $TR .= "</tr>";
        }

        $html = <<<UMI
        <table  id="simple-table" class="table  table-bordered table-hover">
            <thead>
                <tr>
                    $TH
                </tr>
            </thead>
            <tbody>
                $TR
            </tbody>
        </table>
UMI;
        return $html;
    }
}