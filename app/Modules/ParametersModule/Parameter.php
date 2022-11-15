<?php

namespace App\Modules\ParametersModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    use SoftDeletes;
    protected $table = 'parameters';

    protected $fillable = [
        'reference',
        'name',
        'description',
        'active'
    ];

    public function getParameterValue()
    {
        return $this->hasMany(ParameterValue::class, 'parameter_id');
    }

    /* Scopes Config */
    public function scopeWhereReference($query, $value)
    {
        if (!is_null($value))
            $query->where('reference', $value);
    }

    public function scopeWhereName($query, $value)
    {
        if (!is_null($value))
            $query->where('name', $value);
    }

    public function scopeEditable($query)
    {
        $query->where('editable', 1);
    }

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }
    /*End Scopes Config */
}
