<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;
use YM\Facades\Umi;
use YM\Models\UmiModel;

class commonController extends Controller
{
    public function selector($table, $property)
    {
        $property = Umi::umiDecrypt($property);
        $property = json_decode($property);

        $umiModel = new UmiModel($table);
        $records = '';

        return view('umi::common.selector', compact('table', 'property'));
    }
}