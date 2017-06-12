<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;
use YM\Models\Table;
use YM\Umi\umiAuthorityBuilder;

class authorityController extends Controller
{
    public function bread($table, $type)
    {
        $tableModel = new Table();
        $tableList = $tableModel->getAllTable();
        $list = compact('tableList', 'table');

        switch ($type) {
            case 'browser':
            case 'read':
                return view('umi::authority.authorityEditAdd', $list);
            case 'edit':
            case 'add':
                return view('umi::authority.authorityEditAdd', $list);
            default:
                abort(404, 'Error page');
        }
    }

    public function loadFields($table, $tableId)
    {
        $builder = new umiAuthorityBuilder();
        return $builder->showExistRecords($table, $tableId);
    }
}