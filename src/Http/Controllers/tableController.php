<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;

class tableController extends Controller
{
    public function index()
    {
        return view('umi::umiTable', ['test' => 'testTable']);
    }
}
