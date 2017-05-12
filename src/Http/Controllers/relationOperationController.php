<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;

class relationOperationController extends Controller
{
    public function adding($type = 'all')
    {
        switch ($type) {
            case 'all':
                return view('umi::relation.guide');
            case 'interlock':
                return view('umi::relation.interlock');
            case 'exist':
                return view('umi::relation.exist');
            case 'custom':
                return view('umi::relation.custom');
            default:
                abort(404, 'Page does not exist.');
        }
    }
}