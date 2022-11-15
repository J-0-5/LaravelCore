<?php

namespace App\Modules\RoleModule;

use App\Http\Controllers\Traits\RestActions;
use App\Modules\ParameterValueModule\ParameterValue;
use App\Modules\UserModule\User;
use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Role extends Model
{
    use SoftDeletes, LogsActivity, RestActions;
    protected $fillable = [
        'name',
        'role_documents',
        'active',
    ];

    protected $appends = ['documents'];

    public function getDocumentsAttribute()
    {
        $documents = [];
        $arr = json_decode($this->role_documents);
        if (is_array($arr)) {
            $documents = ParameterValue::whereIn('id',  $arr)->get();
        }
        return  $documents;
    }

    /* Logs Config */
    protected static $logFillable = true;
    protected static $submitEmptyLogs = false;

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = __($eventName);
        if ($activity->causer) {
            $activity->description = "Se ha " . __($eventName) . " el rol " . $activity->subject->name;
        }
    }
    /*End logs config */

    /* Relationships Config */
    public function getUsers()
    {
        return $this->hasMany(User::class, 'role_id');
    }
    /*End Relationships config */

    /* Scopes Config */
    public function scopeWhereName($query, $value)
    {
        if (!is_null($value)) {
            $query->where('name', 'like', '%' . $value . '%');
        }
    }
    public function scopeWhereActive($query, $value)
    {
        if (!is_null($value)) {
            $query->where('active', $value);
        }
    }
    /*End Scopes Config */

    public function getRole($id)
    {
        try {
            $role = $this::where('id', $id)->first();
            return $this->respond(200, $role, null, 'Rol encontrado');
        } catch (\Throwable $e) {
            return $this->respond(500, [], $e->getMessage());
        }
    }

    public function getRoles()
    {
        try {
            $roles = $this::whereActive(request()->state)
                ->whereName(request()->name)
                ->get();
            return $this->respond(200, $roles, null, 'roles');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al obtener roles');
        }
    }

    public function validateRole($request, $action = null, $id = null)
    {
        return Validator::make(
            $request->all(),
            [
                'name' => [Rule::requiredIf($action == 'create')],
                'role_documents' => 'nullable',
                'active' => 'nullable',
            ]
        );
    }

    public function saveRole($request)
    {
        $validator = $this->validateRole($request, 'create');

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        try {
            $role = $this::create([
                'name' => $request->name,
                'role_documents' => json_encode($request->data),
                'active' => $request->active ?? 1,
            ]);

            return $this->respond(200, $role, null, 'Rol creado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear rol');
        }
    }

    public function updateRole($id, $request)
    {
        $validator = $this->validateRole($request);

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        $role = $this::find($id);
        if (is_null($role)) {
            return $this->respond(500, [], 'role not found', 'No se encontró el rol');
        }

        try {
            $role->update([
                'name' => $request->name ?? $role->name,
                'role_documents' => json_encode($request->role_documents) ?? $role->role_documents,
                'active' => $request->active ?? $role->active,
            ]);

            return $this->respond(200, $role, null, 'Rol actualizado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al actualizar rol');
        }
    }

    public function deleteRole($id)
    {
        try {
            $role = $this::find($id);
            if (is_null($role)) {
                return $this->respond(500, [], 'role not found', 'No se encontró el rol');
            }
            $role->delete();
            return $this->respond(200, $role, null, 'rol eliminado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al eliminar rol');
        }
    }
}
