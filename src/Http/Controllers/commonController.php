<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;
use YM\Models\UmiModel;
use YM\Umi\Common\Selector;

class commonController extends Controller
{
    public function selector($table, $property)
    {
        $selectorClass = new Selector();
        $selector = $selectorClass->unSerialize($property);

        $umiModel = new UmiModel($table);
        $records = $umiModel->getRecordsByFields($selector->fields);

        return view('umi::common.selector', compact('table', 'selector', 'records'));
    }
}