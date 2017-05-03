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

        $umiModel = new UmiModel();
        $id = $request['hidden_ti'];
        $count = 1;//$umiModel->delete($table, $id);
        //todo - replace js alert, use gritter js
        //todo - recover the delete action, now use number 1 instead.
        if ($count){
            $request['action_success'] = true;

            Umi::showMessage(
                'Delete success - active delete',
                "There is <strong style=\'color: orange\'>1</strong> record has been deleted from table: <strong style=\'color: orange\'>$table</strong>",
                [
                    'time' => 10000
                ]
            );

            echo '<script>parent.window.location.reload();</script>';
        }
    }
}