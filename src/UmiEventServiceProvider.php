<?php

namespace YM\Umi;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class UmiEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        'src\Events\aaa' => ['src\Listeners\bbb'],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}