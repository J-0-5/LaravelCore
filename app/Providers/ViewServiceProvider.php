<?php

namespace App\Providers;

use App\Modules\ConfigModule\Models\Faculty;
use App\Modules\ConfigModule\Models\Program;
use App\Modules\ParameterValueModule\ParameterValue;
use App\Modules\RoleModule\Role;
use App\Modules\UserModule\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $Role = new Role();
        $User = new User();

        //Roles
        View::composer(
            [
                'UserModule.views.html.index', 'UserModule.views.html.create', 'UserModule.views.html.edit'
            ],
            function ($view) use ($Role) {
                $roles = $Role->getRoles()['data'];
                $view->with('roles', $roles);
            }
        );




    }
}
