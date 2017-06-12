<?php

namespace YM\Umi;

use YM\Models\UmiModel;
use YM\Facades\Umi as Ym;

class umiAuthorityBuilder
{
    public function showExistRecords($tableName, $tableId)
    {
        $umiModel = new UmiModel($tableName);
        $records = $umiModel->getRecordsByWhere('table_id', $tableId);

        $TH = '';
        $TR = '';
        foreach (collect($records->first())->keys() as $key) {
            if ($key == 'created_at' || $key == 'updated_at')
                break;
            $TH .= "<th>$key</th>";
        }
        foreach ($records as $record) {
            $TR .= "<tr>";
            foreach ($record as $item => $value) {
                if ($item == 'created_at' || $item == 'updated_at')
                    break;
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