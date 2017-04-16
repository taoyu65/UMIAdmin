<?php

namespace App\Http\Controllers;

use App\Events\TableRelationOperationEvent;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use YM\Facades\Umi;
use YM\Models\Table;
use Illuminate\Support\Facades\App;

class testController extends Controller
{
    //
    public $wo = 'i am class ';
    //excute delete action
    public function ttt()
    {
        $a = $this;
        Event::fire(new TableRelationOperationEvent($a ,'delete'));
       /*$container = new Container();
        $container->bind('YM\Models\Table');*/

        /*$table = $container->make('YM\Models\Table');
        $table2 = $container->make('YM\Models\Table');*/
        //App::singleton('YM\Models\Table');
        //echo Umi::find();


        /*if(!Cache::has('table')){
            $tableC = app()->make('YM\Models\Table');//App::bind('YM\Models\Table');
            Cache::put('table', $tableC, 100);
        }
        var_dump(Cache::has('table'));*/
        event('umi.routing', app('router'));

        $table = app()->make('YM\Models\Table');//App::bind('YM\Models\Table');
        $table2 = app()->make('YM\Models\Table');//App::bind('YM\Models\Table');
        $table->b = 'ttt';
        $table2->b = 'yyy';
        var_dump($table->getTableName(1));
        var_dump($table2->getTableName(2));
        var_dump($table->b);var_dump($table2->b);
    }
}
