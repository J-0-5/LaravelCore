<?php

namespace App\Modules\ConfigModule\Models;

use App\Http\Controllers\Traits\RestActions;
use App\Modules\ParametersModule\Parameter;
use App\Modules\ParameterValueModule\ParameterValue;
use Illuminate\Http\Request;

class Program extends ParameterValue
{
    use RestActions;

    public function getPrograms($request)
    {
        try {
            $programs_parameter_id = Parameter::whereName('program')->first()->id;
            $programs = ParameterValue::whereParameterId($programs_parameter_id)
                ->whereParentId($request->faculty_id)
                ->get();

            return $this->respond(200, $programs, null, 'Programas obtenidas exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al obtener programas');
        }
    }
}
