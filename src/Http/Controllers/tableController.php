<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class tableController extends Controller
{
    public function index()
    {
        return view('umi::umiTable', ['test' => 'testTable']);
    }
}
