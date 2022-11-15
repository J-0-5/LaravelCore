<?php

namespace App\Modules\ConfigModule\Models;

use App\Http\Controllers\Traits\RestActions;
use App\Modules\ParametersModule\Parameter;
use App\Modules\ParameterValueModule\ParameterValue;

class Faculty
{
    use RestActions;

    public function getFaculties()
    {
        try {
            $faculties_parameter_id = Parameter::whereName('faculty')->first()->id;
            $faculties = ParameterValue::whereParameterId($faculties_parameter_id)->get();

            return $this->respond(200, $faculties, null, 'Facultades obtenidas exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al obtener facultades');
        }
    }
}
