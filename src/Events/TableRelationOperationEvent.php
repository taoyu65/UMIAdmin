<?php

namespace YM\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;

class TableRelationOperationEvent
{
    use InteractsWithSockets, SerializesModels;

    public $type;
    public $tableId;
    public $whenToOperate;

    /**
     * Create a new event instance.
     *
     * @param $tableId
     * @param $whenToOperate
     */
    public function __construct($tableId, $whenToOperate = 'after')
    {
        $this->tableId = $tableId;
        $this->whenToOperate = $whenToOperate;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
