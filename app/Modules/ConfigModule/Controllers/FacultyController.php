<?php

namespace App\Modules\ConfigModule\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RestActions;
use App\Modules\ParametersModule\Parameter;
use App\Modules\ParameterValueModule\Controllers\ParameterValueTrait;
use App\Modules\ParameterValueModule\ParameterValue;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    use ParameterValueTrait;

    protected $path = 'ConfigModule.views.html.';

    public function respond($state, $data = [], $error = null, $message = '')
    {
        return [
            'state' => $state, //response status
            'data' => $data, //response data
            'error' => $error, //bug for developer
            'message' => $message //user message
        ];
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        try {
            $faculties = Parameter::where('reference', 'faculty')->first();
            $faculty = ParameterValue::where('parameter_id', $faculties->id)->get();
            return $this->respond(200, $faculty, null, 'Listado de Facultades');
        } catch (\Throwable $e) {
            return $this->respond(500, [], $e->getMessage(), 'Ha ocurrido un error de servidor');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->storeParameterValue($request);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validator = $this->validateParameter($request, 'update', $id);
        if ($validator->fails()) {
            return $this->respond(500, $validator->errors(), 'validation error', $validator->errors()->first());
        }
        try {
            $parameterValue = ParameterValue::find($id);
            if (is_null($parameterValue)) {
                return $this->respond(500, [], 'user not found', 'No se encontró el parámetro');
            }
            $parameterValue->update([
                'name' => $request->name,
                'description' => $request->description,
                'active' => $request->active == 'on' ? 1 : 0
            ]);

            return $this->respond(200, $parameterValue, null, 'parámetro actualizado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear parámetro');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->deleteParameterValue($id);
        return $response;
    }
}
