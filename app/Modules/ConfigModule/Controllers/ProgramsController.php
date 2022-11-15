<?php

namespace App\Modules\ConfigModule\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ConfigModule\Models\Program;
use App\Modules\ParametersModule\Parameter;
use App\Modules\ParameterValueModule\Controllers\ParameterValueTrait;
use App\Modules\ParameterValueModule\ParameterValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProgramsController extends Controller
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

    public function validateParameter($request, $action = null, $id = null)
    {
        return Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'description' => 'nullable|string',
                'parent_id' => 'required',
                'active' => 'nullable',
                'parameter_id' => [
                    Rule::requiredIf($action == 'create')
                ]
            ]
        );
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $Program = new Program();
        try {
            $response = $Program->getPrograms($request);
            if ($response['state'] != 200) {
                return $response;
            }
            $programs = $response['data'];
            return $this->respond(200, $programs, null, 'Programas obtenidos exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al buscar programas');
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
        $validator = $this->validateParameter($request, 'create');
        if ($validator->fails()) {
            return $this->respond(500, $validator->errors(), 'validation error', $validator->errors()->first());
        }
        try {
            $program = ParameterValue::create([
                'name' => $request->name,
                'description' => $request->description,
                'parameter_id' => $request->parameter_id,
                'parent_id' => $request->parent_id,
                'active' => 1
            ]);

            return $this->respond(200, $program, null, 'Parámetro creado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear parámetro');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $prog = ParameterValue::where('parent_id', $id)->get();
            return $this->respond(200, $prog, null, 'Listado de Programas');
        } catch (\Throwable $e) {
            return $this->respond(500, [], $e->getMessage(), 'Ha ocurrido un error de servidor');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prog = ParameterValue::find($id);
        if (is_null($prog)) {
            return json_encode([
                'state' => 500,
                'message' => 'No se el programa'
            ]);
        }
        return $this->respond(200, $prog, null, 'Programa a editar');
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
            $parameter = ParameterValue::find($id);
            if (is_null($parameter)) {
                return $this->respond(500, [], 'user not found', 'No se encontró el programa');
            }
            $parameter->update([
                'name' => $request->name,
                'description' => $request->description,
                'active' => $request->active == 'on' ? 1 : 0,
                'parent_id' => $request->parent_id
            ]);

            return $this->respond(200, $parameter, null, 'Programa actualizado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear programa');
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
