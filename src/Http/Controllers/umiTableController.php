<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;

class umiTableController extends Controller
{
    public function index($tableName = '')
    {
        if ($tableName == '')
            return view('umi::umiTable', ['test' => 'testTable']);

    }
}
