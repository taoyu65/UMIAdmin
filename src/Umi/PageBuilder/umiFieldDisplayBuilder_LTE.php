<?php

namespace YM\Umi\PageBuilder;

use YM\Models\UmiModel;
use YM\Facades\Umi as Ym;
use YM\Umi\Contracts\PageBuilder\fieldDisplayInterface;

class umiFieldDisplayBuilder_LTE implements fieldDisplayInterface
{
    public function showExistRecords($tableName, $tableId)
    {
        $umiModel = new UmiModel($tableName, 'order', 'asc');
        $records = $umiModel->getRecordsByWhere('table_id', $tableId);

        $TH = '';
        $TR = '';
        //创建已经存在的字段的数组
        //create a array of the fields that already exist
        $existFields = [];

        foreach (collect($records->first())->keys() as $key) {
            if ($key == 'created_at' || $key == 'updated_at')
                break;
            $TH .= "<th>$key</th>";
        }
        if ($TH != '')
            $TH .= "<th>Operation</th>";

        foreach ($records as $record) {
            $TR .= "<tr>";
            foreach ($record as $item => $value) {
                if ($item == 'created_at' || $item == 'updated_at')
                    break;
                $TR .= "<td>$value</td>";
            }
            $url = url('editing') . "/$tableName/$record->id";
            $TR .= "<td><button type='button' class='btn btn-success btn-flat' onclick='showEditing(\"$url\");'>Edit</button> ";
            $TR .= "<button type='button' class='btn btn btn-danger btn-flat' onclick='recordDelete(\"$tableName\", \"$record->id\");'>Delete</button></td>";
            $TR .= "</tr>";

            array_push($existFields, $record->field);
        }

        $bgColor = '#c7ffcd';
        if (strstr($tableName, 'browser')) {
            $bgColor = '#5AC594';
        } else if (strstr($tableName, 'add')) {
            $bgColor = '#E27D71';
        } else if (strstr($tableName, 'edit')) {
            $bgColor = '#F7BF65';
        } else if (strstr($tableName, 'read')) {
            $bgColor = '#80B5D3';
        }

        $streamExistField = base64_encode(json_encode($existFields));

        $html = <<<UMI
        <input type="hidden" id="existFields" value="$streamExistField">
        <table id="simple-table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    $TH
                </tr>
            </thead>
            <tbody>
                $TR
            </tbody>
        </table>
        <script>
        
        //$().ready(function () {
            $('.table tr').mouseenter(function () {
                $(this).attr('style', 'background-color: $bgColor');
            });
            $('.table tr').mouseleave(function () {
                $(this).removeAttr('style');
            });
        //});
</script>
UMI;
        return $html;
    }
}