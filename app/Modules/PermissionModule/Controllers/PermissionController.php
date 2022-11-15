<?php

namespace App\Modules\PermissionModule\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RestActions;
use App\Modules\ModuleModule\Module;
use App\Modules\ParametersModule\Parameter;
use App\Modules\ParameterValueModule\ParameterValue;
use App\Modules\PermissionModule\Permission;
use App\Modules\RoleModule\Role;
use App\Modules\UserModule\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    use RestActions;
    protected $path = 'PermissionModule.views.html.';
    protected $User;
    protected $ParameterValueModel;
    public function __construct()
    {
        $this->Role = new Role();
        $this->User = new User();
        $this->Permission = new Permission();
        $this->ParameterValueModel = new ParameterValue();
    }
    public function index()
    {
        $roles = $this->Role->getRoles()['data'];
        $users =  $this->User->getUsers(Request())['data'];
        $dependencies = $this->ParameterValueModel->getParameterValues(new Request(array(
            'reference' => 'dependencies',
        )))['data'];
        return view($this->path . 'permits', compact('roles', 'users', 'dependencies'));
    }

    public function getPermissions($associate_to, $associate_id)
    {
        $modules = Module::get();
        $permissions = Permission::where('associate_to', $associate_to)->where('associate_id', $associate_id)->get();

        $action = Parameter::where('reference', 'action')->first();
        $actions = ParameterValue::where('parameter_id', $action->id)->get(['id', 'name']);

        return $this->respond(200, ['modules' => $modules, 'permissions' =>  $permissions, 'actions' =>  $actions], null, 'Roles yPermisos');
    }

    public function update(Request $request, $id)
    {
        try {
            foreach ($request->all() as $key => $item) {
                if ($key == '_token' || $key == '_method' || $key == 'dashboard' || $key == 'associate_to') {
                    continue;
                }
                $module = Module::where('reference', str_replace('_','.',$key))->first();
                $actions = implode(',', $item);

                $permission = Permission::updateOrCreate(
                    [
                    'associate_id' => $id,
                    'associate_to'=> $request->associate_to,
                    'module_id' =>$module->id,
                    ],[
                    'associate_id' =>$id,
                    'associate_to'=>$request->associate_to,
                    'module_id' =>$module->id,
                    'actions' => $actions,
                    'creator_user_id' => Auth()->user()->id
                   ]
                );
            }
            return redirect()->back()->with('success', 'Permisos actualizados exitosamente');
        } catch (\Throwable $e) {
            return redirect()->back()->with('danger', 'Error al actualizar permisos');
        }
    }
}
