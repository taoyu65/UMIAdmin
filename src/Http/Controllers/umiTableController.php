<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;
use YM\Umi\FactoryBreadBrowser;
use YM\umiAuth\Facades\umiAuth;

class umiTableController extends Controller
{
    public function index($tableName = '')
    {
        //test
        /*$ab = new User();
        $b = $ab->permission(1);

        foreach ($b as $bb) {
            //var_dump($bb->key);
        }*/

        //var_dump(Auth::user()->can('update-umi_table', $post, true));
        var_dump(umiAuth::hasPermission('add-menu_role'));
        //
        if ($tableName == '') return view('umi::umiTableAll');

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
