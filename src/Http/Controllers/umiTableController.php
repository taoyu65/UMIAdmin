<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;
use YM\Models\User;
use YM\Umi\FactoryBreadBrowser;

class umiTableController extends Controller
{
    public function index($tableName = '')
    {
        //test
        $ab = new User();
        $b = $ab->permission(1);

        foreach ($b as $bb) {
            //var_dump($bb->key);
        }
        //
        if ($tableName == '')
            return view('umi::umiTableAll');
        $factoryBread = new FactoryBreadBrowser();
        $breadBrowser = $factoryBread->getBreadBrowser();
        $header = $breadBrowser->header();
        $tableBody = $breadBrowser->tableBody();
        $footer = $breadBrowser->footer();
        return view('umi::umiTable', [
            'header'    => $header,
            'tableBody' => $tableBody,
            'footer'    => $footer
        ]);
    }
}
