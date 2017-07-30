<?php

namespace YM;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use YM\Commands\InstallCommand;
use YM\Http\Middleware\LanguageMiddleware;
use YM\Http\Middleware\TableRelationConfirmationMiddleware;
use YM\Http\Middleware\TableRelationExecuteMiddleware;
use YM\Http\Middleware\UmiUrlAuthMiddleware;
use YM\Http\Middleware\BreadAccessMiddleware;
use YM\Umi\Umi;

class UmiServiceProvider extends ServiceProvider
{
    private $tableNameSpace = 'YM\Models\Table';
    private $administrator = 'YM\Umi\administrator';

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/umi.php', 'umi'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/Config/umiEnum.php', 'umiEnum'
        );

        $this->app->singleton('umi', function () {
            return new Umi();
        });
        $this->app->alias('umi', 'YM\Facades\Umi');

        #注册Umi路由提供者
        #regist Umi route provider
        $this->app->register(UmiRouteProvider::class);

        #注册视图合成器
        #regist view composer that including master page composer
        $this->app->register(ComposerServiceProvider::class);

        #事件提供者
        #regist event service
        $this->app->register(UmiEventServiceProvider::class);

        #数据表(tables)的单例模式
        #singleton for data table 'tables'
        $this->app->singleton($this->tableNameSpace);

        #管理员 administrator
        $this->app->singleton($this->administrator);
    }

    public function boot(Router $router)
    {
        #后台路径权限检测
        #URL authority control to check if has permission to load
        $router->middleware('umi.url.auth', UmiUrlAuthMiddleware::class);

        $router->middleware('umi.bread.access', BreadAccessMiddleware::class);

        $router->middleware('umi.TRelation.confirmation', TableRelationConfirmationMiddleware::class);

        $router->middleware('umi.TRelation.execute', TableRelationExecuteMiddleware::class);

        $router->middleware('umi.language', LanguageMiddleware::class);

        #全局帮助文件
        #helper
        $this->registerHelpers();

        #加载迁移文件
        #load migrate
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');

        #加载视图文件
        #load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'umi');

        #加载语言文件
        #load lang
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'umiTrans');

        #发布文件
        #publish
        $this->publishes([
            __DIR__ . '/Config/umi.php' => app()->basePath() . '/config/umi.php',
        ]);

        $this->publishes([
            __DIR__ . '/Config/umiEnum.php' => app()->basePath() . '/config/umiEnum.php',
        ]);

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views')
        ]);

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang')
        ]);

        $this->publishes([
            __DIR__ . '/resources/assets' => public_path('umi'),
        ]);

        #注册命令
        #command
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class
            ]);
        }
    }

    private function registerHelpers()
    {
        if (file_exists($file = __DIR__ . '/Helper/umiHelper.php'))
        {
            require_once($file);
        }
    }
}
