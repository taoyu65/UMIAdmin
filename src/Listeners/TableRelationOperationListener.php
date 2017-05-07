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
    }
}
