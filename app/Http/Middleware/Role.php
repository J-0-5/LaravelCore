<?php

namespace App\Http\Middleware;

use App\Modules\ModuleModule\Module;
use App\Modules\ParameterValueModule\ParameterValue;
use App\Modules\PermissionModule\Permission;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $arr = explode('.', $request->route()->getName());
        $len = count($arr);

        $pathRoute = '';
        $action = '';
        for ($i = 0; $i < $len; $i++) {
            $punto = $i == 1 ? '.' : '';
            $i < $len - 1 && $pathRoute = $pathRoute . $punto . $arr[$i];
            $i == $len - 1 && $action = $arr[$i];
        }

        $module = Module::where('reference', $pathRoute)->first(['id']);
        $module_id = $module->id;

        //role _id of authenticated user
        $user_rol = Auth::user()->role_id;
        $user_id = Auth::user()->id;

        $permissions_order = ['users' => $user_id, 'roles' => $user_rol];
        foreach($permissions_order as $associate_to => $associate_id){
            $permissions = Permission::where('module_id', $module_id)->where('associate_to',  $associate_to)->where('associate_id', $associate_id)->first(['id', 'actions']);

            if(!is_null($permissions)){
                break;
            }

        }
        $actions = $permissions->actions ?? '';

        $action = ParameterValue::where('name', $action)->first(['id']);
        // dd($action);
        $action_id = $action->id;

        if(Auth::user()->role_id  != 1){
            if(!in_array(1, explode(',', $actions))){
                if (!in_array($action_id, explode(',',$actions))) {
                    // Session::flash('warning', 'Lo siento, no tienes permiso.');
                    return back();
                }
            }
        }
        return $next($request);
    }
}
