<?php

namespace YM;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class UmiEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'YM\Events\TableRelationOperationEvent' => [
            'YM\Listeners\TableRelationOperationListener'
        ],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}