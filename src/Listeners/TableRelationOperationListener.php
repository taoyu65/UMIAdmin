<?php

namespace YM\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use YM\Events\TableRelationOperationEvent;
use YM\Facades\Umi;
use YM\Models\TableRelationOperation;
use YM\Umi\FactoryTableRelation;
use YM\Umi\TableRelation;
use YM\Umi\TableRelationDeleteInterlock;

class TableRelationOperationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TableRelationOperationEvent  $event
     * @return void
     */
    public function handle(TableRelationOperationEvent $event)
    {
        $whenToOperate = $event->whenToOperate;
        $tableId = $event->tableId;
        $factory = new FactoryTableRelation();
        /*$relationOperation = $factory->executeRelationOperation('', '');
        $result = $relationOperation->operation('', '', '', '');*/

        //$factory->
        //dd($event->tableId);
        //check if operation exist ....
        //see if delete or add or ...
        //invoke interface main entrance
        //var_dump($event->type);

        /*$obj = DB::table('table_relation_operation')
            ->where('active_table_id', '1')
            ->Where('special_relation', 'interlock')
            ->Where('response_table_id', '2')
            ->get();
        if ($event->type === 'delete') {
            $tableOperate = new TableRelation(new TableRelationDeleteInterlock());
            $tableOperate->executeOperation($obj);
        }*/
    }
}
