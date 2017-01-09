<?php

namespace App\Http\Controllers;

use App\Events\TableRelationOperationEvent;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use YM\Models\Table;
use Illuminate\Support\Facades\App;

class test extends Controller
{
    //
    public $wo = 'i am class ';
    //excute delete action
    public function ttt()
    {
        $a = $this;
        //\Event::fire(new TableRelationOperationEvent($a ,'delete'));
       /*$container = new Container();
        $container->bind('YM\Models\Table');*/

        /*$table = $container->make('YM\Models\Table');
        $table2 = $container->make('YM\Models\Table');*/
        //App::singleton('YM\Models\Table');
        $table = app()->make('YM\Models\Table');//App::bind('YM\Models\Table');
        $table2 = app()->make('YM\Models\Table');//App::bind('YM\Models\Table');
        var_dump($table->getTableName(1));
        var_dump($table2->getTableName(2));
        var_dump($table->b);var_dump($table2->b);
    }
}
