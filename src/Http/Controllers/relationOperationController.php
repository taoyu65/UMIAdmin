<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;

class relationOperationController extends Controller
{
    public function index()
    {
        return view('umi::relationOperation');
    }
}