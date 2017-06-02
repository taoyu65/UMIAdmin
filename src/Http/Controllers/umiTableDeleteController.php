<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use YM\Facades\Umi;
use YM\Models\UmiModel;

class umiTableDeleteController extends Controller
{
    public function deleting(Request $request, $table, $id, $activeFields = '')
    {
        $actionAvailable = isset($request['TRO_Available']) && $request['TRO_Available'] === false ? false : true;
        $message = $request['TRO_Message'];
        $activeFieldValue = $request['activeFieldValue'];
        $list = compact('table', 'id', 'activeFields', 'actionAvailable', 'message', 'activeFieldValue');
        return view('umi::umiTableDeleting', $list);
    }

    public function delete(Request $request, $table)
    {
        if (!isset($request['hidden_ti']))
            throw new \Exception('wrong parameter');

        $umiModel = new UmiModel($table);
        $id = $request['hidden_ti'];
        $count = 1;//$umiModel->delete($id);
        ////todo - waiting for final test
        if ($count){
            $request['action_success'] = true;

            Umi::showMessage(
                "Delete success! - <strong style=\'color: orange\'>active delete</strong>",
                "Record of ID: <strong style=\'color: orange\'>$id</strong> has been deleted from table: <strong style=\'color: orange\'>$table</strong>",
                [
                    'time' => 10000
                ]
            );

            echo '<script>parent.window.location.reload();</script>';
        }
    }
}