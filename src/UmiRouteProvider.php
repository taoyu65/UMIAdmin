<?php

namespace YM;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class UmiRouteProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'YM\Http\Controllers';

    private $umi_path;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->umi_path = Config::get('umi.umi_path');
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        ##config
        $this->publishes([
            __DIR__ . '/Config/umi.php' => app()->basePath() . '/config/umi.php',
        ]);
        $this->publishes([
            __DIR__ . '/Config/umiEnum.php' => app()->basePath() . '/config/umiEnum.php',
        ]);

        ##views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'umi');
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views')
        ]);

        ##assets
        $this->publishes([
            __DIR__ . '/resources/assets' => resource_path('assets'),
        ]);

        ##migrate
        $this->loadMigrationsFrom(__DIR__.'/path/to/migrations');
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            //if (! $this->app->routesAreCached()) {
                require base_path($this->umi_path . 'Routes/umi.php');
            //}
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path($this->umi_path . 'Routes/api.php');
        });
    }
}