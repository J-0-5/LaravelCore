<?php

namespace App\Modules\ParameterValueModule;

use App\Http\Controllers\Traits\RestActions;
use App\Modules\ParametersModule\Parameter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParameterValue extends Model
{
    use SoftDeletes, RestActions;
    protected $table = 'parameter_values';

    protected $fillable = [
        'parameter_id',
        'name',
        'description',
        'active',
        'parent_id',
        'editable'
    ];

    public function getParameter()
    {
        return $this->belongsTo(Parameter::class, 'parameter_id');
    }

    public function getChildren()
    {
        return $this->hasMany(ParameterValue::class, 'parent_id');
    }

    public function scopeWhereParameterId($query, $value)
    {
        if (!is_null($value))
            $query->where('parameter_id', $value);
    }

    public function scopeWhereParameterName($query, $value)
    {
        if (!is_null($value))
            $query->whereHas('getParameter', function ($query) use ($value) {
                $query->where('name', 'like', '%' . $value . '%');
            });
    }

    public function scopeWhereParameterReference($query, $value)
    {
        if (!is_null($value))
            $query->whereHas('getParameter', function ($query) use ($value) {
                $query->where('reference', $value);
            });
    }

    public function scopeWhereParentId($query, $value)
    {
        if (!is_null($value))
            $query->where('parent_id', $value);
    }

    public function scopeWhereParameterValueId($query, $value)
    {
        if (!is_null($value))
            $query->where('id', $value);
    }

    public function scopeWhereName($query, $value)
    {
        if (!is_null($value)) {
            if (!is_array($value)) {
                $value = [$value];
            }
            $query->whereIn('name', $value);
        }
    }

    public function parent()
    {
        return $this->belongsTo(ParameterValue::class, 'parent_id', 'id')
            ->select('id', 'name', 'description', 'parent_id')
            ->with('parent');
    }

    public function getParameterValues($request)
    {
        try {
            $parameter_value = $this::whereParameterName($request->parameter_name)
                ->whereParameterReference($request->reference)
                ->whereParameterId($request->parameter_id)
                ->whereParameterValueId($request->id)
                ->whereParentId($request->parent_id)
                ->whereName($request->name)
                ->get();

            return $this->respond(200, $parameter_value, null, 'Valores parámetro obtenidos exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al obtener valores de parámetro');
        }
    }

    public function getParameterValue($request)
    {
        try {
            $parameter_value = $this::whereName($request->name)
                ->whereParameterReference($request->parameter_reference)
                ->first();

            return $this->respond(200, $parameter_value, null, 'Valor parámetro obtenido exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al obtener valor de parámetro');
        }
    }
}
