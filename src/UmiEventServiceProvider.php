<?php

namespace YM;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class UmiEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\TableRelationOperationEvent' =>
            [
                'App\Listeners\TableRelationOperationListener'
            ],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}