<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use YM\Facades\Umi;
use YM\Models\Table;
use YM\Models\TableRelationOperation;

class relationOperationController extends Controller
{
    public function adding($type = 'all')
    {
        $table = new Table();
        $tableNames = $table->getTableNameAndIdList();

        $operationCharacter = Config::get('umiEnum.operational_character');
        $currentTableName = Config::get('umiEnum.system_table_name.umi_table_relation_operation');
        //$currentTableName = Umi::umiEncrypt($currentTableName);

        $actions = Config::get('umiEnum.operation_type');

        switch ($type) {
            case 'all':
                return view('umi::relation.guide');
            case 'interlock':
                return view('umi::relation.interlock', compact('tableNames', 'operationCharacter', 'currentTableName'));
            case 'exist':
                return view('umi::relation.exist', compact('tableNames', 'operationCharacter', 'currentTableName', 'actions'));
            case 'custom':
                return view('umi::relation.custom', compact('tableNames', 'operationCharacter', 'currentTableName', 'actions'));
            case 'selfCheck':
                return view('umi::relation.selfCheck', compact('tableNames', 'operationCharacter', 'currentTableName', 'actions'));
            default:
                abort(404, 'Page does not exist.');
        }
    }

    public function operationAdd(Request $request)
    {
        Validator::make($request->all(), [
            'activeTable'   => 'required',
            /*'activeField'   => 'required',
            'responseTable' => 'required',
            'responseField' => 'required',
            'rule_name'     => 'required',
            'ruleName'      => 'required',
            'targetValue'   => 'required'*/
        ])->validate();

        $customer_rule_name = $request->ruleName === null ? '' : $request->ruleName;
        $rule_name = $request->rule_name;
        $operation_type = $request->operationType;
        $is_extra_operation = $request->input('is_extra_operation');
        $active_table_id = $request->activeTable;
        $active_table_field = $request->activeField === null ? '' : $request->activeField;
        $response_table_id = $request->responseTable === null ? 0 : $request->responseTable;
        $response_table_field = $request->responseField === null ? '' : $request->responseField;
        $check_value = '';
        $check_operation = '';
        if ($request->advantageSwitch == 'on') { //if advantage is open
            $check_value = $request->targetValue === null ? '' : $request->targetValue;
            $check_operation = $request->operation === null ? '' : $request->operation;
        }
        $details = $request->detail;

        $list = compact(
            'customer_rule_name',
            'rule_name',
            'operation_type',
            'is_extra_operation',
            'active_table_id',
            'active_table_field',
            'response_table_id',
            'response_table_field',
            'check_value',
            'check_operation',
            'details'
        );
        $TRO = new TableRelationOperation();
        $re = $TRO->add($list);
        if ($re) {
            Umi::showMessage('Add Relation', 'Success');
            return redirect()->route('relationAdding');
        }
        abort(503, 'Something went wrong!');
    }
}