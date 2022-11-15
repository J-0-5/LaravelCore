<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    protected $moduleNamespace = 'App\Modules';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebModuleRoutes();

        $this->mapApiModuleRoutes();

        $this->mapApiRoutes();

        $this->mapWebRoutes();
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
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
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
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapWebModuleRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(function () {
                require(base_path('app/Modules/UserModule/routes/web.php'));
                require(base_path('app/Modules/ParametersModule/routes/web.php'));
                require(base_path('app/Modules/ParameterValueModule/routes/web.php'));
                require(base_path('app/Modules/ActivityLogModule/routes/web.php'));
                require(base_path('app/Modules/RoleModule/routes/web.php'));
                require(base_path('app/Modules/PermissionModule/routes/web.php'));
                require(base_path('app/Modules/ModuleModule/routes/web.php'));
                require(base_path('app/Modules/ConfigModule/routes/web.php'));

                require(base_path('app/Modules/NotificationModule/routes/web.php'));

                require(base_path('app/Modules/DocumentModule/routes/web.php'));
            });
    }

    protected function mapApiModuleRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(function () {
                require(base_path('app/Modules/UserModule/routes/api.php'));
                require(base_path('app/Modules/ParameterValueModule/routes/api.php'));
            });
    }
}
