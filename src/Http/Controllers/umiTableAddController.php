<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use YM\Facades\Umi;
use YM\Models\UmiModel;

class umiTableAddController extends Controller
{
    public function adding(Request $request, $table, $defaultValue)
    {
        $actionAvailable = isset($request['TRO_Available']) && $request['TRO_Available'] === false ? false : true;
        $message = $request['TRO_Message'];

        $list = compact('table', 'actionAvailable', 'message', 'a');
        //var_dump(Umi::unSerializeAndBase64($defaultValue));
        return view('umi::table.umiTableAdding', $list);
    }

    public function add(Request $request, $table)
    {
        /*if (!isset($request['hidden_ti']))
            throw new \Exception('wrong parameter');

        $umiModel = new UmiModel($table);
        $id = $request['hidden_ti'];
        $count = 1;//$umiModel->delete($id);

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
        }*/
    }
}