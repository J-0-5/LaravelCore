<?php

namespace App\Modules\UserModule;

use App\Http\Controllers\Traits\RestActions;
use App\Mail\PasswordMail;
use App\Modules\DocumentModule\Document;
use App\Modules\MemberDetailModule\MemberDetail;
use App\Modules\ParameterValueModule\ParameterValue;
use App\Modules\RoleModule\Role;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use App\Modules\LaboratoryModule\Laboratory;
use Illuminate\Support\Facades\Mail;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, HasApiTokens, SoftDeletes, LogsActivity, RestActions;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'role_id',
        'user_document_type',
        'dependency',
        'parent_id',
        'name',
        'last_name',
        'document_number',
        'address',
        'phone',
        'email',
        'data',
        'password',
        'creator_user_id',
        'active',
    ];

    /* Accessors Config */
    protected $appends = ['full_name',];

    public function getFullNameAttribute()
    {
        $full_name = "";
        if (!empty($this->name))
            $full_name = $full_name . $this->name . " ";
        if (!empty($this->last_name))
            $full_name = $full_name . $this->last_name;

        return $full_name;
    }
    /* End Accessors Config */

    /* Logs Config */
    protected static $logFillable = true;
    protected static $submitEmptyLogs = false;

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = __($eventName);
        if ($activity->causer) {
            $activity->description = "Se ha " . __($eventName) . " el usuario " . $activity->subject->full_name;
        }
    }
    /*End logs config */


    /* Relationships Config */
    public function getRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getUserDocumentType()
    {
        return $this->belongsTo(ParameterValue::class, 'user_document_type');
    }

    public function getParent()
    {
        $classes = [
            'users' => self::class,
            'dependencies' => ParameterValue::class,
        ];
        $class = $classes[$this->dependency];
        return $this->belongsTo($class, 'parent_id');
    }

    public function getSign()
    {
        $ParameterValueModel = new ParameterValue();
        $document_type = $ParameterValueModel->getParameterValue(new Request(array(
            'name' => 'Firma',
            'parameter_reference' => 'role_documents'
        )))['data']->id;
        return $this->hasOne(Document::class, 'associate_id')->where('associate_to', 'users')->where('document_type', $document_type);
    }

    public function getCreatorUser()
    {
        return $this->belongsTo(self::class, 'creator_user_id');
    }
    /*End Relationships config */


    /* Scopes Config */
    public function scopeWhereRoleId($query, $value)
    {
        if (!is_null($value)) {
            if (!is_array($value)) {
                $value = [$value];
            }
            $query->whereIn('role_id', $value);
        };
    }
    public function scopeWhereRoleName($query, $value)
    {
        if (!is_null($value))
            $query->whereHas('getRole', function ($query) use ($value) {
                $query->where('name', $value);
            });
    }
    public function scopeWhereNotRoleId($query, $value)
    {
        if (!is_null($value)) {
            if (!is_array($value)) {
                $value = [$value];
            }
            $query->whereNotIn('role_id', $value);
        };
    }
    public function scopeWhereUserDocumentTypeId($query, $value)
    {
        if (!is_null($value)) {
            $query->where('user_document_type', $value);
        };
    }
    public function scopeWhereUserDocumentTypeName($query, $value)
    {
        if (!is_null($value))
            $query->whereHas('getUserDocumentType', function ($query) use ($value) {
                $query->where('name', $value);
            });
    }
    public function scopeWhereParentTypeId($query, $value)
    {
        if (!is_null($value)) {
            $query->where('dependency', $value);
        };
    }
    public function scopeWhereParentTypeName($query, $value)
    {
        if (!is_null($value))
            $query->whereHas('getParent', function ($query) use ($value) {
                $query->where('name', $value);
            });
    }
    public function scopeWhereParentId($query, $value)
    {
        if (!is_null($value)) {
            $query->where('parent_id', $value);
        };
    }
    public function scopeWhereParentName($query, $value)
    {
        if (!is_null($value)) {
            $query->whereHas('getParent', function ($query) use ($value) {
                $query->where('name', $value);
            });
        }
    }
    public function scopeWhereFullName($query, $value)
    {
        if (!is_null($value)) {
            $query->where(DB::raw('concat(COALESCE(name, ""), COALESCE(concat(" ",last_name), ""))'), 'like', '%' . $value . '%');
        }
    }
    public function scopeWhereName($query, $value)
    {
        if (!is_null($value)) {
            $query->where('name', 'like', '%' . $value . '%');
        }
    }
    public function scopeWhereLastName($query, $value)
    {
        if (!is_null($value)) {
            $query->where('last_name', 'like', '%' . $value . '%');
        }
    }
    public function scopeWhereDocumentNumber($query, $value)
    {
        if (!is_null($value)) {
            $query->where('document_number', 'like', '%' . $value . '%');
        }
    }
    public function scopeWhereAddress($query, $value)
    {
        if (!is_null($value)) {
            $query->where('address', 'like', '%' . $value . '%');
        }
    }
    public function scopeWherePhone($query, $value)
    {
        if (!is_null($value)) {
            $query->where('phone', 'like', '%' . $value . '%');
        }
    }
    public function scopeWhereEmail($query, $value)
    {
        if (!is_null($value)) {
            $query->where('email', 'like', '%' . $value . '%');
        }
    }
    public function scopeWhereCreatorUserId($query, $value)
    {
        if (!is_null($value)) {
            $query->where('creator_user_id', $value);
        };
    }
    public function scopeWhereCreatorUserName($query, $value)
    {
        if (!is_null($value)) {
            $query->whereHas('getCreatorUser', function ($query) use ($value) {
                $query->where('name', $value);
            });
        }
    }
    public function scopeWhereActive($query, $value)
    {
        if (!is_null($value)) {
            $query->where('active', $value);
        }
    }
    public function scopeActive($query)
    {
        $query->where('active', 1);
    }
    public function scopeInactive($query)
    {
        $query->where('active', 0);
    }
    /*End Scopes config */

    public function getUsers($request)
    {
        try {
            $user = $this::whereRoleId($request->role_id)
                    ->whereRoleName($request->role_name)
                    ->whereNotRoleId($request->not_role_id)
                    ->whereUserDocumentTypeId($request->user_document_type)
                    ->whereUserDocumentTypeName($request->user_document_type_name)
                    ->whereParentTypeId($request->dependency)
                    ->whereParentTypeName($request->dependency_name)
                    ->whereParentId($request->parent_id)
                    ->whereParentName($request->parent_name)
                    ->whereFullName($request->full_name)
                    ->whereName($request->name)
                    ->whereLastName($request->last_name)
                    ->whereDocumentNumber($request->document_number)
                    ->whereAddress($request->address)
                    ->wherePhone($request->phone)
                    ->whereEmail($request->email)
                    ->whereCreatorUserId($request->creator_user_id)
                    ->whereCreatorUserName($request->creator_user_name)
                    ->whereActive($request->active)
                    ->with('getRole');
            if (!is_null($request->pagination)) {
                    $user = $user->paginate($request->pagination);
            } else {
                is_array($request->with) && $user = $user->with($request->with);
                $user = is_array($request->get) ? $user->get($request->get) : $user->get();
            }

            return $this->respond(200, $user, null, 'Usuarios encontrados exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al encontrar usuarios ' . $e->getLine());
        }
    }

    public function showUser($id)
    {
        try {
            $user = $this::find($id);
            return $this->respond(200, $user, null, 'Usuario encontrado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al encontrar usuario');
        }
    }

    public function validateUser($request, $action = null, $id = null)
    {
        return Validator::make(
            $request->all(),
            [
                'role_id' => 'required|exists:roles,id',
                'user_document_type' => 'nullable|exists:parameter_values,id',
                'dependency' => 'nullable|exists:parameter_values,id',
                'parent_id' => 'nullable',
                'name' => [Rule::requiredIf($action == 'create'),],
                'last_name' => [Rule::requiredIf($action == 'create'),],
                'document_number' => 'nullable',
                'address' => 'nullable',
                'phone' => 'nullable',
                'email' => [Rule::requiredIf($action == 'create'), 'email'],
                'data' => 'nullable',
                'password' => [
                    Rule::requiredIf($action == 'create'),
                    $action == 'create' ? 'confirmed' : 'nullable',
                ],
                'password_confirmation' => ['same:password'],
                'creator_user_id' => 'nullable|exists:users,id',
                'active' => 'nullable',
            ]
        );
    }

    public function saveUser($request)
    {
        $validator = $this->validateUser($request, 'create');

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        try {
            $user = $this::create([
                'role_id' => $request->role_id,
                'user_document_type' => $request->user_document_type,
                'dependency' => $request->dependency,
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'document_number' => $request->document_number,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'data' => json_encode($request->data),
                'password' => Hash::make($request->password),
                'active' => $request->active ?? 1,
            ]);

            if(Auth()->user()->role_id == 1 && !is_null($user->email)){
              $m =  Mail::to($user->email)->send(new PasswordMail($request->password));

            }
            return $this->respond(200, $user, null, 'Usuario creado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear usuario');
        }
    }

    public function updateUser($request, $id)
    {
        try {
            $validator = $this->validateUser($request);

            if ($validator->fails()) {
                return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
            }

            $user = $this::find($id);
            if (is_null($user)) {
                return $this->respond(500, [], 'user not found', 'No se encontró el usuario');
            }

            $user->update([
                'role_id' => $request->role_id ?? $user->role_id,
                'user_document_type' => $request->user_document_type ?? $user->user_document_type,
                'dependency' => $request->dependency ?? $user->dependency,
                'parent_id' => $request->parent_id ?? $user->parent_id,
                'name' => $request->name ?? $user->name,
                'last_name' => $request->last_name ?? $user->last_name,
                'document_number' => $request->document_number ?? $user->document_number,
                'address' => $request->address ?? $user->address,
                'phone' => $request->phone ?? $user->phone,
                'email' => $request->email ?? $user->email,
                'data' => json_encode($request->data) ?? $user->data,
                'password' => Hash::make($request->password) ?? $user->password,
                'active' => $request->active ?? $user->active,
            ]);

            return $this->respond(200, $user, null, 'Usuario actualizado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al actualizar usuario');
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = $this::find($id);
            if (is_null($user)) {
                return $this->respond(500, [], 'user not found', 'No se encontró el usuario');
            }
            $user->delete();
            return $this->respond(200, $user, null, 'Usuario  eliminado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al eliminar usuario');
        }
    }
}
