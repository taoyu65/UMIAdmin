<?php

namespace YM\umiAuth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class umiAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/umiAuthConfig.php' => app()->basePath() . '/config/umiAuth.php',
        ]);

        $this->bladeTranslate();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/umiAuthConfig.php', 'umiAuth'
        );

        $this->app->singleton('umiAuth', function () {
            return new umiAuth(Auth::user());
        });

        $this->app->alias('umiAuth', 'YM\umiAuth\Facades\umiAuth');
    }

    public function bladeTranslate()
    {
        if (!class_exists('\Blade'))
            return;
        //todo Blade::directive();
    }
}