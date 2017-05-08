<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;

class relationOperationController extends Controller
{
    public function browser($table)
    {

        //todo 判断表名是否为 relation表, 不许锁定这个表, 不然有漏洞
        return view('umi::relationOperation');

    }

    public function adding()
    {
        return view('umi::relationOperation');
    }
}