<?php

namespace App\Modules\UserModule;

use App\Modules\ParameterValueModule\ParameterValue;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use App\Modules\UserModule\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserModel extends User implements AuthenticatableContract
{
    use Authenticatable, HasApiTokens, SoftDeletes, LogsActivity;

    public function updatePassword($request, $id)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                ['password' => 'required|confirmed']
            );

            if ($validator->fails()) {
                return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
            }

            $user = $this::find($id);
            if (is_null($user)) {
                return $this->respond(500, [], 'user not found', 'No se encontró el usuario');
            }

            $user->update([
                'password' => Hash::make($request->password) ?? $user->password,
            ]);

            return $this->respond(200, $user, null, 'Contraseña actualizada exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al actualizar usuario');
        }
    }
}
