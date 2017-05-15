<?php

namespace YM\Http\Controllers;

use Illuminate\Support\Facades\Config;
use YM\Models\Table;
use YM\Models\UmiBase;

class relationOperationController extends UmiBase
{
    public function adding($type = 'all')
    {
        $table = new Table();
        $tableNames = $table->getTableNameAndIdList();

        $operationCharacter = Config::get('umiEnum.operational_character');

        switch ($type) {
            case 'all':
                return view('umi::relation.guide');
            case 'interlock':
                return view('umi::relation.interlock', compact('tableNames', 'operationCharacter'));
            case 'exist':
                return view('umi::relation.exist');
            case 'custom':
                return view('umi::relation.custom');
            default:
                abort(404, 'Page does not exist.');
        }
    }
}