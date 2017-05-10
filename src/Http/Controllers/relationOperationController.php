<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;

class relationOperationController extends Controller
{
    public function adding()
    {
        return view('umi::relation.add');
    }
}