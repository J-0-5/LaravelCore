<?php

namespace App\Providers;

use App\Modules\ModuleModule\Module;
use Illuminate\Support\ServiceProvider;
use Blade, Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function is_sub_module($item = null)
    {
        if (is_null($item->parent_id ?? null)) {
            return false;
        }
        return true;
    }
    public function boot()
    {
        //
        $moduleData = Module::get();

        View::composer(['layouts.collapseAside', 'layouts.app'], function ($view) use ($moduleData) {
            $SuperModules = $moduleData;
            $view->with(['SuperModules' => $SuperModules]);
        });

        Paginator::useBootstrap();
    }
}
