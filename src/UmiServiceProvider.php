<?php

namespace YM;

use Illuminate\Support\ServiceProvider;
use YM\Umi\Umi;

class UmiServiceProvider extends ServiceProvider
{
    private $tableNameSpace = 'YM\Models\Table';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('umi', function () {
            return new Umi();
        });

        #注册Umi路由提供者
        #regist Umi route provider
        $this->app->register(UmiRouteProvider::class);

        #数据表(tables)的单例模式
        #singleton for data table 'tables'
        $this->app->singleton($this->tableNameSpace);
    }
}
