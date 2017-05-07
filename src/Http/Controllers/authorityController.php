<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;

class authorityController extends Controller
{
    public function index()
    {
        return view('umi::authority');
    }
}