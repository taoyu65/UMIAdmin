<?php

namespace YM\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use YM\Models\Table;
use YM\Umi\FactoryBreadBrowser;
use YM\Umi\umiDataTableBuilder;

use YM\umiAuth\Facades\umiAuth;
use YM\umiAuth\src\Models\Role;
use YM\Umi\DataTable\DataType\DataTypeOperation;
class umiTableController extends Controller
{
    public function index($tableName = '')
    {
        //test
        /*$ab = new User();
        $b = $ab->permission(1);

        foreach ($b as $bb) {
            //var_dump($bb->key);
        }*/
        //var_dump($tableName);
//        var_dump(umiAuth::cannot('*-menu_role'));
//        var_dump(umiAuth::can('delete-menu_role'));
//        var_dump(umiAuth::can(['delete-menu_role','*-menu_role'], true));
//        var_dump(umiAuth::hasRole([1,2], true));
//        var_dump(umiAuth::ability(['table_user','article_user'],['delete-menu_role','edit-menu_role'],['validate_all' => true, 'return_type' => 'both']));
        //$user = new User();
        /*$role = new Role();
        $role->role_name = 'newrocwlke111';
        $role->display_name = 'displaynew';
        try {
            $role->save();
        } catch (\Exception $e) {
            //print_r('<script>alert("Role name already exist.")</script>');
        }*/
        /**/
        //dd($user->roles()->getResults());
        //dd(Auth::user()->ability('admin,owner', 'create-post,edit-user'));
        //$user->find(1)->roles()->attach(12);
//        umiAuth::user();
        //umiAuth::attach($role);
        //umiAuth::detach([32,33]);
//        $ta = new Table();
//        var_dump($ta->getTableName(17));
//        $a = new DataTypeOperation('browser', '');
//        $aa = $a->getTHead();
//        foreach ($aa as $b) {
//            //var_dump($b->id);
//        }
        //
        if ($tableName == '') return view('umi::umiTableAll');

        $factoryBread = new FactoryBreadBrowser($tableName);
        $breadBrowser = $factoryBread->getBreadBrowser();
        $header = $breadBrowser->header();
        $tableBody = $breadBrowser->tableBody();
        $footer = $breadBrowser->footer();

        return view('umi::umiTable', [
            'header'    => $header,
            'tableBody' => $tableBody,
            'footer'    => $footer
        ]);
    }
}
