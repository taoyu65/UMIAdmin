<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;

class umiTableDeleteController extends Controller
{
    public function deleting($table, $id)
    {
        return view('umi::umiTableDeleting');
    }
}